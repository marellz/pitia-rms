<template>
  <tr :class="{ 'hover:bg-blue-100': hover }">
    <slot />
  </tr>
</template>
<script setup>
defineProps({
  hover: {
    type: Boolean,
    default: false,
  },
});
</script>
