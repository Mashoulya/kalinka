// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  modules: ['@nuxtjs/tailwindcss'],
  css: ['~/assets/css/fonts.css', '~/assets/css/buttons.css'],

  runtimeConfig: {
    apiBase: 'http://backend',
    public: {
      apiBase: '',
    }
  },

  vite: {
    server: {
      hmr: {
        protocol: 'ws',
        host: 'localhost',
        port: 3000,
      },
      proxy: {
        '/api': {
          target: 'http://backend',
          changeOrigin: true,
        }
      }
    }
  },

  tailwindcss: {
    configPath: 'tailwind.config.js'
  }
})