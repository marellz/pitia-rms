<template>
  <span
    class="h-5 w-5 text-xs font-bold rounded-full inline-flex items-center justify-center pt-0.5"
    :class="{[color] : !disabled}"
  >
    <slot />
  </span>
</template>
<script lang="ts" setup>
withDefaults(
  defineProps<{
    color?: string;
    disabled?: boolean,
  }>(),
  {
    color: "bg-blue text-white",
    disabled: false,
  }
);
</script>
