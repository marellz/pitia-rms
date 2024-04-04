import { defineStore } from "pinia";
import { type StockItem, type StockQuantitiesItem } from "~/types/stock";

export const useStockStore = defineStore("stock", () => {
  const { $api } = useNuxtApp();
  const items = ref<StockItem[]>([]);

  const all = async () => {
    const { items: stock }: { items: StockItem[] } = await $api.get(`/stock`);
    items.value = stock;
  };

  const get = async (id: string | string[]) => {
    //
    const { item }: { item: StockItem } = await $api.get(`/stock/${id}`);

    return item;
  };

  const create = async (body: StockItem) => {
    const { item }: { item: StockItem } = await $api.post(`/stock/`, body);

    items.value.push(item);
  };

  const update = async (id: string | string[], body: StockItem) => {
    const { updated }: { updated: boolean } = await $api.put(
      `/stock/${id}`,
      body
    );

    return updated;
  };

  const updateQuantities = async (id: string, body: StockQuantitiesItem) => {
    const { units, cost_per_unit, servings_per_unit } = body;
    const { updated }: { updated: boolean } = await $api.put(
      `/stock/${id}/update-quantities`,
      { units, cost_per_unit, servings_per_unit, type: 'addition' }
    );

    // update this item
    all()

    return updated;
  };

  return {
    items,
    all,
    get,
    create,
    update,
    updateQuantities,
  };
});
