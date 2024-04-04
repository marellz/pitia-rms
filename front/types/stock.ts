export interface StockItem {
  id?: string;
  name: string;
  description?: string;
  units: number;
  unit_type: string;
  cost_per_unit: number;
  servings_per_unit: number;

  // todo: remove the quantities from main item, in create page also
}

export interface StockQuantitiesItem {
  id?: string;
  name?: string,
  units?: number;
  cost_per_unit?: number;
  servings_per_unit?: number;
}