<template>
  <div class="w-full bg-black-hover font-sora">
    <!-- TOP BAR -->
    <div
      class="bg-black-topnav text-white text-sm py-2 border-b border-black-stroke"
    >
      <div class="max-w-7xl mx-auto flex justify-start px-4 gap-6">
        <div class="flex items-center gap-2">
          <img src="/logos/tel.png" alt="logo-phone" />
          <span>0205040102</span>
        </div>

        <div class="flex items-center gap-2">
          <img src="/logos/gps_marker.png" alt="logo-location" />
          <span>Saint-Jacques-de-la-Lande</span>
        </div>
      </div>
    </div>

    <!-- BOTTOM BAR -->
    <div class="bg-black-nav border-b border-black-stroke">
      <div
        class="max-w-7xl mx-auto flex items-center justify-between px-4 py-4"
      >
        <!-- LOGO -->
        <img src="/logos/logo_blanc.png" alt="logo" class="h-10" />

        <!-- NAV LINKS -->
        <ul class="flex gap-8 font-medium text-white text-base">
          <li><NuxtLink to="/">Accueil</NuxtLink></li>
          <li><NuxtLink to="/shop">Boutique</NuxtLink></li>
          <li><NuxtLink to="/about">À propos</NuxtLink></li>
          <li><NuxtLink to="/recipes">Nos recettes</NuxtLink></li>
          <li><NuxtLink to="/contact">Contact/FAQ</NuxtLink></li>
        </ul>

        <!-- ICONS -->
        <div class="flex gap-4 text-xl">
          <NuxtLink to="/cart">
            <img src="/logos/icon_cart.png" alt="logo-cart" />
          </NuxtLink>
          <NuxtLink to="/profile">
            <img src="/logos/icon_profile.png" alt="logo-profile" />
          </NuxtLink>
        </div>
      </div>
    </div>
  </div>
</template>