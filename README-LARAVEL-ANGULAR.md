# SACCO Microfinance Admin Panel - Laravel + Angular

A comprehensive Microfinance SACCO (Savings and Credit Cooperative) Admin Management System built with **Laravel** backend and **Angular** frontend.

## 🏗️ Tech Stack

### Backend (Laravel)
- **Framework**: Laravel 10.x
- **Language**: PHP 8.1+
- **Database**: MySQL/MariaDB
- **API**: RESTful endpoints with proper validation

### Frontend (Angular)
- **Framework**: Angular 17
- **Language**: TypeScript
- **Styling**: Bootstrap 5.3
- **HTTP**: Angular HttpClient

## 📁 Project Structure

```
sacco-laravel-angular/
├── backend/                 # Laravel Backend
│   ├── app/
│   │   ├── Http/Controllers/
│   │   └── Models/
│   ├── database/migrations/
│   ├── routes/api.php
│   └── .env.example
├── frontend/               # Angular Frontend
│   ├── src/
│   │   ├── app/
│   │   │   ├── models/
│   │   │   ├── services/
│   │   │   └── components/
│   │   └── environments/
│   ├── angular.json
│   └── package.json
└── database-schema.sql     # MySQL schema
```

## 🚀 Quick Start

### Prerequisites
- PHP 8.1+
- Composer
- Node.js 18+
- MySQL 5.7+ or MariaDB
- Angular CLI

### Backend Setup (Laravel)

1. **Navigate to backend directory:**
   ```bash
   cd backend
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Setup environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database in .env:**
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sacco_management
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations:**
   ```bash
   php artisan migrate
   ```

6. **Start Laravel server:**
   ```bash
   php artisan serve --port=8000
   ```

### Frontend Setup (Angular)

1. **Navigate to frontend directory:**
   ```bash
   cd frontend
   ```

2. **Install dependencies:**
   ```bash
   npm install
   ```

3. **Install Bootstrap:**
   ```bash
   npm install bootstrap
   ```

4. **Start Angular development server:**
   ```bash
   ng serve --port=4200
   ```

5. **Access the application:**
   Open http://localhost:4200 in your browser

## 🔧 API Endpoints

### Microfinances
- `GET /api/microfinances` - List all microfinances
- `POST /api/microfinances` - Create new microfinance
- `GET /api/microfinances/{id}` - Get specific microfinance
- `PUT /api/microfinances/{id}` - Update microfinance
- `DELETE /api/microfinances/{id}` - Delete microfinance

### Members
- `GET /api/members` - List all members with microfinance details
- `POST /api/members` - Register new member
- `PUT /api/members/activate` - Activate member
- `GET /api/members/{id}` - Get specific member
- `PUT /api/members/{id}` - Update member
- `DELETE /api/members/{id}` - Delete member

### Loans
- `GET /api/loans` - List all loans with member and microfinance details
- `POST /api/loans` - Create new loan application
- `GET /api/loans/{id}` - Get specific loan
- `PUT /api/loans/{id}` - Update loan
- `DELETE /api/loans/{id}` - Delete loan

## 📊 Features

### ✅ Core Functionality
- **Microfinance Management**: Create and manage multiple SACCO organizations
- **Member Registration**: Register members under specific microfinances
- **Member Activation**: Change member status from "Pending" to "Active"
- **Loan Applications**: Apply for loans on behalf of active members
- **Loan Tracking**: View all loan applications with detailed information

### ✅ Business Rules
- Members created with "Pending" status by default
- Only "Active" members can apply for loans
- Members cannot have multiple pending loan applications
- Comprehensive validation on both client and server side

### ✅ User Interface
- **Dashboard**: Real-time statistics and metrics
- **Microfinance Tab**: Create and view SACCOs
- **Members Tab**: Register and manage members
- **Loans Tab**: Apply for and track loans
- **Responsive Design**: Works on all screen sizes

## 🗄️ Database Schema

The system uses three main tables:

### Microfinances
- `id` (primary key)
- `name`, `description`, `address`, `phone`, `email`
- `created_at`, `updated_at`

### Members
- `id` (primary key)
- `microfinance_id` (foreign key)
- `first_name`, `last_name`, `id_number`, `phone`, `email`, `address`
- `status` (enum: Pending, Active)
- `created_at`, `updated_at`

### Loans
- `id` (primary key)
- `member_id` (foreign key)
- `loan_type` (enum: Emergency, Development, Business, Education)
- `amount`, `repayment_period`
- `status` (enum: Pending, Approved, Rejected)
- `created_at`, `updated_at`

## 🧪 Testing

### Backend Testing
```bash
cd backend
php artisan test
```

### Frontend Testing
```bash
cd frontend
ng test
```

## 🚀 Production Deployment

### Backend (Laravel)
1. Set `APP_ENV=production` in .env
2. Run `php artisan config:cache`
3. Run `php artisan route:cache`
4. Run `php artisan migrate --force`
5. Configure web server (Apache/Nginx)

### Frontend (Angular)
1. Build for production: `ng build --configuration production`
2. Deploy `dist/` folder to web server
3. Configure API URL in environment.prod.ts

## 🔧 Configuration

### CORS Setup
Add to Laravel's `config/cors.php`:
```php
'paths' => ['api/*'],
'allowed_origins' => ['http://localhost:4200'],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
```

### Environment Variables
- **Backend**: `.env` file
- **Frontend**: `src/environments/environment.ts`

## 📞 Support

For issues or questions:
1. Check the individual README files in `backend/` and `frontend/`
2. Review the API documentation at `http://localhost:8000/api/health`
3. Check browser console for frontend issues

## 📄 License

This project is licensed under the MIT License.

---

**Built with ❤️ for microfinance institutions and SACCOs**
