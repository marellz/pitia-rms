import { defineStore } from "pinia";
import { useSalesStore } from "./sales";
import type { Order } from "~/types/orders";
import type { MenuItem } from "~/types/menu";

export const useOrdersStore = defineStore("orders", () => {
  const salesStore = useSalesStore();

  const order = ref<Order>({
    amount: 0,
    items: [],
    status: "pending"
  });

  const total = computed(() => order.value.amount);

  const items = ref<MenuItem[]>([]);

  const add = (item: MenuItem) => {
    items.value.push(item);
    recalculate();
  };

  const remove = (id: string) => {
    let itIdx = items.value.findIndex((i: MenuItem) => i.id === id);
    let newItems = [...items.value];
    newItems.splice(itIdx, 1);
    items.value = newItems;

    recalculate();
  };

  const recalculate = () => {
    let amount = 0;
    let calculate = [...items.value, ...order.value.items];
    calculate.forEach((i) => (amount += i.price));

    order.value = { ...order.value, amount };
  };

  const place = () => {
    let body = {
      status: "pending",
      amount: order.value.amount,
      items: items.value,
    };

    salesStore.create(body);
  };

  const reset = () => {
    order.value = { amount: 0, items: [], status: 'pending' };
    items.value = [];
  };

  const edit = (id: string) => {
    let sale = salesStore.incomplete.find((s) => s.id === id);
    if (sale) {
      order.value = sale;
      return true;
    }

    recalculate();

    return false;
  };

  const update = () => {
    if (order.value.id) {
      salesStore.updateSale(order.value.id, items.value);
    }
  };

  const deleteItem = (id: string) => {
    // remove menu-item ${id} from that sale
    salesStore.removeItem(id);
  };

  const complete = (id: string) => {
    salesStore.complete(id);
  };

  return {
    order,
    total,
    items,
    add,
    remove,
    place,
    reset,
    edit,
    update,
    complete,
    deleteItem,
  };
});
