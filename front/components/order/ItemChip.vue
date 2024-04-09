<template>
  <div
    class="inline-flex items-center space-x-2 mb-2 mr-2 rounded-lg p-2"
    :class="[color]"
  >
    <p class="text-xl">
      {{ item.name }}
    </p>
    <button class="border rounded" type="button" @click="remove">
      <MinusIcon class="h-5" />
    </button>
  </div>
</template>
<script lang="ts" setup>
import { MinusIcon } from '@heroicons/vue/24/outline';

const props = withDefaults(defineProps<{
  item: {
    name: string,
    id: string,
    // todo: apply actual type
  };
  color?: string,
}>(),{
    color: "bg-gray-100"
});

const emit = defineEmits(["remove"]);
const id = computed(() => props.item.id);

const remove = () => emit("remove", id.value);
</script>
