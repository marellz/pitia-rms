<template>
  <div>
    <layout-container>
      <layout-form :title="`${isEdit ? 'Edit' : 'Add'} serving`">
        <form @submit.prevent="submit">
          <div class="grid md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
              <form-input
                v-model="item.name"
                required
                label="Name"
              ></form-input>
            </div>
            <div>
              <form-select
                v-model="item.stock_id"
                :required="item.supplies_id === null"
                :disabled="!!item.supplies_id"
                label="Stock"
                placeholder="Select unit type"
                @select="item.supply_id = null"
              >
                <option :value="null">No option</option>
                <option
                  v-for="stockItem in stock"
                  :key="stockItem.id"
                  :value="stockItem.id"
                >
                  {{ stockItem.name }}
                </option>
              </form-select>
            </div>
            <div>
              <form-select
                v-model="item.supplies_id"
                :disabled="item.stock_id !== null"
                label="Supplies item"
                placeholder="Select unit type"
                @select="item.stock_id = null"
              >
                <option :value="null">No option</option>
                <option
                  v-for="supplyItem in supplies"
                  :key="supplyItem.id"
                  :value="supplyItem.id"
                >
                  {{ supplyItem.name }}
                </option>
              </form-select>
            </div>
            <div class="md:col-span-2">
              <form-textarea
                v-model="item.description"
                label="Description"
              ></form-textarea>
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
            <div class="md:col-span-2">
              <custom-button type="submit">Save changes</custom-button>
            </div>
          </div>
        </form>
      </layout-form>
    </layout-container>
  </div>
</template>
<script lang="ts" setup>
import { onMounted, computed, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useServingsStore } from "~/store/servings";
import { useSuppliesStore } from "~/store/supplies";
import { useStockStore } from "~/store/stock";
import { type ServingItem, type NewServingItem } from "~/types/servings";

const route = useRoute();
const router = useRouter();
const store = useServingsStore();
const suppliesStore = useSuppliesStore();
const stockStore = useStockStore();
const isEdit = computed(() => route.params.id !== "create");
const stock = computed(() => stockStore.items);
const supplies = computed(() => suppliesStore.items);
const id = computed(() => route.params.id);
const item = ref<ServingItem | NewServingItem>({
  name: "",
  supply_id: null,
  stock_id: null,
});

const unitTypes = ref(["plate", "cup", "part"]);

onMounted(async () => {
  if (isEdit.value) {
    item.value = await store.get(id.value);
  }

  getFormResources();
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

    router.push("/preps");
  } catch (error) {
    // todo: implement toast notifications
    console.error("Error occurred");
  }
};

const getFormResources = () => {
  stockStore.all();
  suppliesStore.all();
};
</script>
