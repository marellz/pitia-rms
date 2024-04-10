<template>
  <div
    class="inline-flex items-center space-x-2 rounded-full justify-center px-3 py-0.5 text-sm"
    :class="color"
  >
    <slot />
  </div>
</template>
<script lang="ts" setup>
withDefaults(
  defineProps<{
    color?: string;
  }>(),
  {
    color: "bg-green-500 text-white",
  }
);
</script>
