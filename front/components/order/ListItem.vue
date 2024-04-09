<template>
  <div class="border rounded-lg p-3" ref="target">
    <div class="flex items-center justify-between">
      <div>
        <div class="flex">
          <h1 class="text-xl font-bold">#{{ item.number }}</h1>
          <span class="ml-2 px-2 py-px rounded-xl bg-gray-100">{{
            item.status
          }}</span>
        </div>
        <div class="my-3">
          <p
            v-if="item.amount"
            class="inline-flex text-lg font-medium py-1 px-2 rounded-xl bg-red-300"
          >
            Ksh. {{ item.amount.toLocaleString() }}
          </p>
        </div>
      </div>

      <button
        type="button"
        class="h-10 w-10 border inline-flex items-center justify-center rounded-full transform"
        :class="{ 'rotate-180': itemActive }"
        @click="toggleItemActive"
      >
        <ChevronDownIcon class="h-5" />
      </button>
    </div>
    <div class="flex items-center space-x-2">
      <template v-if="item.created_by">
        <UserIcon class="h-4 text-gray-300" />
        <p>{{ item.created_by.name }}</p>
      </template>
      <span class="text-gray-300">|</span>
      <p>{{ item.created }}</p>
    </div>
    <template v-if="itemActive">
      <h1 class="font-medium my-4">Items</h1>
      <ul class="flex flex-wrap">
        <li v-for="menuItem in item.items" class="mb-1 mr-2">
          <span class="bg-gray-100 py-1 px-2 rounded-lg">
            {{ menuItem.name }}
          </span>
        </li>
      </ul>
      <div class="mt-5 flex justify-end space-x-2">
        <custom-button color="secondary" @click="updateOrder"
          >Update order</custom-button
        >
        <custom-button @click="completeOrder">Complete order</custom-button>
      </div>
    </template>
  </div>
</template>
<script lang="ts" setup>
import { ChevronDownIcon } from "@heroicons/vue/24/outline";
import { UserIcon } from "@heroicons/vue/24/solid";
import { onClickOutside } from "@vueuse/core";
import type { Order } from "~/types/orders";

const props = defineProps<{
  item: Order;
}>();

const emit = defineEmits(["update-order", "complete-order"]);

const itemActive = ref(false);
const target = ref();

onClickOutside(target, () => {
  itemActive.value = false;
});

const toggleItemActive = () => {
  itemActive.value = !itemActive.value;
};

const updateOrder = () => {
  emit("update-order", props.item.id);
};

const completeOrder = () => {
  emit("complete-order", props.item.id);
};
</script>
