# Microfinance Dashboard - Setup Guide

## Quick Setup Script

### 1. Environment Setup

```bash
# Clone the repository
git clone <repository-url>
cd microfinance-dashboard

# Backend Setup
cd backend

# Install PHP dependencies
composer install

# Create environment file
cp .env.example .env

# Update .env with your database credentials
# DB_DATABASE=microfinance_dashboard
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Optional: Seed with sample data
php artisan db:seed

# Start Laravel development server
php artisan serve --port=8000

# In a new terminal, Frontend Setup
cd ../frontend

# Install Node.js dependencies
npm install

# Start Angular development server
ng serve --port=4200
```

### 2. Database Setup

```sql
-- Create database
CREATE DATABASE microfinance_dashboard;
USE microfinance_dashboard;

-- The migrations will create all necessary tables
-- Run: php artisan migrate
```

### 3. Testing the Application

1. **Backend Health Check**
   ```bash
   curl http://localhost:8000/api/microfinances
   ```

2. **Frontend Access**
   - Open browser to http://localhost:4200
   - Navigate through the dashboard

3. **Create First Microfinance**
   - Go to Microfinances tab
   - Fill in the form with sample data:
     - Name: "Umoja SACCO"
     - Description: "Community-based savings cooperative"
     - Address: "123 Main Street, Nairobi"
     - Phone: "+254700123456"
     - Email: "info@umojasacco.co.ke"

4. **Register First Member**
   - Go to Members tab
   - Select the created microfinance
   - Fill member details
   - Click "Register Member"

5. **Activate Member**
   - In the members list, click "Activate" for pending members

6. **Apply for Loan**
   - Go to Loans tab
   - Select the active member
   - Fill loan details
   - Submit application

### 4. Development Commands

#### Backend
```bash
# Run tests
php artisan test

# Clear cache
php artisan cache:clear
php artisan route:clear
php artisan config:clear

# Generate API documentation
php artisan route:list
```

#### Frontend
```bash
# Run tests
ng test

# Build for production
ng build --configuration production

# Check linting
ng lint

# Development with hot reload
ng serve --host 0.0.0.0 --port 4200
```

### 5. Production Deployment

#### Backend (Laravel)
```bash
cd backend
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### Frontend (Angular)
```bash
cd frontend
ng build --configuration production
# Serve from dist/ folder
```

### 6. Troubleshooting

#### Common Issues

1. **CORS Issues**
   - Ensure Laravel CORS is configured
   - Check `config/cors.php` settings

2. **Database Connection**
   - Verify MySQL is running
   - Check credentials in `.env`

3. **Port Conflicts**
   - Backend: Use `php artisan serve --port=8001`
   - Frontend: Use `ng serve --port=4201`

4. **Permission Issues**
   ```bash
   chmod -R 755 backend/storage
   chmod -R 755 backend/bootstrap/cache
   ```

### 7. API Testing

Use Postman or curl to test endpoints:

```bash
# Get all microfinances
curl http://localhost:8000/api/microfinances

# Create microfinance
curl -X POST http://localhost:8000/api/microfinances \
  -H "Content-Type: application/json" \
  -d '{"name":"Test SACCO","description":"Test","address":"Test","phone":"123","email":"test@test.com"}'

# Get all members
curl http://localhost:8000/api/members

# Activate member
curl -X PUT http://localhost:8000/api/members/activate \
  -H "Content-Type: application/json" \
  -d '{"member_id":"your-member-id"}'
```

### 8. Environment Variables

#### Backend (.env)
```env
APP_NAME="Microfinance Dashboard"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=microfinance_dashboard
DB_USERNAME=root
DB_PASSWORD=

CORS_ALLOWED_ORIGINS=http://localhost:4200
```

#### Frontend (environment.ts)
```typescript
export const environment = {
  production: false,
  apiUrl: 'http://localhost:8000/api'
};
```

### 9. Sample Data

After setup, you can use these sample data for testing:

**Microfinance:**
- Name: "Harambee SACCO"
- Description: "Community development microfinance"
- Address: "456 Harambee Avenue, Nairobi"
- Phone: "+254700987654"
- Email: "info@harambee.co.ke"

**Member:**
- First Name: "John"
- Last Name: "Kamau"
- ID Number: "12345678"
- Phone: "+254701234567"
- Email: "john.kamau@email.com"
- Address: "10 Kenyatta Road, Nairobi"

**Loan:**
- Type: "Business"
- Amount: 50000
- Repayment Period: 12 months

### 10. Support

For issues or questions:
1. Check the logs in `backend/storage/logs/`
2. Open browser developer tools for frontend issues
3. Verify all services are running
4. Check network tab for API calls
