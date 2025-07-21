export interface Microfinance {
  id: string;
  name: string;
  description: string;
  address: string;
  phone: string;
  email: string;
  created_at: string;
  updated_at: string;
  members_count?: number;
  active_members_count?: number;
  pending_loans_count?: number;
}

export interface CreateMicrofinanceRequest {
  name: string;
  description: string;
  address: string;
  phone: string;
  email: string;
}
