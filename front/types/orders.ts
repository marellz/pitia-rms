export interface OrderMenuItem {
  id: string;
  name: string;
  price: number;
  quantity?: number;
}

export interface SlimOrderItem extends OrderMenuItem {
  id: never;
}

export interface Order {
  id?: string;
  number?: string,
  amount: number;
  created?: string,
  created_by?: {
    id: string,
    name: string,
  }
  status: string,
  items: OrderMenuItem[];
}
