<template>
  <layout-container>
    <layout-form :title="`${isEdit ? 'Edit' : 'Add'} a menu item`">
      <form @submit.prevent="submit">
        <div class="grid md:grid-cols-2 gap-5">
          <div>
            <form-input v-model="item.name" required label="Name"></form-input>
          </div>
          <div>
            <form-select
              v-model="item.category.id"
              required
              label="category"
              placeholder="Select category"
            >
              <option
                v-for="category in categories"
                :key="category.id"
                :value="category.id"
              >
                {{ category.name }}
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
            <form-uploader v-model="image" label="Image"></form-uploader>
          </div>
          <div>
            <form-input
              v-model="item.price"
              required
              type="number"
              label="Price"
            ></form-input>
          </div>
          <div>
            <form-input
              v-model="item.sale_price"
              type="number"
              label="Sale price"
            ></form-input>
          </div>
          <div class="md:col-span-2">
            <custom-button type="submit">Save changes</custom-button>
          </div>
        </div>
      </form>
    </layout-form>
    <layout-form title="Add servings">
      <form @submit.prevent="updateServings">
        <ul>
          <li v-for="item in servings">
            <form-checkbox>{{ item.name }}</form-checkbox>
          </li>
        </ul>
        <div class="mt-10">
          <custom-button type="submit">Update</custom-button>
        </div>
      </form>
    </layout-form>
  </layout-container>
</template>
<script lang="ts" setup>
import { onMounted, computed, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useMenuItemStore } from "~/store/menu";
import { type MenuItem } from "~/types/menu";

const route = useRoute();
const router = useRouter();
const store = useMenuItemStore();
const isEdit = computed(() => route.params.id !== "create");
const id = computed(() => route.params.id);
const servings = computed(() => store.formResources.servings);
const categories = computed(() => store.formResources.categories);
const image = ref();
const item = ref<MenuItem>({
  name: '',
  price: 0,
  category: {
    id: '',
    name: ''
  },
});

onMounted(async () => {
  if (isEdit.value) {
    item.value = await store.get(id.value);
  }

  store.getFormResources();
});

const submit = async () => {
  let payload = item.value,
    response: boolean;

  if (isEdit.value) {
    response = await store.update(id.value, payload);
  } else {
    await store.create(payload);
  }

  router.push("/menu-items");
  // todo: implement toast notifications
};

const updateServings = () => {};
</script>
