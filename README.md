# SACCO Microfinance Admin Panel

A comprehensive Microfinance SACCO (Savings and Credit Cooperative) Admin Management System built with Next.js, TypeScript, and Tailwind CSS. This system allows administrators to manage microfinance SACCOs, register and activate members, and handle loan applications.

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

- **Frontend**: Next.js 15, React 19, TypeScript
- **Styling**: Tailwind CSS 4, shadcn/ui components
- **Forms**: React Hook Form with validation
- **Notifications**: Sonner for toast notifications
- **Data Storage**: JSON files (for development/demo purposes)
- **API**: Next.js API Routes (RESTful)

## Project Structure

```
src/
├── app/
│   ├── api/
│   │   ├── microfinances/
│   │   │   └── route.ts          # Microfinance CRUD operations
│   │   ├── members/
│   │   │   ├── route.ts          # Member CRUD operations
│   │   │   └── activate/
│   │   │       └── route.ts      # Member activation endpoint
│   │   └── loans/
│   │       └── route.ts          # Loan application operations
│   ├── layout.tsx                # Root layout
│   ├── page.tsx                  # Main dashboard
│   └── globals.css               # Global styles
├── components/
│   └── ui/                       # shadcn/ui components
└── lib/
    └── utils.ts                  # Utility functions
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

The system uses JSON files for data storage with the following structure:

### Microfinances
```json
{
  "id": "string",
  "name": "string",
  "description": "string",
  "address": "string",
  "phone": "string",
  "email": "string",
  "createdAt": "ISO string"
}
```

### Members
```json
{
  "id": "string",
  "microfinanceId": "string",
  "firstName": "string",
  "lastName": "string",
  "idNumber": "string",
  "phone": "string",
  "email": "string",
  "address": "string",
  "status": "Pending | Active",
  "createdAt": "ISO string"
}
```

### Loans
```json
{
  "id": "string",
  "memberId": "string",
  "loanType": "Emergency | Development | Business | Education",
  "amount": "number",
  "repaymentPeriod": "number",
  "status": "Pending | Approved | Rejected",
  "createdAt": "ISO string"
}
```

## Setup Instructions

### Prerequisites
- Node.js 18+ installed
- npm or yarn package manager

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd sacco-admin-panel
   ```

2. **Install dependencies**
   ```bash
   npm install
   ```

3. **Start the development server**
   ```bash
   npm run dev
   ```

4. **Access the application**
   Open your browser and navigate to `http://localhost:8000`

### Production Build

1. **Build the application**
   ```bash
   npm run build
   ```

2. **Start the production server**
   ```bash
   npm start
   ```

## Usage Guide

### 1. Creating Microfinances
- Navigate to the "Microfinances" tab
- Fill in the microfinance details (name, description, address, phone, email)
- Click "Create Microfinance"

### 2. Registering Members
- Go to the "Members" tab
- Select a microfinance from the dropdown
- Fill in member details (name, ID number, contact information)
- Members are created with "Pending" status by default

### 3. Activating Members
- In the Members list, find pending members
- Click the "Activate" button to change status to "Active"
- Only active members can apply for loans

### 4. Loan Applications
- Navigate to the "Loans" tab
- Select an active member from the dropdown
- Choose loan type (Emergency, Development, Business, Education)
- Enter loan amount and repayment period
- Submit the application

### 5. Dashboard Overview
- View system statistics and metrics
- Monitor recent activity
- Check system status and health

## Design Decisions & Trade-offs

### Data Storage
- **Decision**: Used JSON files instead of a database
- **Rationale**: Simplifies setup and deployment for demo purposes
- **Trade-off**: Not suitable for production; would need database integration

### Authentication
- **Decision**: No authentication system implemented
- **Rationale**: Focus on core SACCO functionality as specified
- **Trade-off**: Would need proper auth for production use

### Frontend Framework
- **Decision**: Used Next.js instead of Angular as suggested
- **Rationale**: Leveraged existing project setup and modern React ecosystem
- **Trade-off**: Different from original specification but more efficient given constraints

### Styling Approach
- **Decision**: Used Tailwind CSS with shadcn/ui components
- **Rationale**: Provides consistent, professional UI with minimal custom CSS
- **Trade-off**: Learning curve for developers unfamiliar with utility-first CSS

### Form Validation
- **Decision**: Client-side validation with React Hook Form
- **Rationale**: Better user experience with immediate feedback
- **Trade-off**: Still need server-side validation for security

## Future Enhancements

### Immediate Improvements
- Database integration (PostgreSQL/MySQL)
- User authentication and authorization
- Loan approval workflow
- Member profile management
- Advanced reporting and analytics

### Advanced Features
- SMS/Email notifications
- Document upload for loan applications
- Payment tracking and reminders
- Multi-currency support
- Audit logging
- Data export functionality

## Development Notes

### Code Quality
- TypeScript for type safety
- Consistent error handling
- Modular component structure
- Responsive design principles
- Accessible UI components

### Performance Considerations
- Client-side data fetching with proper loading states
- Optimized re-renders with React best practices
- Efficient form handling
- Minimal bundle size with tree shaking

## Troubleshooting

### Common Issues

1. **Port already in use**
   ```bash
   # Kill process on port 8000
   fuser -k 8000/tcp
   # Then restart the dev server
   npm run dev
   ```

2. **Data not persisting**
   - Check if `data/` directory is created
   - Ensure write permissions for the application

3. **Form validation errors**
   - Check browser console for detailed error messages
   - Ensure all required fields are filled

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is licensed under the MIT License.

---

**Built with ❤️ for microfinance institutions and SACCOs**
