import { defineStore } from "pinia";
import type { Expense, ExpenseForm, ExpenseType } from "~/types/expenses";

export const useExpenseStore = defineStore("expenses", () => {
  const { $api } = useNuxtApp();
  const items = ref<Expense[]>([]);
  const expenseTypes = ref<ExpenseType[]>([]);

  const all = async () => {
    const { items: expenses }: { items: Expense[] } = await $api.get(
      "/expenses"
    );
    items.value = expenses;
  };

  const get = async (id: string | string[]) => {
    const { item }: { item: Expense } = await $api.get(`/expenses/${id}`);

    return item;
  };

  const create = async (body: ExpenseForm) => {
    const { item }: { item: Expense } = await $api.post("/expenses", body);

    if (item.id) {
      items.value.push(item);
    }

    return true;
  };

  const update = async (id: string | string[], body: ExpenseForm) => {
    const { updated }: { updated: boolean } = await $api.put(
      `/expenses/${id}`,
      body
    );

    all();

    return updated;
  };

  const settle = async (id: string | string[]) => {
    const { settled }: { settled: boolean } = await $api.put(
      `/expenses/${id}/update-settled`
    );

    all();

    return true;
  };

  // types

  const allTypes = async () => {
    const { items: ets }: { items: ExpenseType[] } = await $api.get(
      "/expense-types"
    );
    expenseTypes.value = ets;
  };

  const getType = async (id: string) => {
    const { item }: { item: ExpenseType } = await $api.get("/expense-types");

    return item;
  };

  const createType = async (body: ExpenseType) => {
    const { item }: { item: ExpenseType } = await $api.post(
      "/expense-types",
      body
    );

    expenseTypes.value.push(item);

    return true
  };

  const updateType = async (id: string, body: ExpenseType) => {
    const { updated }: { updated: boolean } = await $api.patch(
      `/expense-types/${id}`,
      body
    );

    allTypes()

    return updated
  };

  return {
    items,
    all,
    get,
    create,
    update,
    settle,

    //
    expenseTypes,
    allTypes,
    getType,
    createType,
    updateType,
  };
});
