<script setup lang="ts">
import { ref, computed } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();

const isMenuOpen = ref(false);
const linksHome = [
  { to: "/", label: "Accueil" },
  { to: "/shop", label: "Boutique" },
  { to: "/about", label: "À propos" },
  { to: "/recipes", label: "Nos recettes" },
  { to: "/contact", label: "Contact / FAQ" },
];

const navConfig = computed(() => {
  const isHome = route.path === "/";

  return {
    links: isHome
      ? linksHome
      : [
          { to: "/", label: "Accueil" },
          { to: "/shop", label: "Boutique" },
          { to: "/contact", label: "Contact / FAQ" },
        ],
  };
});

const isShopPage = computed(() => route.path === "/shop");

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};

const closeMenu = () => {
  isMenuOpen.value = false;
};
</script>

<template>
  <header class="w-full bg-black-2 font-sora text-white">
    <!-- TOP BAR (desktop) -->
    <div
      class="hidden md:flex bg-black-1/60 text-sm py-2 border-b border-black-4 w-full mx-auto justify-between px-4 gap-6"
    >
      <div class="flex justify-start gap-10 lg:px-20">
        <div class="flex items-center gap-2">
          <img src="/logos/tel.png" alt="logo-phone" />
          <span>0205040102</span>
        </div>

        <div class="flex items-center gap-2">
          <img src="/logos/gps-marker.png" alt="logo-location" />
          <span>Saint-Jacques-de-la-Lande</span>
        </div>
      </div>

      <div class="flex items-center gap-3 md:px-20">
        <img
          src="/logos/icon-fb.svg"
          alt="logo-facebook"
          class="h-4 w-4 brightness-0 invert"
        />
        <img
          src="/logos/icon-insta.svg"
          alt="logo-instagram"
          class="h-4 w-4 brightness-0 invert"
        />
      </div>
    </div>

    <!-- BOTTOM BAR -->
    <div class="bg-black-1 md:border-black-4 w-full mx-auto px-4 py-4">
      <div
        class="flex flex-wrap items-center justify-between md:justify-start gap-3 md:gap-4 lg:px-20"
      >
        <NuxtLink to="/" @click="closeMenu">
          <img
            src="/logos/logo-kalinka-blanc.png"
            alt="logo"
            class="h-6 md:h-7"
          />
        </NuxtLink>

        <nav class="hidden md:block flex-1 md:flex md:justify-center">
          <ul class="flex items-center text-center gap-6 font-medium text-white text-base">
            <li v-for="link in navConfig.links" :key="link.to">
              <NuxtLink :to="link.to">{{ link.label }}</NuxtLink>
            </li>
          </ul>
        </nav>

        <div class="flex items-center gap-4 text-xl md:order-3">
          <NuxtLink to="/cart" class="relative" @click="closeMenu">
            <img
              src="/logos/icon-cart.svg"
              alt="logo-cart"
              class="h-8 w-8 md:h-8 md:w-8 brightness-0 invert"
            />
          </NuxtLink>

          <NuxtLink to="/profile" @click="closeMenu">
            <img
              src="/logos/icon-user.svg"
              alt="logo-profile"
              class="h-8 w-8 md:h-8 md:w-8 brightness-0 invert"
            />
          </NuxtLink>

          <button
            type="button"
            class="md:hidden"
            aria-label="Ouvrir le menu"
            @click="toggleMenu"
          >
            <img
              src="/logos/icon-burger.svg"
              :alt="isMenuOpen ? 'Fermer le menu' : 'Ouvrir le menu'"
              class="h-8 w-8 brightness-0 invert"
            />
          </button>
        </div>

        <!-- BARRE DE RECHERCHE -->
        <div
          v-if="route.path !== '/' && !isMenuOpen"
          class="order-4 w-full md:order-2 md:w-[clamp(14rem,30vw,20rem)] lg:w-[clamp(20rem,34vw,28rem)] md:ml-auto"
        >
          <form
            class="flex w-full h-11 md:h-11 lg:h-12 pl-4 md:pl-5 lg:pl-6 pr-1 items-center rounded-full bg-white"
            action=""
          >
            <input
              type="text"
              placeholder="Rechercher..."
              class="w-full min-w-0 bg-transparent border-0 outline-none text-black-3/60 placeholder:text-black-3/60 placeholder:text-sm"
            />
            <button
              type="button"
              aria-label="Lancer la recherche"
              class="h-10 w-10 shrink-0 rounded-full bg-red-light flex items-center justify-center"
            >
              <img
                src="/logos/icon-search.svg"
                alt="icon-search"
                class="h-10 w-10"
              />
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- MOBILE MENU -->
    <div
      v-if="isMenuOpen"
      class="md:hidden bg-black-1 border-b border-black-4"
    >
      <div class="px-6 py-7 border-t-4 border-red-light">
        <div class="flex items-center justify-between mb-5">
          <h2 class="text-2xl font-semibold">Menu</h2>
          <button
            type="button"
            class="rounded px-2 py-1"
            aria-label="Fermer le menu"
            @click="closeMenu"
          >
            <img src="/logos/icon-close.svg" alt="Fermer" class="h-9 w-9" />
          </button>
        </div>

        <nav>
          <ul class="flex flex-col gap-5 text-lg font-medium text-white">
            <li v-for="link in navConfig.links" :key="link.to">
              <NuxtLink :to="link.to" @click="closeMenu">{{
                link.label
              }}</NuxtLink>
            </li>
          </ul>
        </nav>

        <div class="mt-8">
          <h3 class="text-2xl font-semibold mb-3">Nos réseaux</h3>
          <div class="flex items-center gap-6">
            <img
              src="/logos/icon-fb.svg"
              alt="logo-facebook"
              class="h-5 w-5 brightness-0 invert"
            />
            <img
              src="/logos/icon-insta.svg"
              alt="logo-instagram"
              class="h-5 w-5 brightness-0 invert"
            />
          </div>
        </div>
      </div>
    </div>
  </header>
</template>