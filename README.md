# SaaS Starter Kit

<p align="center">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel" alt="Laravel 12"></a>
<a href="#"><img src="https://img.shields.io/badge/Livewire-4.x-FB70A9?style=flat-square&logo=livewire" alt="Livewire 4"></a>
<a href="#"><img src="https://img.shields.io/badge/TailwindCSS-4.x-38B2AC?style=flat-square&logo=tailwind-css" alt="TailwindCSS 4"></a>
<a href="#"><img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=flat-square&logo=alpine.js" alt="Alpine.js"></a>
<a href="#"><img src="https://img.shields.io/badge/License-MIT-green?style=flat-square" alt="License"></a>
</p>

**Production-ready SaaS Starter Kit** dengan sistem autentikasi lengkap, credit/billing system, referral system, admin panel, support tickets, dan multi-channel notifications.

---

## ✨ Fitur Utama

### 🔐 Authentication System
- Email/Password Authentication dengan Email Verification
- Two-Factor Authentication (2FA) dengan Google Authenticator
- OAuth Login (Google)
- Password Reset & Email Change Verification
- User Ban/Suspend System
- OTP via Email untuk aksi sensitif

### 💰 Credit & Billing System
- Credit-based billing dengan `OrderStatus` enum
- Multiple payment methods dengan Tripay integration
- Order management dengan auto-expiry (scheduled command)
- Product & Category management
- Transaction history dengan credit logs

### 👥 Referral System
- Referral code dengan auto-generation
- Commission tracking (pending → available → withdrawn)
- **Referral Balance System** dengan audit log
- Withdrawal request dengan OTP verification
- Rejection restores balance automatically

### 👑 Admin Panel
- Dashboard dengan statistik real-time
- User management (CRUD, ban/unban, impersonation)
- Role & Permission management (Spatie)
- Order, Product, Credit management
- CMS (Pages, News, Blog, Help Center)
- Support ticket management
- Referral & Withdrawal management

### 🎫 Support System
- Ticket-based support dengan attachments
- Threaded replies dengan real-time notifications
- Status management (open, pending, closed)

### 🔔 Notification System
- Database, Email, WebPush notifications
- User notification preferences
- Admin notification settings
- Async notification dispatch

### 🌐 API System
- RESTful API dengan Laravel Sanctum
- Token-based authentication dengan abilities
- Rate limiting dengan throttle middleware

### 📝 Content Management
- Blog dengan categories & tags
- Help Center dengan searchable articles
- News & Announcements
- Static pages (Terms, Privacy)

---

## 🛠️ Technology Stack

| Layer | Technology | Version |
|-------|------------|---------|
| Backend | Laravel | 12.x |
| Realtime | Livewire | 4.x |
| Styling | TailwindCSS | 4.x |
| JavaScript | Alpine.js | 3.x |
| Build Tool | Vite | 7.x |
| Auth | Sanctum, Socialite | Latest |
| RBAC | Spatie Permission | 6.x |
| Media | Spatie Media Library | 11.x |
| Cache | Redis (recommended) | - |

---

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL / PostgreSQL / SQLite
- Redis (optional, recommended)

---

## 🚀 Installation

### 1. Clone Repository

```bash
git clone https://github.com/andisiahaan/starter.git my-project
cd my-project
```

### 2. Quick Setup (Recommended)

```bash
composer setup
```

Ini akan menjalankan:
- `composer install` + copy `.env` + `php artisan key:generate`
- Run migrations + `npm install` + `npm run build`

### 3. Manual Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run build
```

### 4. Configure Environment

Edit `.env` file:

```env
# Application
APP_NAME="Your App Name"
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Queue (untuk notifications & scheduled jobs)
QUEUE_CONNECTION=database

# Cache (recommended: redis)
CACHE_STORE=redis

# Mail
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password

# Tripay Payment Gateway
TRIPAY_API_KEY=your-api-key
TRIPAY_PRIVATE_KEY=your-private-key
TRIPAY_MERCHANT_CODE=your-merchant-code

# Google OAuth (optional)
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret

# WebPush (optional)
VAPID_PUBLIC_KEY=your-public-key
VAPID_PRIVATE_KEY=your-private-key
```

---

## 💻 Development

### Start Development Server

```bash
composer dev
```

Menjalankan bersamaan:
- 🌐 `php artisan serve` - Laravel server
- 📮 `php artisan queue:listen` - Queue worker  
- 📋 `php artisan pail` - Real-time logs
- ⚡ `npm run dev` - Vite dev server

### Scheduled Commands

Jalankan scheduler untuk production:

```bash
# Crontab (production)
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1

# Development
php artisan schedule:work
```

**Scheduled Jobs:**
- `orders:cancel-expired` - Every 5 minutes
- `referral:process-available` - Hourly
- `referral:process-expired` - Daily

---

## 📁 Project Structure

```
├── app/
│   ├── Console/Commands/     # Artisan commands
│   ├── Enums/                # OrderStatus, ReferralBalanceLogType, etc.
│   ├── Helpers/              # Alert, Toast, NotificationHelper
│   ├── Http/Controllers/     # API Controllers
│   ├── Livewire/
│   │   ├── Admin/            # Admin panel components
│   │   └── App/              # User dashboard components
│   ├── Models/               # Eloquent models
│   ├── Notifications/        # Notification classes
│   ├── Observers/            # OrderObserver, ReferralCommissionObserver
│   └── Services/             # ReferralService, TripayService
├── database/migrations/      # Database migrations
├── resources/
│   ├── lang/en/              # Translation files
│   └── views/                # Blade views
└── routes/
    ├── web.php               # Public & auth routes
    ├── admin.php             # Admin panel routes
    ├── app.php               # User dashboard routes
    ├── api.php               # API routes (rate limited)
    └── console.php           # Scheduled commands
```

---

## 🔑 Default Routes

| Route | Description |
|-------|-------------|
| `/` | Landing page |
| `/login`, `/register` | Authentication |
| `/app` | User dashboard |
| `/app/account` | Account settings |
| `/app/credits` | Credit management |
| `/app/orders` | Order history |
| `/app/referral` | Referral dashboard |
| `/app/referral/withdrawals` | Withdrawal management |
| `/app/tickets` | Support tickets |
| `/admin` | Admin dashboard |
| `/admin/users` | User management |
| `/admin/roles` | Role management |
| `/admin/orders` | Order management |
| `/admin/referral` | Referral management |
| `/admin/settings` | Application settings |

---

## 📦 Key Packages

| Package | Purpose |
|---------|---------|
| `livewire/livewire` | Full-stack reactive components |
| `spatie/laravel-permission` | Roles & permissions |
| `spatie/laravel-activitylog` | Activity logging |
| `spatie/laravel-medialibrary` | File attachments |
| `laravel/sanctum` | API authentication |
| `laravel/socialite` | OAuth authentication |
| `pragmarx/google2fa-laravel` | Two-factor auth |
| `laravel-notification-channels/webpush` | Push notifications |

---

## 🔔 Notification Setup

Lihat [NOTIFICATION_SETUP.md](NOTIFICATION_SETUP.md) untuk dokumentasi lengkap sistem notifikasi.

---

## 🏗️ Key Enums

### OrderStatus
```php
use App\Enums\OrderStatus;

OrderStatus::PENDING->getLabel();   // "Pending"
OrderStatus::PAID->getColor();      // CSS classes
OrderStatus::PAID->getIcon();       // Heroicon name
OrderStatus::PAID->isPaid();        // true
```

### ReferralBalanceLogType
```php
use App\Enums\ReferralBalanceLogType;

ReferralBalanceLogType::COMMISSION_AVAILABLE;  // Commission added to balance
ReferralBalanceLogType::WITHDRAWAL_PENDING;    // Withdrawal requested
ReferralBalanceLogType::WITHDRAWAL_REJECTED;   // Balance restored
```

---

## 🧪 Testing

```bash
composer test
```

---

## 🚀 Production Checklist

- [ ] Set `APP_ENV=production` dan `APP_DEBUG=false`
- [ ] Configure `QUEUE_CONNECTION=redis`
- [ ] Setup cron job untuk `php artisan schedule:run`
- [ ] Run `php artisan optimize`
- [ ] Configure supervisor untuk queue workers
- [ ] Setup SSL certificate

---

## 🤝 Contributing

Contributions are welcome! Please submit a Pull Request.

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
