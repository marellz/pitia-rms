<template>
  <layout-container>
    <div class="flex">
      <div class="flex-auto">
        <layout-title>Stock</layout-title>
      </div>
      <nuxt-link to="/stock/create">
        <custom-button>
          <PlusIcon class="h-5" />
          <span>New stock</span>
        </custom-button>
      </nuxt-link>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
      <stock-card
        v-for="item in items"
        :item="item"
        @update-quantities="editStockQuanties"
      ></stock-card>
    </div>
  </layout-container>
  <custom-modal
    v-if="currentStockQuantities"
    title="Update stock quantities"
    :show="showQuantitesFormModal"
    @close="cancelStockQuantitesForm"
  >
    <h1 class="text-2xl mb-5">
      {{ currentStockQuantities.name }}
    </h1>
    <hr class="mb-5" />

    <form @submit.prevent="updateQuantities">
      <div class="grid md:grid-cols-2 gap-5">
        <div>
          <form-input
            v-model="currentStockQuantities.units"
            type="number"
            required
            label="Additional units"
          ></form-input>
        </div>
        <div>
          <form-input
            v-model="currentStockQuantities.cost_per_unit"
            type="number"
            required
            label="Cost per unit"
          ></form-input>
        </div>
        <div>
          <form-input
            v-model="currentStockQuantities.servings_per_unit"
            type="number"
            required
            label="Servings per unit"
          ></form-input>
        </div>
        <div class="md:col-span-2">
          <custom-button type="submit">Save changes</custom-button>
        </div>
      </div>
    </form>
  </custom-modal>
</template>
<script lang="ts" setup>
import { PlusIcon } from "@heroicons/vue/24/outline";
import { useStockStore } from "~/store/stock";
import { type StockItem, type StockQuantitiesItem } from "~/types/stock";

const store = useStockStore();

const items = computed(() => store.items);

const currentStockQuantities = ref<StockQuantitiesItem>({});
const showQuantitesFormModal = ref(false);

const editStockQuanties = (stock: StockItem) => {
  let { id, cost_per_unit, servings_per_unit, name } = stock;
  currentStockQuantities.value = {
    id,
    name,
    cost_per_unit,
    servings_per_unit,
    units: 0,
  };
  showQuantitesFormModal.value = true;
  console.log(currentStockQuantities.value);
};

const cancelStockQuantitesForm = () => {
  currentStockQuantities.value = {};
  showQuantitesFormModal.value = false;
};

const updateQuantities = async () => {
  let item = currentStockQuantities.value;

  if (item && item.id) {
    let updated = await store.updateQuantities(item.id, item);

    if (updated) {
      cancelStockQuantitesForm();
    }
  }
};

store.all();
</script>
