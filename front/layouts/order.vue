<template>
  <div class="h-[100vh] flex flex-col">
    <header class="py-5 border-b">
      <layout-container class="flex items-center justify-center relative">
         <nuxt-link to="/" class="font-medium bg-gray-100 rounded py-2 px-5 text-blue inline-flex items-center space-x-2 text-lg absolute left-5">
          <ArrowLeftIcon class="h-6"/>
          <span class="hidden lg:block">
            Dashboard
          </span>
        </nuxt-link>
        <nuxt-link to="/" class="font-bold text-2xl mx-auto"> PitiaRMS </nuxt-link>
      </layout-container>
    </header>
    <main class="py-10 flex-auto flex flex-col">
      <slot />
    </main>
  </div>
</template>
<script lang="ts" setup>
import { ArrowLeftIcon } from '@heroicons/vue/24/outline';
</script>
