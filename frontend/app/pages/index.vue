<!-- pages/index.vue -->
<script setup>
</script>

<template>
  <main>
    <!-- SECTION HERO -->
    <section
      class="absolute inset-0 h-screen w-full flex flex-col justify-center bg-[linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('/images/image-home.png')] bg-cover bg-center bg-no-repeat z-[-1] px-5 md:px-20"
    >
      <h1 class="text-white text-4xl font-bold mb-5 md:text-7xl">
        Les trésors <br />
        culinaires de l’Est, <br />
        à Saint-Jacques-<br />de-la-Lande
      </h1>
      <p class="text-white mb-5">
        Kalinka, votre épicerie spécialisée en produits d'Europe de l'Est,<br />
        vous invite à un voyage gustatif entre tradition et convivialité.
      </p>
      <div class="flex gap-5 mb-5">
        <div class="flex">
          <img src="" alt="clients" />
          <img src="" alt="clients" />
          <img src="" alt="clients" />
        </div>
        <div class="">
          <p>⭐⭐⭐⭐⭐</p>
          <p>4,8/5 sur 308 avis google</p>
        </div>
      </div>

      <NuxtLink
        to="/shop"
        class="btn-cta group bg-white text-red-light transition-colors duration-200 hover:text-red-dark"
      >
        <span class="btn-cta-label transition-colors duration-200"
          >Faire une commande</span
        >
        <span
          class="btn-cta-circle bg-red-light flex items-center justify-center w-10 h-10 rounded-full transition-colors duration-200 group-hover:bg-red-dark"
        >
          <img
            src="/logos/icon-arrow.svg"
            class="btn-cta-arrow w-4 h-4"
            alt="icon-arrow"
          />
        </span>
      </NuxtLink>
    </section>
  </main>
</template>