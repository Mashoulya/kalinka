// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  modules: ['@nuxtjs/tailwindcss'],
  css: ['~/assets/css/fonts.css', '~/assets/css/buttons.css'],

  vite: {
    server: {
      hmr: {
        protocol: 'ws',
        host: 'localhost',
        port: 3000,
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
              hover: '#222222',
              topnav: '#17171799',
              nav: '#171717',
              stroke: '#39393A',
              txt: '#0D121699',
            },
          }
        }
      }
    }
  }
})