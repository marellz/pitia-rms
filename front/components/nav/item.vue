<template>
  <nuxt-link
    class="rounded hover:bg-white hover:text-blue px-5 py-4 flex items-center space-x-2 text-lg font-light"
    :to="link.path"
  >
    <slot name="icon" />
    <span>{{ link.label }}</span>
  </nuxt-link>
</template>
<script lang="ts" setup>
defineProps<{
  link: {
    label: string,
    path: string,
  }
}>();
</script>
