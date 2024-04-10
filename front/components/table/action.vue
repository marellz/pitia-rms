<template>
  <button
    type="button"
    title="Mark as settled"
    class="flex items-center space-x-2 rounded-full px-3 py-1 disabled:opacity-50 disabled:cursor-not-allowed"
    :class="color"
    :disabled="disabled"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>
<script lang="ts" setup>
withDefaults(
  defineProps<{
    color?: string;
    disabled?: boolean,
  }>(),
  {
    color: "text-gray-600 bg-gray-100",
    disabled: false,
  }
);

defineEmits(['click'])
</script>
