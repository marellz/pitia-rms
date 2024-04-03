// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  runtimeConfig: {
    public:{
      API_URL: process.env.API_URL ?? "http://localhost:8000/api",
      BASE_API_URL: process.env.BASE_API_URL ?? "http://localhost:8000/",
    }
  },
  css: ["~/assets/css/app.css"],
  modules: ['@pinia/nuxt'],
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
});
