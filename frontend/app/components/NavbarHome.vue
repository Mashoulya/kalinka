<script setup lang="ts">
import { ref } from "vue";

const isMenuOpen = ref(false);
const navLinks = [
  { to: "/", label: "Accueil" },
  { to: "/shop", label: "Boutique" },
  { to: "/about", label: "À propos" },
  { to: "/recipes", label: "Nos recettes" },
  { to: "/contact", label: "Contact / FAQ" },
];

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};

const closeMenu = () => {
  isMenuOpen.value = false;
};
</script>

<template>
  <header class="w-full bg-black-hover font-sora text-white">
    <!-- TOP BAR (desktop) -->
    <div class="hidden md:flex bg-black-topnav text-sm py-2 border-b border-black-stroke w-full mx-auto justify-between px-4 gap-6">
      <div class="flex justify-start gap-10">
        <div class="flex items-center gap-2">
          <img src="/logos/tel.png" alt="logo-phone" />
          <span>0205040102</span>
        </div>

        <div class="flex items-center gap-2">
          <img src="/logos/gps-marker.png" alt="logo-location" />
          <span>Saint-Jacques-de-la-Lande</span>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <img src="/logos/icon-fb.svg" alt="logo-facebook" class="h-4 w-4 brightness-0 invert"/>
        <img src="/logos/icon-insta.svg" alt="logo-instagram" class="h-4 w-4 brightness-0 invert"/>
      </div>
    </div>

    <!-- BOTTOM BAR -->
    <div class="bg-black-nav md:border-black-stroke w-full mx-auto px-4 py-4">
      <div class="flex items-center justify-between">
        <NuxtLink to="/" @click="closeMenu">
          <img src="/logos/logo-kalinka-blanc.png" alt="logo" class="h-8 md:h-10"/>
        </NuxtLink>

        <nav class="hidden md:block">
          <ul class="flex gap-8 font-medium text-white text-base">
            <li v-for="link in navLinks" :key="link.to">
              <NuxtLink :to="link.to">{{ link.label }}</NuxtLink>
            </li>
          </ul>
        </nav>

        <div class="flex items-center gap-4 text-xl">
          <NuxtLink to="/cart" class="relative" @click="closeMenu">
            <img src="/logos/icon-cart.svg" alt="logo-cart" class="h-8 w-8 md:h-8 md:w-8 brightness-0 invert"/>
          </NuxtLink>

          <NuxtLink to="/profile" @click="closeMenu">
            <img src="/logos/icon-user.svg" alt="logo-profile" class="h-8 w-8 md:h-8 md:w-8 brightness-0 invert"/>
          </NuxtLink>

          <button type="button" class="md:hidden" aria-label="Ouvrir le menu" @click="toggleMenu">
            <img src="/logos/icon-burger.svg" :alt="isMenuOpen ? 'Fermer le menu' : 'Ouvrir le menu'" class="h-8 w-8 brightness-0 invert"/>
          </button>
        </div>
      </div>
    </div>

    <!-- MOBILE MENU -->
    <div v-if="isMenuOpen" class="md:hidden bg-black-nav border-b border-black-stroke">
      <div class="px-6 py-7 border-t-4 border-red-light">
        <div class="flex items-center justify-between mb-5">
          <h2 class="text-2xl font-semibold">Menu</h2>
          <button type="button" class="rounded px-2 py-1" aria-label="Fermer le menu" @click="closeMenu">
            <img src="/logos/icon-close.svg" alt="Fermer" class="h-9 w-9" />
          </button>
        </div>

        <nav>
          <ul class="flex flex-col gap-5 text-lg font-medium text-white">
            <li v-for="link in navLinks" :key="link.to">
              <NuxtLink :to="link.to" @click="closeMenu">{{ link.label }}</NuxtLink>
            </li>
          </ul>
        </nav>

        <div class="mt-8">
          <h3 class="text-2xl font-semibold mb-3">Nos réseaux</h3>
          <div class="flex items-center gap-6">
            <img src="/logos/icon-fb.svg" alt="logo-facebook" class="h-5 w-5 brightness-0 invert"/>
            <img src="/logos/icon-insta.svg" alt="logo-instagram" class="h-5 w-5 brightness-0 invert"/>
          </div>
        </div>
        
      </div>
    </div>
  </header>
</template>