export interface SuppliesItem {
    id: string,
    name: string,
    description: string,
    unit_type: string,
}

export interface NewSuppliesItem {
    id?: string,
    name?: string,
    description?: string,
    unit_type?: string,
}


export interface SuppliesQuantityItem {
  id?: string;
  units?: number,
}
