export interface Loan {
  id: string;
  member_id: string;
  loan_type: 'Emergency' | 'Development' | 'Business' | 'Education';
  amount: number;
  repayment_period: number;
  status: 'Pending' | 'Approved' | 'Rejected';
  created_at: string;
  updated_at: string;
  member?: {
    id: string;
    first_name: string;
    last_name: string;
    microfinance?: {
      id: string;
      name: string;
    };
  };
}

export interface CreateLoanRequest {
  member_id: string;
  loan_type: 'Emergency' | 'Development' | 'Business' | 'Education';
  amount: number;
  repayment_period: number;
}

export const LOAN_TYPES = [
  { value: 'Emergency', label: 'Emergency' },
  { value: 'Development', label: 'Development' },
  { value: 'Business', label: 'Business' },
  { value: 'Education', label: 'Education' }
];
