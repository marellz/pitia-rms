<template>
  <div class="flex-auto pb-10">
    <layout-container class="flex justify-center">
      <div class="w-full lg:max-w-[450px] xl:max-w-[750px]">
        <div class="flex items-center justify-between mb-10">
          <layout-title class="!mb-0">New order</layout-title>
          <button
            type="button"
            :disabled="items.length > 0"
            class="border rounded py-2 px-4 inline-flex items-center space-x-2 disabled:opacity-50"
            @click="showIncompleteSales"
          >
            <p>Other orders</p>
            <custom-number-indicator
              v-if="sales.incomplete"
              :disabled="items.length > 0"
            >
              {{ sales.incomplete.length }}
            </custom-number-indicator>
            <ArrowRightIcon class="h-4" />
          </button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
          <menu-item
            v-for="item in menuItems"
            :key="item.id"
            :item="item"
            v-model="order.items"
            @add="addToOrder(item)"
          />
        </div>
      </div>
    </layout-container>
  </div>
  <custom-sidepanel
    :show="showSalesPanel"
    title="Pending sales"
    @close="showSalesPanel = false"
  >
    <div class="space-y-3" v-if="sales.incomplete.length">
      <order-list-item
        v-for="item in sales.incomplete"
        :key="item.id"
        :item="item"
        @update-order="editOrder"
        @complete-order="completeOrder"
      />
    </div>
    <div v-else class="py-5">
      <p class="text-lg text-center text-gray-600">No pending sales.</p>
    </div>
  </custom-sidepanel>
  <div
    class="sticky py-5 bottom-0 bg-white border-t w-full overflow-auto"
    v-show="items.length || order.items.length"
  >
    <layout-container class="flex flex-col lg:flex-row items-center">
      <div class="flex-auto">
        <div class="mb-2 flex items-center flex-wrap">
          <order-item-chip
            :item="item"
            v-for="item in order.items"
            :key="item.id"
            @remove="store.deleteItem(item.id)"
          />
          <order-item-chip
            color="bg-blue text-white"
            :item="item"
            v-for="item in items"
            :key="item.id"
            @remove="store.remove"
          />
        </div>
        <div class="flex items-center space-x-3">
          <h1 class="text-xl font-medium">Order total</h1>
          <span>&ndash;</span>
          <p>Ksh. {{ store.total }}</p>
        </div>
      </div>
      <div class="text-center py-10 lg:py-2">
        <custom-button
          v-if="order.id"
          :disabled="!items.length"
          class="!px-10 !py-3 text-2xl disabled:opacity-50"
          @click="updateOrder"
        >
          <span>Update order</span>
          <ArrowRightIcon class="h-7" />
        </custom-button>
        <custom-button
          v-else
          :disabled="!items.length"
          class="!px-10 !py-3 text-2xl disabled:opacity-50"
          @click="placeOrder"
        >
          <span>Place order</span>
          <ArrowRightIcon class="h-7" />
        </custom-button>
      </div>
    </layout-container>
  </div>
</template>
<script lang="ts" setup>
import { computed } from "vue";
import { ArrowRightIcon } from "@heroicons/vue/24/outline";
import { useMenuItemStore } from "~/store/menu";
import { useSalesStore } from "~/store/sales";
import { useOrdersStore } from "~/store/orders";
import type { MenuItem } from "~/types/menu";

definePageMeta({
  layout: "order",
});

const store = useOrdersStore();
const menuItemStore = useMenuItemStore();
const sales = useSalesStore();
const showSalesPanel = ref(false);

// todo: optimize these
menuItemStore.all();
sales.getIncomplete();

const menuItems = computed(() => menuItemStore.items);

// todo: group items and add quantity
const order = computed(() => store.order);
const items = computed(() => store.items);

const placeOrder = () => store.place();

const addToOrder = (item: MenuItem) => {
  store.add(item);
};

const showIncompleteSales = () => {
  showSalesPanel.value = true;
};

const editOrder = (id: string) => {
  let exists = store.edit(id);
  if (exists) {
    showSalesPanel.value = false;
  }
};

const updateOrder = () => {
  store.update();
};

const completeOrder = (id: string) => store.complete(id);
</script>
