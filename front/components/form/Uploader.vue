<template>
  <div class="flex flex-col">
    <label :for="id">
      <p v-if="label" class="block font-medium text-sm text-gray-700 mb-2">
        {{ label }}
      </p>

      <div
        class="relative border border-dashed space-x-2 py-2 px-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm flex items-center justify-center"
        :class="{ 'border-red-500': error }"
      >
        <CloudArrowUpIcon class="h-5" />
        <span>{{ selected && model ? model.name : placeholder }}</span>
        <button
          v-if="selected"
          type="button"
          class="absolute right-4 hover:text-red-600"
          @click="clearFile"
        >
          <XMarkIcon class="h-4" />
        </button>
      </div>
    </label>
    <input
      type="file"
      class="h-0 w-0 invisible"
      :id="id"
      :name="name"
      :disabled="disabled"
      @change="uploadFile"
    />

    <form-error v-if="error">
      {{ error }}
    </form-error>
  </div>
</template>
<script lang="ts" setup>
import { computed, onMounted } from "vue";
import { CloudArrowUpIcon, XMarkIcon } from "@heroicons/vue/24/outline";

withDefaults(
  defineProps<{
    label?: string;
    name?: string;
    disabled?: boolean;
    error?: string;
    placeholder?: string;
  }>(),
  {
    disabled: false,
    placeholder: "Upload file",
  }
);


const model = defineModel();
const id = useId();
const selected = computed(() => model.value !== null);

const uploadFile = (event: Event) => {
  let target = event.target as HTMLInputElement;
  if (target.files?.length) {
    model.value = target.files[0];
  }
};

onMounted(() => {
  model.value = null
})

const clearFile = () => {
  model.value = null;
};
</script>
