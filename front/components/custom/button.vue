<template>
  <button
    class="inline-flex justify-center items-center py-2 font-medium px-5 rounded-lg border space-x-2 hover:border-blue-200 focus:ring-blue-500"
    :type="type"
    :class="colors[color]"
  >
    <slot />
  </button>
</template>
<script lang="ts" setup>
import { computed } from "vue";
interface BtnProps {
  color?: "primary" | "secondary";
  type?: "submit" | "button" | "reset";
}

withDefaults(defineProps<BtnProps>(), {
  type: "button",
  color: "primary",
});

const colors = {
  primary: "border-blue bg-blue text-white",
  secondary: "border-blue text-blue",
};
</script>
