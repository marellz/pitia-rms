<template>
  <layout-container>
    <div class="flex justify-between pb-10">
      <div>
        <layout-title>Menu items</layout-title>
      </div>
      <nuxt-link to="/menu-items/create">
        <custom-button>
          <plus-icon class="h-4" />
          <span>Add</span>
        </custom-button>
      </nuxt-link>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
      <a
        href="#"
        @click.prevent="editItem(item.id)"
        v-for="item in items"
        :key="item.id"
        class="border rounded-lg p-3 flex items-center"
      >
        <div class="flex-auto">
          <h1 class="text-lg font-medium">
            {{ item.name }}
          </h1>
          <p class="text-gray-500">Ksh. {{ item.price }}</p>
        </div>
        <button class="opacity-25 hover:opacity-100 transition">
          <PencilSquareIcon class="h-5"></PencilSquareIcon>
        </button>
      </a>
    </div>
  </layout-container>
</template>
<script lang="ts" setup>
import { computed, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useMenuItemStore } from "@/store/menu";
import { PlusIcon, PencilSquareIcon } from "@heroicons/vue/24/outline";
const store = useMenuItemStore();
const router = useRouter();
const items = computed(() => store.items);
onMounted(()=> store.all())
const editItem = (id: string) => {
  router.push(`/menu-items/${id}`);
};
</script>
