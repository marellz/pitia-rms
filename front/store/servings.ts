import { defineStore } from "pinia";
import {
  type ServingForm,
  type ServingItem,
  type ServingItemQuantities,
} from "~/types/servings";
export const useServingsStore = defineStore("servings", () => {
  const { $api } = useNuxtApp();
  const items = ref<ServingItem[]>([]);

  const all = async () => {
    const { items: stock }: { items: ServingItem[] } = await $api.get(
      `/servings`
    );
    items.value = stock;
  };

  const get = async (id: string | string[]) => {
    //
    const { item }: { item: ServingItem } = await $api.get(`/servings/${id}`);

    return item;
  };

  const create = async (body: ServingItem) => {
    body.units = 0;

    const { item }: { item: ServingItem } = await $api.post(`/servings/`, body);

    items.value.push(item);
  };

  const update = async (id: string | string[], body: ServingItem) => {
    const { updated }: { updated: boolean } = await $api.put(
      `/servings/${id}`,
      body
    );

    return updated;
  };

  const updateQuantities = async (
    id: string | string[],
    body: ServingItemQuantities
  ) => {
    const { units } = body;
    const { updated }: { updated: boolean } = await $api.put(
      `/servings/${id}/update-quantities`,
      {
        units,
        type: "addition",
      }
    );

    updateItem(id);

    return updated;
  };

  // todo: apply this pattern everywhere. probably use a composable
  const updateItem = async (id: string | string[]) => {
    let updatedItem = await get(id);
    let copyOfItems = [...items.value];
    let idx = copyOfItems.findIndex((it) => it.id === id);

    // note: although it was not clear to me why .splice() didn't work here
    // copyOfItems.splice(idx, idx, updatedItem)
    copyOfItems[idx] = updatedItem;

    items.value = copyOfItems;
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
