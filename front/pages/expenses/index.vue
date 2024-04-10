<template>
  <layout-container>
    <div class="flex pb-10">
      <div class="flex-auto">
        <layout-title>Expenses</layout-title>
      </div>
      <nuxt-link to="/expenses/create">
        <custom-button>
          <PlusIcon class="h-5" />
          <span>New expense</span>
        </custom-button>
      </nuxt-link>
    </div>
    <custom-table :items="items" :fields="fields">
      <template #settled="{ settled }">
        <custom-tag color="text-green-500 bg-transparent" v-if="settled">
          <span>Settled</span>
          <CheckCircleIcon class="h-4" />
        </custom-tag>
        <custom-tag color="text-red-500 bg-transparent" v-else>
          <span>Unsettled</span>
          <XCircleIcon class="h-4" />
        </custom-tag>
      </template>
      <template #amount="{ amount }">
        Ksh. {{ amount.toLocaleString() }}
      </template>
      <template #expense_type="{ expense_type, extra_details }">
        <p>{{ expense_type.name }}</p>
        <p class="text-gray-600 text-sm">{{ extra_details }}</p>
      </template>
      <template #created_by="{ created_by }">
        <div class="flex items-center space-x-2">
          <UserIcon class="h-4 text-gray-500" />
          <span>{{ created_by.name }}</span>
        </div>
      </template>
      <template #actions="{ id, settled }">
        <table-actions>
          <table-action
            color="text-amber-600 hover:bg-amber-100"
            @click="editExpense(id)"
            :disabled="settled"
          >
            <PencilIcon class="h-4" />
            <span class="text-sm">Edit</span>
          </table-action>
          <table-action
            @click="settleExpense(id)"
            color="text-green-500 hover:bg-green-100"
          >
            <DocumentCheckIcon class="h-4" />
            <span class="text-sm">Settled</span>
          </table-action>
        </table-actions>
      </template>
    </custom-table>
  </layout-container>
</template>
<script lang="ts" setup>
import {
  CheckCircleIcon,
  PlusIcon,
  XCircleIcon,
} from "@heroicons/vue/24/outline";
import {
  UserIcon,
  DocumentCheckIcon,
  PencilIcon,
} from "@heroicons/vue/24/solid";
import { useRouter } from "vue-router";
import { useExpenseStore } from "~/store/expenses";
const store = useExpenseStore();
const router = useRouter();
onMounted(() => {
  store.all();
});

const items = computed(() => store.items);

const fields = ref([
  { label: "Details", key: "expense_type" },
  { label: "Amount", key: "amount" },
  { label: "created by", key: "created_by" },
  { label: "Settled", key: "settled" },
  { label: "Actions", key: "actions" },
]);

const settleExpense = (id: string) => {
  store.settle(id);
};

const editExpense = (id: string) => {
  router.push(`/expenses/${id}`);
};
</script>
