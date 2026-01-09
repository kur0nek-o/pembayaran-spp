# Pembayaran SPP - Project Setup Guide

## Project Information

### Laravel Version
- **Laravel Framework**: `^8.75` (Laravel 8)
- **Laravel Mix**: `^6.0.6`

### PHP Version Requirements
- **PHP**: `^7.3` or `^8.0`
- **Recommended**: PHP 7.4 or PHP 8.0

### Database
- **Type**: MySQL
- **Database Name**: `pembayaran_spp`
- **SQL File**: `pembayaran_spp.sql` (included in project root)

## Prerequisites

Before running this project, ensure you have the following installed:

1. **PHP** (7.3, 7.4, or 8.0)
   - Required extensions: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath
2. **Composer** (PHP dependency manager)
3. **MySQL** or **MariaDB** (database server)
4. **Node.js** and **npm** (for frontend assets)
5. **Apache** or **Nginx** web server (optional, can use PHP built-in server)

## Installation Steps

### 1. Clone the Repository (if not already cloned)
```bash
git clone <repository-url>
cd pembayaran-spp
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node.js Dependencies
```bash
npm install
```

### 4. Environment Configuration
```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Configure Database

Edit the `.env` file and update the database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pembayaran_spp
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

### 6. Create Database and Import Data

**Option A: Using MySQL command line**
```bash
# Create database
mysql -u root -p -e "CREATE DATABASE pembayaran_spp;"

# Import the SQL file
mysql -u root -p pembayaran_spp < pembayaran_spp.sql
```

**Option B: Using phpMyAdmin**
1. Open phpMyAdmin in your browser
2. Create a new database named `pembayaran_spp`
3. Select the database and click "Import"
4. Choose the `pembayaran_spp.sql` file from the project root
5. Click "Go" to import

### 7. Configure Storage Permissions

```bash
# For Linux/Mac
chmod -R 775 storage bootstrap/cache

# Or if you face permission issues
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### 8. Build Frontend Assets

```bash
# For development
npm run dev

# For production
npm run prod

# For watching changes during development
npm run watch
```

## Running the Application

### Method 1: Using PHP Built-in Server (Recommended for Development)
```bash
php artisan serve
```
The application will be accessible at: `http://localhost:8000`

### Method 2: Using Laravel Sail (Docker)
```bash
./vendor/bin/sail up
```

### Method 3: Using Apache/Nginx
Configure your web server to point to the `public` directory of the project.

**Apache Virtual Host Example:**
```apache
<VirtualHost *:80>
    DocumentRoot "/path/to/pembayaran-spp/public"
    ServerName pembayaran-spp.local
    
    <Directory "/path/to/pembayaran-spp/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Don't forget to add the domain to your hosts file:
```bash
# /etc/hosts (Linux/Mac) or C:\Windows\System32\drivers\etc\hosts (Windows)
127.0.0.1 pembayaran-spp.local
```

## Additional Commands

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Run Migrations (if needed)
```bash
php artisan migrate
```

### Run Database Seeders (if available)
```bash
php artisan db:seed
```

### Run Tests
```bash
php artisan test
# or
./vendor/bin/phpunit
```

## Installed Packages

### Backend (PHP)
- **barryvdh/laravel-dompdf** (^2.0) - PDF generation
- **fruitcake/laravel-cors** (^2.0) - CORS support
- **guzzlehttp/guzzle** (^7.0.1) - HTTP client
- **itsgoingd/clockwork** (^5.1) - Debugging and profiling
- **laravel/sanctum** (^2.11) - API authentication
- **laravel/tinker** (^2.5) - REPL for Laravel

### Frontend
- **axios** (^0.21) - HTTP client for JavaScript
- **lodash** (^4.17.19) - Utility library
- **postcss** (^8.1.14) - CSS processing

## Troubleshooting

### Common Issues

**Issue: "Class not found" error**
```bash
composer dump-autoload
```

**Issue: "Permission denied" on storage**
```bash
chmod -R 775 storage bootstrap/cache
```

**Issue: "No application encryption key has been specified"**
```bash
php artisan key:generate
```

**Issue: Database connection error**
- Verify MySQL is running
- Check database credentials in `.env`
- Ensure database `pembayaran_spp` exists

**Issue: Mix manifest not found**
```bash
npm run dev
```

## Project Structure

```
pembayaran-spp/
├── app/              # Application core (Models, Controllers, etc.)
├── bootstrap/        # Framework bootstrap files
├── config/           # Configuration files
├── database/         # Migrations, factories, seeders
├── public/           # Public assets (entry point)
├── resources/        # Views, assets (JS, CSS)
├── routes/           # Application routes
├── storage/          # Logs, cache, uploads
├── tests/            # Automated tests
└── vendor/           # Composer dependencies
```

## Documentation & Resources

- **Laravel 8 Documentation**: https://laravel.com/docs/8.x
- **PHP Documentation**: https://www.php.net/docs.php
- **Composer Documentation**: https://getcomposer.org/doc/

## Support

For issues or questions about this project, please refer to the repository's issue tracker or contact the development team.

---

**Last Updated**: January 2026
