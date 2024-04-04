import { defineStore } from "pinia";
import { type SuppliesItem, type SuppliesQuantityItem } from "~/types/supplies";

export const useSuppliesStore = defineStore("supplies", () => {
    const { $api } = useNuxtApp();
    const items = ref<SuppliesItem[]>([]);

    const all = async () => {
      const { items: supplies }: { items: SuppliesItem[] } = await $api.get(`/supplies`);
      items.value = supplies;
    };

    const get = async (id: string | string[]) => {
      //
      const { item }: { item: SuppliesItem } = await $api.get(`/supplies/${id}`);

      return item;
    };

    const create = async (body: SuppliesItem) => {
      const { item }: { item: SuppliesItem } = await $api.post(`/supplies/`, body);

      items.value.push(item);
    };

    const update = async (id: string | string[], body: SuppliesItem) => {
      const { updated }: { updated: boolean } = await $api.put(
        `/supplies/${id}`,
        body
      );

      return updated;
    };

    const updateQuantities = async (id: string, body: SuppliesQuantityItem) => {
      const { units } = body;
      const { updated }: { updated: boolean } = await $api.put(
        `/supplies/${id}/update-quantities`,
        { units, type: "addition" }
      );

      // update
      all();


      return updated;

      // update THIS item
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
