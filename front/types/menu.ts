import type { Serving } from "./servings";

export interface MenuItem {
  id: string,
  name : string;
  menu_item_category_id? : number;
  category: {
    id: string,
    name: string,
  }
  description? : string;
  price : number;
  sale_price? : number;
}

export interface NewMenuItem extends Omit<MenuItem, 'id'> {
  id?: string,
}

export interface MenuItemCategory {
  id?: string,
  name?: string,
}

export interface MenuItemForm {
  categories?: MenuItemCategory[];
  servings?: Serving[];
}
