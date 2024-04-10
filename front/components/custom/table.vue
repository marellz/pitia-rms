<template>
  <table class="table border-separate border-spacing-x-0 rounded w-full">
    <thead>
      <tr>
        <th
          v-for="(field, index) in fields"
          :key="`th-${index}`"
          class="border-t p-2 pb-3 first:border-l last:border-r border-gray-200 first:rounded-tl-lg last:rounded-tr-lg text-left bg-gray-200"
        >
          <span class="text-xs font-bold uppercase text-gray-500">
            {{ field.label }}
          </span>
        </th>
      </tr>
    </thead>
    <tbody>
      <template v-if="items && items.length">
        <table-tr v-for="(item, index) in items" :key="`tr-${index}`">
          <table-td
            v-for="(field, i) in fields"
            :key="`td-${i}`"
            :width="field.width"
            @click="() => $emit('row-click', item[rowKey])"
          >
            <slot :name="field.key" v-bind="item">
              {{ item[field.key] }}
            </slot>
          </table-td>
        </table-tr>
      </template>
      <template v-else>
        <table-tr>
          <table-td :colspan="fields.length">
            <p class="text-sm text-center text-gray-500 py-3">{{ loading ? 'Loading' : 'No data'}}</p>
          </table-td>
        </table-tr>
      </template>
    </tbody>
    <tfoot>
      <tr>
        <table-td class="rounded-b-lg" :colspan="fields.length">
          <!-- todo: add pagination -->
          <p class="text-center">Showing <span class="font-bold">{{ items.length }}</span> items</p>
        </table-td>
      </tr>
    </tfoot>
  </table>
</template>
<script setup>
defineProps({
  fields: {
    type: Array,
    default: () => [],
  },
  items: {
    type: Array,
    default: () => [],
  },
  rowKey: {
    type: String,
    default: "id",
  },
  loading: {
    type: Boolean,
    default: false,
  },
});

defineEmits(["row-click"]);
</script>
