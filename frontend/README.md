# SACCO Angular Frontend

This is the Angular frontend for the SACCO Microfinance Admin Panel, built with Angular 17 and Bootstrap 5.3.

## Prerequisites

- Node.js 18+
- npm or yarn
- Angular CLI

## Installation

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

4. **Start development server:**
   ```bash
   ng serve --port=4200
   ```

5. **Access the application:**
   Open http://localhost:4200 in your browser

## Project Structure

```
src/
├── app/
│   ├── components/
│   │   ├── dashboard/
│   │   ├── microfinance/
│   │   ├── member/
│   │   └── loan/
│   ├── models/
│   ├── services/
│   ├── app.component.html
│   ├── app-routing.module.ts
│   └── app.module.ts
├── environments/
└── styles.scss
```

## Features

- **Dashboard**: Overview of system statistics
- **Microfinance Management**: Create and view SACCO organizations
- **Member Management**: Register and activate members
- **Loan Management**: Apply for and track loans
- **Responsive Design**: Works on all screen sizes

## Development

### Build for production
```bash
ng build --configuration production
```

### Run tests
```bash
ng test
```

### Lint code
```bash
ng lint
```

## Configuration

Update API URL in `src/environments/environment.ts`:
```typescript
export const environment = {
  production: false,
  apiUrl: 'http://localhost:8000/api'
};
```

## Bootstrap Integration

Bootstrap 5.3 is integrated via:
- CSS: `node_modules/bootstrap/dist/css/bootstrap.min.css`
- JS: `node_modules/bootstrap/dist/js/bootstrap.bundle.min.js`

## API Integration

The frontend connects to the Laravel backend at:
- Microfinances: `/api/microfinances`
- Members: `/api/members`
- Loans: `/api/loans`
