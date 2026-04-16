<template>
  <div class="w-full">

    <!-- TOP BAR -->
    <div class="bg-black text-white text-sm py-2">
      <div class="max-w-7xl mx-auto flex justify-between px-4">

        <div class="flex gap-6">

          <div class="flex items-center gap-2">
            <span>📞</span>
            <span>0205040102</span>
          </div>

          <div class="flex items-center gap-2">
            <span>📍</span>
            <span>Saint-Jacques-de-la-Lande</span>
          </div>

        </div>

      </div>
    </div>

    <!-- BOTTOM BAR -->
    <div class="bg-white border-b">
      <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-4">

        <!-- LOGO -->
        <img src="" class="h-10" />

        <!-- NAV LINKS -->
        <ul class="flex gap-8 font-medium text-gray-700">
          <li><NuxtLink to="/">Accueil</NuxtLink></li>
          <li><NuxtLink to="/shop">Boutique</NuxtLink></li>
          <li><NuxtLink to="/about">À propos</NuxtLink></li>
          <li><NuxtLink to="/recipes">Nos recettes</NuxtLink></li>
          <li><NuxtLink to="/contact">Contact/FAQ</NuxtLink></li>
        </ul>

        <!-- ICONS -->
        <div class="flex gap-4 text-xl">
          <NuxtLink to="/cart">🛒</NuxtLink>
          <NuxtLink to="/profile">👤</NuxtLink>
        </div>

      </div>
    </div>

  </div>
</template>