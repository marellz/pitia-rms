export interface Expense {
  id?: string;
  amount: number;
  expense_type:{
    id: string,
    name: string,
  };
  extra_details: string|null;
  created_by?: string;
  settled: boolean;
}

export interface ExpenseType {
  id?: string,
  name: string,
  description?: string,
}

export interface ExpenseForm {
  id? : string;
  amount?: number;
  expense_type_id?: string,
  settled?: boolean,
  extra_details?: string
}