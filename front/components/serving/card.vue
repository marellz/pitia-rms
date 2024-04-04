<template>
  <div
    class="border p-3 rounded-lg space-y-2"
    :class="{ 'md:row-span-2': moreInfoVisible }"
    ref="target"
  >
    <div class="flex">
      <div class="flex-auto">
        <h1 class="text-xl font-medium">
          {{ item.name }}
        </h1>
      </div>
      <div class="flex items-center space-x-2">
        <template v-if="moreInfoVisible">
          <button @click="editStock" type="button" class="border rounded p-1" title="Edit">
            <PencilSquareIcon class="h-6"></PencilSquareIcon>
          </button>
          <button @click="updateQuantities" type="button" class="border rounded p-1" title="Add stock">
            <PlusIcon class="h-6"></PlusIcon>
          </button>
        </template>
        <button
          type="button"
          class="border rounded p-1"
          title="Add stock"
          @click="moreInfoVisible = !moreInfoVisible"
        >
          <InformationCircleIcon class="h-6"></InformationCircleIcon>
        </button>
      </div>
    </div>
    <div :class="{ 'text-gray-600': !moreInfoVisible }">
      {{ item.units }} {{ item.unit_type }} available
    </div>
    <template v-if="moreInfoVisible">
      <!-- <div>Ksh. {{ item.cost_per_unit }} / {{ item.unit_type }}</div> -->
      <div class="bg-gray-50 p-2 my-2">
        <p class="text-gray-600">
          {{ item.description ?? "No description" }}
        </p>
      </div>
    </template>
  </div>
</template>
<script lang="ts" setup>
import { onClickOutside } from "@vueuse/core";
import { useRouter }from 'vue-router'
import {
  InformationCircleIcon,
  PencilSquareIcon,
  PlusIcon,
} from "@heroicons/vue/24/outline";
import type { ServingItem } from "~/types/servings";

const props = defineProps<{ item: ServingItem }>();
const emit = defineEmits(['update-quantities'])

const router = useRouter()
const target = ref(null);
const moreInfoVisible = ref(false);

onClickOutside(target, (event) => {
  moreInfoVisible.value = false;
});

const editStock = () => router.push(`/preps/${props.item.id}`)

const updateQuantities = () => emit('update-quantities', props.item)

</script>
