<template>
  <div class="p-3 rounded my-3" :class="colorVariant.bg">
    <h1 v-if="title" class="text-lg font-bold mb-2" :class="colorVariant.title">
      {{ title }}
    </h1>
    <div>
      <slot />
    </div>
  </div>
</template>
<script lang="ts" setup>
interface VariantColorTypes {
  bg: string;
  title: string;
}

interface VariantTypes {
  success: VariantColorTypes
  info : VariantColorTypes
  warning : VariantColorTypes
  danger : VariantColorTypes
}

const variants: VariantTypes = {
  success: { bg: "bg-green-200", title: "text-green-600" },
  info: { bg: "bg-blue-200", title: "text-blue-600" },
  warning: { bg: "bg-amber-200", title: "text-amber-600" },
  danger: { bg: "bg-red-200", title: "text-red-500" },
};

const props = withDefaults(
  defineProps<{
    title?: string;
    variant: "info" | "warning" | "danger" | "success";
  }>(),
  {
    variant: "info",
  }
);

const colorVariant = computed(
  () => variants[props.variant as keyof VariantTypes]
);
</script>
