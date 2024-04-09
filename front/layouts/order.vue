<template>
  <div class="h-[100vh] flex flex-col">
    <header class="py-5 border-b">
      <layout-container class="flex items-center">
        <div class="flex-auto">
            <nuxt-link to="/" class="font-bold text-2xl"> PitiaRMS </nuxt-link>
        </div>
        <nuxt-link to="/" class="font-medium bg-gray-100 rounded py-2 px-5 text-blue">
            Dashboard
        </nuxt-link>
      </layout-container>
    </header>
    <main class="py-10 flex-auto flex flex-col">
      <slot />
    </main>
  </div>
</template>
<script lang="ts" setup></script>
