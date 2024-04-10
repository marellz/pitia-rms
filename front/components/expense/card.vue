<template>
<div>
    {{ item}}
</div>
</template>
<script lang="ts" setup>
import type { Expense } from "~/types/expenses";

defineProps<{
  item: Expense;
}>();

const emit = defineEmits(["add", "remove"]);
</script>
