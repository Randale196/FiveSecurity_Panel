# FiveSecurity Panel

A web panel for the FiveSecurity FiveM Anticheat. The panel provides a user-friendly interface for managing servers, licenses, bans, and statistics.

## 🚀 Features

### Core Features
- **Dashboard**: Clear overview of all servers and their status
- **Server Management**: FiveM server management with IP reset functionality
- **License System**: Complete license management with authentication
- **Ban System**: Advanced ban management with unban functionality
- **Player Management**: Player list and management
- **Logging**: Comprehensive logging of all anticheat activities

### Admin Features
- **Admin Dashboard**: Advanced management interface
- **Server Overview**: Overview of all registered servers
- **Auth Logs**: Logging of all authentication processes
- **Key Management**: License key management
- **Website Settings**: Website configuration settings
- **Config Editor**: Direct system configuration editing

### User Features
- **Account Management**: User account management
- **Discord Integration**: Discord OAuth2 login
- **Download System**: Secure downloads of the anticheat system
- **FAQ System**: Frequently asked questions and answers
- **Support**: Refund system and support functions

## 🛠️ Technical Details

### System Requirements
- **PHP**: 7.4 or higher
- **MySQL**: 5.7 or higher
- **Web Server**: Apache/Nginx
- **Composer**: For PHP dependencies

### Database Structure
The system uses multiple specialized databases:
- `panel` - Main panel functionality
- `counter` - Statistics and counters
- `logs` - Logging system
- `serverbans` - Server bans

### API Endpoints
- **Download API**: Secure file downloads with license validation
- **Ban System API**: Ban/Unban functionality
- **Discord Integration**: Discord bypass and role management
- **Server Status**: Automatic server status monitoring

## 📁 Project Structure

```
FiveSecurity_Panel/
├── api/                    # API endpoints
│   ├── download/          # Download system
│   └── fivesecurity/      # FiveSecurity-specific APIs
├── cdn/                   # CDN assets (JS, CSS, images)
├── panel/                 # Main panel application
│   ├── admin/            # Admin area
│   ├── account/          # User accounts
│   ├── manage/           # Server management
│   ├── login/            # Login system
│   ├── discord/          # Discord integration
│   ├── faq/              # FAQ system
│   ├── tos/              # Terms of Service
│   └── privacy/          # Privacy policy
└── README.md
```

## 🔧 Installation

### 1. Clone Repository
```bash
git clone https://github.com/yourusername/FiveSecurity_Panel.git
cd FiveSecurity_Panel
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Database Setup
Create the required databases:
- `panel`
- `counter`
- `logs`
- `serverbans`
- `auth` (optional, if using external auth)

### 4. Configuration
Edit `panel/config.php` with your database and website settings:

```php
$database_config = [
    'host' => 'localhost',
    'username' => 'your_username',
    'password' => 'your_password',
    'databases' => [
        'panel' => 'panel',
        'counter' => 'counter',
        'logs' => 'logs',
        'serverbans' => 'serverbans',
        'auth' => 'auth'
    ]
];
```

### 5. Discord Integration (Optional)
Configure Discord OAuth2 in `config.php`:
```php
$website_config = [
    'discord_client_id' => 'your_client_id',
    'discord_client_secret' => 'your_client_secret',
    'discord_redirect_uri' => 'https://yourdomain.com/discord/callback',
    'discord_bot_token' => 'your_bot_token'
];
```

## 🚀 Usage

### Getting Started
1. Visit the panel URL
2. Register or log in
3. Add your first server
4. Configure the anticheat system

### Adding a Server
1. Go to the "Manage" section
2. Click "Add Server"
3. Enter server IP and port
4. Configure anticheat settings

### License Management
- Licenses are automatically generated
- IP reset available every 30 days
- Automatic license validation

## 🔒 Security

- **Cloudflare Turnstile**: Bot protection
- **Discord OAuth2**: Secure authentication
- **License Validation**: Protection against unauthorized use
- **IP Whitelist**: Server-specific access
- **Session Management**: Secure user sessions

## 📊 Monitoring

### Server Status
- Automatic monitoring of server availability
- Resource status checks
- Real-time updates

### Logging
- Comprehensive logging of all actions
- Anticheat logs
- Authentication logs
- Admin activities

## 🎨 User Interface

- **Modern Design**: Responsive and user-friendly
- **Dark/Light Theme**: Customizable themes
- **Mobile Optimized**: Fully responsive
- **Intuitive Navigation**: Clear menu structure

## 🔧 Maintenance

### Regular Tasks
- Database backups
- Log rotation
- License verification
- Server status monitoring

### Updates
- Regular security updates
- Feature updates
- Bug fixes

## 📞 Support

- **Support**: Its not supported by me.

## 📄 License

© FiveSecurity - All rights reserved

## ⚠️ Important Notes

- The system is designed for commercial use
- License protection through Auth-Solutions
- No redistribution or resale allowed
- Regular updates required

## 🤝 Contributing

Contributions are welcome! Please create a pull request for improvements or bug fixes.

## 📈 Roadmap

- [ ] Advanced Analytics
- [ ] Mobile App
- [ ] API v2
- [ ] Multi-Language Support
- [ ] Enhanced Notifications

---

**FiveSecurity Panel** - Professional FiveM Anticheat Management System