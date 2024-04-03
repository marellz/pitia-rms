<template>
  <div class="mb-10">
    <fieldset class="border-2 p-10 rounded-xl">
      <legend class="ml-10 px-10">
        <layout-title class="!mb-0">{{ title }}</layout-title>
      </legend>
      <slot />
    </fieldset>
  </div>
</template>
<script lang="ts" setup>
defineProps<{
    title?: string
}>()
</script>
