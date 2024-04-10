<template>
  <layout-container>
    <div class="flex justify-end pb-10">
      <custom-button @click="showExpenseTypesModal = true">
        <PlusIcon class="h-5" />
        <span>New expense type</span>
      </custom-button>
    </div>
    <layout-form :title="`${isEdit ? 'Edit' : 'Add'} an expense`">
      <form @submit.prevent="submit">
        <div class="grid md:grid-cols-2 gap-5">
          <form-input
            v-model="expense.amount"
            type="number"
            required
            label="Amount"
          ></form-input>

          <form-select
            v-model="expense.expense_type_id"
            required
            label="Expense type"
            placeholder="Select category"
          >
            <option
              v-for="category in store.expenseTypes"
              :key="category.id"
              :value="category.id"
            >
              {{ category.name }}
            </option>
          </form-select>

          <form-textarea
            class="md:col-span-2"
            v-model="expense.extra_details"
            label="Description"
          ></form-textarea>

          <div class="md:col-span-2">
            <custom-button type="submit">Save changes</custom-button>
          </div>
        </div>
      </form>
    </layout-form>
  </layout-container>

  <custom-modal
    title="New expense type"
    :show="showExpenseTypesModal"
    @close="closeExpenseTypesModal"
  >
    <form @submit.prevent="submitExpenseType">
      <div class="space-y-5">
        <div>
          <form-input
            v-model="expenseType.name"
            required
            label="Name"
          ></form-input>
        </div>
        <div>
          <form-textarea
            v-model="expenseType.description"
            label="Description"
          ></form-textarea>
        </div>
        <div class="md:col-span-2">
          <custom-button type="submit">Save changes</custom-button>
        </div>
      </div>
    </form>
  </custom-modal>
</template>
<script lang="ts" setup>
import { onMounted, computed, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { PlusIcon } from "@heroicons/vue/24/outline";
import { useExpenseStore } from "~/store/expenses";
import type { ExpenseType, ExpenseForm } from "~/types/expenses";
const store = useExpenseStore();
const route = useRoute();
const router = useRouter();
const showExpenseTypesModal = ref(false);
const isEdit = computed(() => route.params.id !== "create");
const expenseId = computed(() => route.params.id);

const expenseType = ref<ExpenseType>({
  name: "",
  description: "",
});

const expense = ref<ExpenseForm>({});

onMounted(async () => {
  store.allTypes();

  if (isEdit.value) {
    let { id, amount, settled, extra_details, expense_type } = await store.get(
      expenseId.value
    );

    if(!extra_details){
      extra_details = ''
    }

    expense.value = {
      id,
      amount,
      expense_type_id: expense_type.id,
      settled,
      extra_details,
    };
  }
});

const submit = async () => {
  let success;
  if (isEdit.value) {
    success = await store.update(expenseId.value, expense.value);
  } else {
    success = await store.create(expense.value);
  }

  if (success) {
    router.push("/expenses");
  }
};
const closeExpenseTypesModal = () => {
  showExpenseTypesModal.value = false;
  expenseType.value = { name: "", description: "" };
};

const submitExpenseType = async () => {
  let success;
  if (expenseType.value.id) {
    success = await store.updateType(expenseType.value.id, expenseType.value);
  } else {
    success = await store.createType(expenseType.value);
  }
  if (success) {
    // todo: add toast!
    closeExpenseTypesModal();
  }
};
</script>
