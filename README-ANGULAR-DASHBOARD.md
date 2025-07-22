# SACCO Angular Dashboard

A comprehensive Microfinance SACCO (Savings and Credit Cooperative) Admin Management System built with **Laravel** backend and **Angular** frontend.

## Features

### Core Functionality
- **Microfinance Management**: Create and manage multiple SACCO organizations
- **Member Registration**: Register members under specific microfinances with pending status
- **Member Activation**: Activate members to change status from "Pending" to "Active"
- **Loan Applications**: Apply for loans on behalf of active members
- **Loan Management**: View and track all loan applications with detailed information

### Dashboard Features
- Real-time statistics and metrics
- Recent activity tracking
- System status monitoring
- Responsive design for all screen sizes

### Business Rules
- Members are created with "Pending" status by default
- Only "Active" members can apply for loans
- Members cannot have multiple pending loan applications
- Comprehensive validation for all forms
- Proper error handling and user feedback

## Tech Stack

- **Backend**: Laravel 10.x, PHP 8.1+, MySQL
- **Frontend**: Angular 17, TypeScript, Bootstrap 5.3
- **Forms**: Reactive Forms with validation
- **HTTP**: Angular HttpClient
- **Database**: MySQL with proper relationships
- **API**: RESTful endpoints with proper validation

## Project Structure

```
angular-dashboard/
├── backend/                 # Laravel Backend
│   ├── app/
│   │   ├── Http/Controllers/ # API controllers
│   │   └── Models/         # Eloquent models
│   ├── database/migrations/ # Database schema
│   ├── routes/api.php      # RESTful endpoints
│   └── composer.json       # PHP dependencies
├── frontend/               # Angular Dashboard
│   ├── src/app/
│   │   ├── models/        # TypeScript interfaces
│   │   ├── services/      # HTTP services
│   │   ├── components/    # UI components
│   │   └── app.component.html # Main template
│   ├── angular.json       # Angular configuration
│   └── package.json       # Node dependencies
└── database-schema.sql    # MySQL schema
```

## API Endpoints

### Microfinances
- `GET /api/microfinances` - List all microfinances
- `POST /api/microfinances` - Create new microfinance

### Members
- `GET /api/members` - List all members with microfinance details
- `POST /api/members` - Register new member
- `PUT /api/members/activate` - Activate a member

### Loans
- `GET /api/loans` - List all loan applications with member and microfinance details
- `POST /api/loans` - Submit loan application

## Database Schema

The system uses MySQL with the following tables:

### Microfinances
```sql
- id (primary key)
- name, description, address, phone, email
- created_at, updated_at
```

### Members
```sql
- id (primary key)
- microfinance_id (foreign key)
- first_name, last_name, id_number, phone, email, address
- status (enum: Pending, Active)
- created_at, updated_at
```

### Loans
```sql
- id (primary key)
- member_id (foreign key)
- loan_type (enum: Emergency, Development, Business, Education)
- amount, repayment_period
- status (enum: Pending, Approved, Rejected)
- created_at, updated_at
```

## Setup Instructions

### Prerequisites
- PHP 8.1+
- Composer
- Node.js 18+
- MySQL 5.7+ or MariaDB
- Angular CLI

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd angular-dashboard
   ```

2. **Backend Setup**
   ```bash
   cd backend
   composer install
   cp .env.example .env
   php artisan key:generate
   # Configure database in .env
   php artisan migrate
   php artisan serve --port=8000
   ```

3. **Frontend Setup**
   ```bash
   cd frontend
   npm install
   ng serve --port=4200
   ```

4. **Access the application**
   - Backend API: http://localhost:8000/api
   - Frontend Dashboard: http://localhost:4200

### Production Build

1. **Backend**
   ```bash
   cd backend
   php artisan config:cache
   php artisan route:cache
   php artisan migrate --force
   ```

2. **Frontend**
   ```bash
   cd frontend
   ng build --configuration production
   ```

## Usage Guide

### 1. Creating Microfinances
- Navigate to the "Microfinances" section
- Fill in the microfinance details (name, description, address, phone, email)
- Click "Create Microfinance"

### 2. Registering Members
- Go to the "Members" section
- Select a microfinance from the dropdown
- Fill in member details (name, ID number, contact information)
- Members are created with "Pending" status by default

### 3. Activating Members
- In the Members list, find pending members
- Click the "Activate" button to change status to "Active"
- Only active members can apply for loans

### 4. Loan Applications
- Navigate to the "Loans" section
- Select an active member from the dropdown
- Choose loan type (Emergency, Development, Business, Education)
- Enter loan amount and repayment period
- Submit the application

### 5. Dashboard Overview
- View system statistics and metrics
- Monitor recent activity
- Check system status and health

## Design Decisions & Trade-offs

### Backend Architecture
- **Decision**: Used Laravel with MySQL for robust backend
- **Rationale**: Provides enterprise-grade API with proper validation
- **Benefit**: Scalable and maintainable codebase

### Frontend Architecture
- **Decision**: Used Angular with Bootstrap for responsive UI
- **Rationale**: Modern framework with excellent tooling
- **Benefit**: Professional UI with consistent styling

### Database Design
- **Decision**: MySQL with proper relationships and indexes
- **Rationale**: Reliable and performant for production use
- **Benefit**: ACID compliance and data integrity

## Development Notes

### Code Quality
- TypeScript for type safety (frontend)
- PHP 8.1+ features for backend
- Consistent error handling
- Modular component structure
- Responsive design principles

### Performance Considerations
- Database indexing for queries
- API response optimization
- Client-side caching
- Efficient form handling

## Troubleshooting

### Common Issues

1. **Port conflicts**
   ```bash
   # Backend
   php artisan serve --port=8001
   
   # Frontend
   ng serve --port=4201
   ```

2. **Database connection**
   - Check .env configuration
   - Ensure MySQL is running
   - Verify credentials

3. **CORS issues**
   - Configure Laravel CORS middleware
   - Update environment variables

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is licensed under the MIT License.

---

**Built with ❤️ for microfinance institutions and SACCOs using Laravel + Angular**
