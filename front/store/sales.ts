import { defineStore } from "pinia";
import type { Sale } from "~/types/sales";
import { useOrdersStore } from "./orders";
import type { SaleItem } from "~/types/sales";

export const useSalesStore = defineStore("sales", () => {
  const { $api } = useNuxtApp();
  const orders = useOrdersStore();

  const items = ref<Sale[]>([]);
  const incomplete = ref<Sale[]>([]);

  const all = async () => {
    const { items: sales }: { items: Sale[] } = await $api.get(`/sales`);
    items.value = sales;
  };

  const create = async (body: Sale) => {
    const { item }: { item: Sale } = await $api.post(`/sales/`, body);

    // clear order

    incomplete.value.push({ ...item });

    orders.reset();
  };

  const getIncomplete = async () => {
    const { items }: { items: Sale[] } = await $api.get(
      `/sales?complete=0`
    );

    incomplete.value = items;
  };

  const updateSale = async (id: string, items: SaleItem[]) => {
    const body = {
      id,
      items,
      amount: orders.total,
    };

    const { updated }: { updated: boolean } = await $api.patch(
      `/sales/${id}`,
      body
    );

    if (updated) {
      // todo: toast
      orders.reset();

      getIncomplete();
    }
  };

  const removeItem = async (id: string) => {
    //
  }

  const complete = async (id: string) => {
    const { completed }: { completed: boolean } = await $api.put(
      `/sales/${id}/update-complete`,
      {
        completed: true,
      }
    );

    if(!completed){
      // todo: toast fail
    }

    let idx = incomplete.value.findIndex((or: Sale) => or.id === id);
    incomplete.value.splice(idx, 1)

  };

  return {
    items,
    all,
    incomplete,
    create,
    getIncomplete,
    removeItem,
    updateSale,
    complete,
  };
});
