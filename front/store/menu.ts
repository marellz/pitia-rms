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
  const loading = ref(false)

  const all = async () => {
    loading.value = true
    const response: MenuItem[] = await $api.get(`/menu`);
    items.value = response;
    loading.value = false
  };

  const get = async (id: string | string[]) => {
    //
  
    const { item, loading: l }: { item: MenuItem, loading: boolean } = await $api.get(`/menu/${id}`);
    loading.value = l

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
    loading,
    items,
    all,
    get,
    create,
    update,
    getFormResources,
    formResources,
  };
});
