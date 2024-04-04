<template>
  <layout-container>
    <div class="flex">
      <div class="flex-auto">
        <layout-title>Servings & prep</layout-title>
      </div>
      <nuxt-link to="/preps/create">
        <custom-button>
          <PlusIcon class="h-5" />
          <span>New serving</span>
        </custom-button>
      </nuxt-link>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
      <serving-card
        v-for="item in items"
        :item="item"
        @update-quantities="editServingQuantities"
      ></serving-card>
    </div>
  </layout-container>
  <custom-modal
    v-if="currentServingQuantities"
    title="Update serving quantities"
    :show="showQuantitesFormModal"
    @close="cancelServingQuantitesForm"
  >
    <h1 class="text-2xl mb-5">
      {{ currentServingQuantities.name }}
    </h1>
    <hr class="mb-5" />

    <form @submit.prevent="updateQuantities">
      <div class="grid md:grid-cols-2 gap-5">
        <div>
          <form-input
            v-model="currentServingQuantities.units"
            type="number"
            required
            label="Additional units"
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
import { useServingsStore } from "~/store/servings";
import { type ServingItem, type ServingItemQuantities } from "~/types/servings";

const store = useServingsStore();

const items = computed(() => store.items);

const currentServingQuantities = ref<ServingItemQuantities>({});
const showQuantitesFormModal = ref(false);

const editServingQuantities = (serving: ServingItem) => {
  let { id, name } = serving;
  currentServingQuantities.value = { id, name, units: 0 };
  showQuantitesFormModal.value = true;
  console.log(currentServingQuantities.value);
};

const cancelServingQuantitesForm = () => {
  currentServingQuantities.value = {};
  showQuantitesFormModal.value = false;
};

const updateQuantities = async () => {
  let item = currentServingQuantities.value;

  if (item && item.id) {
    let updated = await store.updateQuantities(item.id, item);

    if (updated) {
      cancelServingQuantitesForm();
    }
  }
};

store.all();
</script>
