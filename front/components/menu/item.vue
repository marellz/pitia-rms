<template>
  <div>
    <div class="border rounded-lg px-3 flex">
      <div class="py-3">
        <p class="text-xl font-medium">
          {{ item.name }}
        </p>
        <p class="text-gray-600">Ksh.{{ item.price }}</p>
      </div>
      <div class="flex items-center space-x-5 ml-auto flex-none">
        <button type="button" class="border p-2 rounded" @click="$emit('add')">
          <PlusIcon class="h-8" />
        </button>
      </div>
    </div>
  </div>
</template>
<script lang="ts" setup>
import { PlusIcon } from "@heroicons/vue/24/outline";
import type { MenuItem } from "~/types/menu";

defineProps<{
  item: MenuItem;
}>();

const emit = defineEmits(["add", "remove"]);
</script>

