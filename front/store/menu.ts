import { defineStore } from "pinia";
import {
  type MenuItem,
  type MenuItemForm,
  type NewMenuItem,
} from "~/types/menu";

export const useMenuItemStore = defineStore("menu", () => {
  const { $api } = useNuxtApp();
  const items = ref<MenuItem[]>([]);
  const formResources = ref<MenuItemForm>({});

  const all = async () => {
    const response: MenuItem[] = await $api.get(`/menu`);
    items.value = response;
  };

  const get = async (id: string | string[]) => {
    //
    const { item }: { item: MenuItem } = await $api.get(`/menu/${id}`);

    return item;
  };

  const create = async (body: NewMenuItem) => {
    const { item }: { item: MenuItem } = await $api.post(`/menu/`, body);

    items.value.push(item);
  };

  const update = async (id: string | string[], body: MenuItem | NewMenuItem) => {
    const { updated }: { updated: boolean } = await $api.put(
      `/menu/${id}`,
      body
    );

    return updated;
  };

  const getFormResources = async () => {
    const response: MenuItemForm = await $api.get(`/menu/create`);

    formResources.value = response;

    return response;
  };

  return {
    items,
    all,
    get,
    create,
    update,
    getFormResources,
    formResources,
  };
});
