import type { StockItem } from "./stock";

export interface ServingItem {
  id: string;
  name: string;
  description?: string,
  unit_type: string,
  units: number,
}

export interface ServingItemQuantities {
  id? : string,
  name?: string,
  units?: number,
}

export interface NewServingItem extends Omit<ServingItem, 'id'>{
  id?: string;
}

export interface ServingForm {
  stock: StockItem[],
  supply: {}[] // todo SupplyItem
}

export interface ServingQuantitiesItem {
  id?: string,
  units?: number
};