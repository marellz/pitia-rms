<template>
  <div
    class="fixed inset-0 h-full w-full z-40 transform transition translate-x-full"
    :class="{ '!translate-x-0': show }"
  >
    <div
      class="bg-black opacity-40 fixed inset-0 h-full w-full"
      @click="close"
    ></div>
    <div class="relative flex justify-end z-50 h-full">
      <div class="bg-white w-full sm:w-2/3 lg:w-1/2 h-full overflow-auto" :class="width">
        <div v-if="title || $slots.header" class="border-b py-5 px-5 flex sticky top-0 bg-white">
            <slot name="header">
                <div class="flex-auto">
                    <h1 class="text-2xl font-bold">{{ title }}</h1>
                </div>
            </slot>
          <button type="button" @click="close">
            <x-mark-icon class="h-8" />
          </button>
        </div>
        <div class="p-5">
          <template v-if="!title && !$slots.header">
            <div class="flex justify-end pb-3">
                <button type="button" @click="close">
                  <x-mark-icon class="h-8" />
                </button>
            </div>
          </template>
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>
<script lang="ts" setup>
import { XMarkIcon } from "@heroicons/vue/24/solid";
defineProps({
  title: {
    type: String,
    default: null,
  },
  show: {
    type: Boolean,
    default: false,
  },
  width:{
    type: String,
    default: 'lg:max-w-[50vw]'
  }
});

const emit = defineEmits(["close"]);
const close = () => emit("close");
</script>
