<?php
define('DB_HOST', '127.0.0.1');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');

define('DISCORD_TOKEN', '');
define('GUILD_ID', '');
define('PREMIUM_ROLE_IDS', ['', '']);

try {
    $pdo = new PDO(
        'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    header('Content-Type: application/json');
    die(json_encode(['error' => 'Database connection failed', 'premium' => false]));
}

header('Content-Type: application/json');

$rawInput = file_get_contents("php://input");
$data = json_decode($rawInput, true);

if (empty($data['secret'])) {
    die(json_encode(['error' => 'Secret parameter required', 'premium' => false]));
}

if (empty($data['chinese'])) {
    die(json_encode(['error' => 'Chinese parameter required', 'premium' => false]));
}

$secret = $data['secret'];
$chinese = $data['chinese'];

session_start();
$lastCheck = $_SESSION['last_check'] ?? 0;
$currentTime = time();

if ($currentTime - $lastCheck < 10) {
    die(json_encode(['premium' => false, 'message' => 'Please wait 10 seconds between checks']));
}

$_SESSION['last_check'] = $currentTime;

try {
    $stmt = $pdo->prepare("
        SELECT u.id, u.discord_id, u.isPremium 
        FROM user_config uc
        JOIN users u ON uc.userId = u.id 
        WHERE uc.secret = ?
        LIMIT 1
    ");
    $stmt->execute([$secret]);
    $user = $stmt->fetch();

    if (!$user) {
        die(json_encode(['error' => 'Invalid secret', 'premium' => false]));
    }

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://discord.com/api/v10/guilds/".GUILD_ID."/members/".$user['discord_id'],
        CURLOPT_HTTPHEADER => [
            'Authorization: Bot '.DISCORD_TOKEN,
            'Content-Type: application/json'
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 5
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $hasPremiumRole = false;
    $isPremium = (bool)$user['isPremium'];

    if ($httpCode === 200) {
        $member = json_decode($response, true);
        if ($member && !empty($member['roles'])) {
            foreach (PREMIUM_ROLE_IDS as $roleId) {
                if (in_array($roleId, $member['roles'])) {
                    $hasPremiumRole = true;
                    break;
                }
            }
        }
    }

    if ($hasPremiumRole !== $isPremium) {
        $newStatus = $hasPremiumRole ? 1 : 0;
        $updateStmt = $pdo->prepare("UPDATE users SET isPremium = ? WHERE id = ?");
        $updateStmt->execute([$newStatus, $user['id']]);
        $isPremium = $hasPremiumRole;
    }

    echo json_encode([
        'premium' => $isPremium,
        'discord_id' => $user['discord_id'],
        'last_checked' => date('c'),
        'has_premium_roles' => $hasPremiumRole,
        '中国黑客' => str_rot13(base64_encode(str_rot13($chinese)))
    ]);

} catch (Exception $e) {
    error_log("Premium Check Error: ".$e->getMessage());
    echo json_encode([
        'error' => 'An error occurred',
        'premium' => false
    ]);
}