<template>
  <layout-container>
    <layout-form :title="`${isEdit ? 'Edit' : 'Add'} stock item`">
      <form @submit.prevent="submit">
        <div class="grid md:grid-cols-2 gap-5">
          <div>
            <form-input v-model="item.name" required label="Name"></form-input>
          </div>
          <div class="md:col-span-2">
            <form-textarea
              v-model="item.description"
              label="Description"
            ></form-textarea>
          </div>
          <div v-if="!isEdit">
            <form-input
              v-model="item.units"
              required
              type="number"
              label="Units"
            ></form-input>
          </div>
          <div>
            <form-select
              v-model="item.unit_type"
              required
              label="Unit type"
              placeholder="Select unit type"
            >
              <option v-for="(uT, i) in unitTypes" :key="i" :value="uT">
                {{ uT }}
              </option>
            </form-select>
          </div>
          <template v-if="!isEdit">
            <div>
              <form-input
                v-model="item.cost_per_unit"
                type="number"
                required
                label="Cost per unit"
              ></form-input>
            </div>
            <div>
              <form-input
                v-model="item.servings_per_unit"
                type="number"
                label="Servings per unit"
              ></form-input>
            </div>
          </template>
          <div class="md:col-span-2">
            <custom-button type="submit">Save changes</custom-button>
          </div>

        </div>
      </form>
     
    </layout-form>
  </layout-container>
</template>
<script lang="ts" setup>
import { onMounted, computed, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useStockStore } from "~/store/stock";
import { type StockItem } from "~/types/stock";

const route = useRoute();
const router = useRouter();
const store = useStockStore();
const isEdit = computed(() => route.params.id !== "create");
const id = computed(() => route.params.id);
const item = ref<StockItem>({
  units: 0,
  unit_type: "Kg",
  cost_per_unit: 0,
  servings_per_unit: 0,
});
const unitTypes = ref(["kg", "l", "each", "piece", "other",]);

onMounted(async () => {
  if (isEdit.value) {
    item.value = await store.get(id.value);
  }
});


const submit = async () => {
  let payload = item.value,
    response: boolean;

  try {
    if (isEdit.value) {
      response = await store.update(id.value, payload);
    } else {
      await store.create(payload);
    }

    router.push("/stock");
  } catch (error) {

    // todo: implement toast notifications
    console.error('Error occurred');
    
  }

};
</script>
