import { type OrderMenuItem } from "./orders";

export interface SaleItem {
  id: string,
  menu_item_id?: string,
  price: number,
  name: string,
}

export interface Sale {
  id?: string;
  status: string,
  amount: number;
  items: OrderMenuItem[];
}
