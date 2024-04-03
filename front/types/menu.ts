import type { Serving } from "./servings";

export interface MenuItem {
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

export interface MenuItemCategory {
  id: number,
  name: string,
}

export interface MenuItemForm {
  categories?: MenuItemCategory[];
  servings?: Serving[];
}
