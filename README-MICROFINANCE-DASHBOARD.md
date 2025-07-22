# Microfinance Dashboard

A comprehensive admin panel for managing microfinance SACCOs (Savings and Credit Cooperative Organizations), members, and loan applications. Built with Laravel 10.x backend and Angular 17 frontend.

## 🏗️ Tech Stack

### Backend
- **Laravel 10.x** - PHP 8.1+
- **MySQL** - Database
- **RESTful API** - API endpoints with proper validation
- **UUID** - Primary keys for all entities
- **Eloquent ORM** - Database relationships

### Frontend
- **Angular 17** - TypeScript
- **Bootstrap 5.3** - UI Framework
- **Reactive Forms** - Form validation
- **HttpClient** - HTTP communication
- **Responsive Design** - Mobile-friendly

## 📋 Features

### ✅ Microfinance Management
- Create new microfinance SACCOs
- View all microfinances with statistics
- Edit microfinance details
- Delete microfinances

### ✅ Member Management
- Register members under microfinances
- Activate pending members
- View member details and status
- Member validation and uniqueness checks

### ✅ Loan Management
- Apply for loans on behalf of members
- View all loan applications
- Loan eligibility checks
- Loan status tracking (Pending, Approved, Rejected)

### ✅ Dashboard
- Real-time statistics
- Quick actions
- Recent activities overview

## 🚀 Quick Start

### Prerequisites
- PHP 8.1+
- Composer
- Node.js 18+
- MySQL 8.0+
- Angular CLI

### Backend Setup (Laravel)

```bash
# Navigate to backend directory
cd backend

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=microfinance_dashboard
DB_USERNAME=root
DB_PASSWORD=

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed

# Start development server
php artisan serve --port=8000
```

### Frontend Setup (Angular)

```bash
# Navigate to frontend directory
cd frontend

# Install dependencies
npm install

# Start development server
ng serve --port=4200
```

## 📊 Database Schema

### Microfinances
- `id` - UUID primary key
- `name` - SACCO name
- `description` - Detailed description
- `address` - Physical address
- `phone` - Contact phone
- `email` - Contact email

### Members
- `id` - UUID primary key
- `microfinance_id` - Foreign key to microfinance
- `first_name`, `last_name` - Member names
- `id_number` - Unique identifier
- `phone`, `email` - Contact details
- `address` - Physical address
- `status` - Pending/Active

### Loans
- `id` - UUID primary key
- `member_id` - Foreign key to member
- `loan_type` - Emergency/Development/Business/Education
- `amount` - Loan amount
- `repayment_period` - In months
- `status` - Pending/Approved/Rejected

## 🔗 API Endpoints

### Microfinances
- `GET /api/microfinances` - List all microfinances
- `POST /api/microfinances` - Create new microfinance
- `GET /api/microfinances/{id}` - Get specific microfinance
- `PUT /api/microfinances/{id}` - Update microfinance
- `DELETE /api/microfinances/{id}` - Delete microfinance

### Members
- `GET /api/members` - List all members
- `POST /api/members` - Register new member
- `PUT /api/members/activate` - Activate member
- `GET /api/members/{id}` - Get specific member

### Loans
- `GET /api/loans` - List all loans
- `POST /api/loans` - Apply for new loan
- `GET /api/loans/{id}` - Get specific loan
- `PUT /api/loans/{id}` - Update loan status

## 🎯 Validation Rules

### Microfinance Creation
- Name: Required, max 255 characters
- Description: Required
- Address: Required
- Phone: Required, max 20 characters
- Email: Required, valid email, unique

### Member Registration
- First Name: Required, max 100 characters
- Last Name: Required, max 100 characters
- ID Number: Required, unique
- Phone: Required, max 20 characters
- Email: Required, valid email
- Address: Required

### Loan Application
- Member: Must be active
- Loan Type: Required, from predefined list
- Amount: Required, positive number
- Repayment Period: Required, positive integer

## 🛠️ Development

### Running Tests
```bash
# Backend tests
cd backend
php artisan test

# Frontend tests
cd frontend
ng test
```

### Code Quality
```bash
# Backend linting
cd backend
./vendor/bin/pint

# Frontend linting
cd frontend
ng lint
```

## 📁 Project Structure

```
microfinance-dashboard/
├── backend/                 # Laravel backend
│   ├── app/
│   │   ├── Http/
│   │   │   └── Controllers/
│   │   └── Models/
│   ├── database/
│   │   └── migrations/
│   └── routes/
├── frontend/               # Angular frontend
│   ├── src/
│   │   ├── app/
│   │   │   ├── components/
│   │   │   │   ├── dashboard/
│   │   │   │   ├── microfinance/
│   │   │   │   ├── member/
│   │   │   │   └── loan/
│   │   │   ├── models/
│   │   │   ├── services/
│   │   │   └── app.module.ts
│   │   └── environments/
│   └── angular.json
├── database-schema.sql    # Database schema
└── README.md
```

## 🎯 Business Rules

1. **Member Status**: Members are created with "Pending" status by default
2. **Activation**: Only admin can activate members
3. **Loan Eligibility**: Only active members can apply for loans
4. **Pending Loans**: Members cannot have multiple pending loan applications
5. **Validation**: All forms have comprehensive validation

## 🔧 Configuration

### Backend Configuration
- Update `.env` file with your database credentials
- Configure CORS in Laravel if needed
- Set up proper file permissions

### Frontend Configuration
- Update `environment.ts` with your API URL
- Configure proxy settings if needed

## 🚀 Production Deployment

### Backend
```bash
cd backend
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Frontend
```bash
cd frontend
ng build --configuration production
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License.

## 🆘 Support

For support, please open an issue on GitHub or contact the development team.

---

**Built with ❤️ for microfinance institutions and SACCOs**
