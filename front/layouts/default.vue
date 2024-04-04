<template>
  <div class="h-[100vh] flex">
    <nav class="bg-blue text-white md:w-72 xl:w-96 flex-none py-20 flex justify-center">
      <ul>
        <li v-for="(link, index) in links" :key="index">
          <nuxt-link class="rounded hover:bg-white hover:text-blue px-5 py-4 flex items-center space-x-2 text-lg font-light" :to="link.path">
            <component :is="link.icon" class="h-6"></component>
            <span>
              {{ link.label }}
            </span>
          </nuxt-link>
        </li>
      </ul>
    </nav>
    <div class="h-full flex flex-col flex-auto overflow-auto">
      <header class="py-5 border-b">
        <LayoutContainer>
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
} from "@heroicons/vue/24/outline";
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
</script>
