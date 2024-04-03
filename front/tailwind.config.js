/** @type {import('tailwindcss').Config} */

import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

export default {
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.vue",
    "./plugins/**/*.{js,ts}",
    "./app.vue",
    "./error.vue",
  ],
  theme: {
    extend: {
      colors: {
        saffron: "#eac435ff",
        blue: "#345995ff",
        mint: "#03cea4ff",
        tomato: "#fb4d3dff",
        rose: "#ca1551ff",
      },
      fontFamily: {
        sans: ["Outfit", "sans-serif", ...defaultTheme.fontFamily.sans],
      },
    },
  },
  plugins: [forms],
};
