# SACCO Laravel Backend

This is the Laravel backend for the SACCO Microfinance Admin Panel.

## Requirements

- PHP 8.1 or higher
- Composer
- MySQL 5.7+ or MariaDB
- Laravel 10.x

## Installation

1. **Navigate to backend directory:**
   ```bash
   cd backend
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Copy environment file:**
   ```bash
   cp .env.example .env
   ```

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

5. **Configure database in .env:**
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sacco_management
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations:**
   ```bash
   php artisan migrate
   ```

7. **Start the development server:**
   ```bash
   php artisan serve --port=8000
   ```

## API Endpoints

### Microfinances
- `GET /api/microfinances` - List all microfinances
- `POST /api/microfinances` - Create new microfinance
- `GET /api/microfinances/{id}` - Get specific microfinance
- `PUT /api/microfinances/{id}` - Update microfinance
- `DELETE /api/microfinances/{id}` - Delete microfinance

### Members
- `GET /api/members` - List all members
- `POST /api/members` - Register new member
- `GET /api/members/{id}` - Get specific member
- `PUT /api/members/{id}` - Update member
- `PUT /api/members/activate` - Activate member
- `DELETE /api/members/{id}` - Delete member

### Loans
- `GET /api/loans` - List all loans
- `POST /api/loans` - Create new loan application
- `GET /api/loans/{id}` - Get specific loan
- `PUT /api/loans/{id}` - Update loan
- `DELETE /api/loans/{id}` - Delete loan

## Database Setup

The migrations will create the following tables:
- `microfinances` - Stores SACCO organization details
- `members` - Stores member information with foreign key to microfinances
- `loans` - Stores loan applications with foreign key to members

## Business Rules

1. Members are created with "Pending" status by default
2. Only "Active" members can apply for loans
3. Members cannot have multiple pending loan applications
4. All fields are validated on both client and server side

## Testing

Run the following commands to test the API:

```bash
# Test all endpoints
php artisan test

# Test specific endpoint
php artisan test --filter MicrofinanceTest
```

## Production Deployment

1. Set `APP_ENV=production` in .env
2. Run `php artisan config:cache`
3. Run `php artisan route:cache`
4. Run `php artisan migrate --force`
5. Set up proper web server (Apache/Nginx)
