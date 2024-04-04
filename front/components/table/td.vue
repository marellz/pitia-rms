<template>
  <td
    class="border-b first:border-l last:border-r align-middle border-gray-200 px-3 py-4 text-gray-700"
    @click="() => $emit('click')"
  >
    <span>
      <slot />
    </span>
  </td>
</template>
<script setup>
defineEmits(["click"]);
</script>
