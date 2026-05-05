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
    config: {
      theme: {
        extend: {
          fontFamily: {
            sora: ['Sora', 'sans-serif']
          },
          colors: {
            red: {
              light: '#C1121F',  // rouge primaire
              dark: '#A20D19',  // rouge foncé
            },
            green: {
              light: '#3D6245',
              dark: '#315739',
            },
            black: {
              DEFAULT: '#000000',
              1: '#171717',
              2: '#222222',
              3: '#0D1216',
              4: '#39393A',
              5: '#121212',
            },
            white: {
              DEFAULT: '#FFFFFF',
              section : '#FAFAFA',
            },
            beige: {
              light: '#FDF0D5',
            },
            grey: {
              1: '#A6A6A8',
            }
          }
        }
      }
    }
  }
})