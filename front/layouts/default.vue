<template>
  <div class="h-[100vh] flex">
    <nav
      ref="nav"
      class="bg-blue text-white max-w-[100vw] w-96 sm:w-72 xl:w-96 flex-none py-20 flex justify-center fixed h-[100vh] lg:relative transform transition lg:transform-none -translate-x-full z-40 overflow-auto"
      :class="{ '!translate-x-0': navActive }"
    >
      <li class="absolute top-6 right-10 list-none lg:hidden">
        <button type="button" class="text-white" @click="navActive = false">
          <ArrowLeftIcon class="h-10" />
        </button>
      </li>
      <ul>
        <li class="mb-10">
          <nav-item :link="newOrderPath" class="!font-bold">
            <template #icon>
              <PlusCircleIcon class="h-8" />
            </template>
          </nav-item>
        </li>

        <li v-for="(link, index) in links" :key="index">
          <nav-item :link="link">
            <template #icon>
              <component :is="link.icon" class="h-6"></component>
            </template>
          </nav-item>
        </li>
      </ul>
    </nav>
    <div class="h-full flex flex-col flex-auto overflow-auto">
      <header class="py-5 border-b sticky top-0 bg-white">
        <LayoutContainer class="flex items-center space-x-3">
          <button type="button" class="text-blue lg:hidden" @click="navActive = true">
          <Bars3Icon class="h-10" />
        </button>
          <nuxt-link to="/" class="font-bold text-2xl"> PitiaRMS </nuxt-link>
        </LayoutContainer>
      </header>
      <main class="flex-auto py-10">
        <slot />
      </main>
      <footer class="py-10 border-t">
        <LayoutContainer>
          <p class="text-center">
            Developed by <span class="text-blue-500">Dave</span>
          </p>
        </LayoutContainer>
      </footer>
    </div>
  </div>
</template>
<script lang="ts" setup>
import {
  ChartBarIcon,
  RectangleStackIcon,
  FireIcon,
  DocumentTextIcon,
  ReceiptRefundIcon,
  UserGroupIcon,
  UserCircleIcon,
  BanknotesIcon,
  Squares2X2Icon,
  Bars3Icon,
  PlusCircleIcon,
ArrowLeftIcon,
} from "@heroicons/vue/24/outline";
import { onClickOutside } from "@vueuse/core";
import { useRoute } from "vue-router";

const route = useRoute()
// todo: on edit/[id] pages, have a way of going back to list, to cancel
const links = [
  {
    path: "/",
    label: "Overview",
    icon: ChartBarIcon,
  },
  {
    path: "/menu-items",
    label: "Menu",
    icon: Squares2X2Icon,
  },
  {
    path: "/stock",
    label: "Stock",
    icon: RectangleStackIcon,
  },
  {
    path: "/preps",
    label: "Servings & prep",
    icon: FireIcon,
  },
  {
    path: "/sales",
    label: "Sales",
    icon: DocumentTextIcon,
  },
  {
    path: "/payments",
    label: "Payments",
    icon: BanknotesIcon,
  },
  {
    path: "/expenses",
    label: "Expenses",
    icon: ReceiptRefundIcon,
  },
  {
    path: "/customers",
    label: "Customers",
    icon: UserGroupIcon,
  },
  {
    path: "/users",
    label: "Users",
    icon: UserCircleIcon,
  },
];

const newOrderPath = {
  path: "/new-order",
  label: "New order",
};

const navActive = ref(false);

const nav = ref()
onClickOutside(nav, () => {
  navActive.value = false
})

watch(route,()=> {
  navActive.value = false
}) 
</script>
