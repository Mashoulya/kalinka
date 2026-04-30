<!-- pages/index.vue -->
<script setup lang="ts">
const config = useRuntimeConfig();
const { data: products } = await useFetch("/api/products", {
  baseURL: config.apiBase,
});
</script>

<template>
  <main>
    <!-- SECTION HERO -->
    <section
      class="w-full flex flex-col justify-end bg-[linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('/images/image-home.png')] bg-cover bg-center bg-no-repeat z-[-1] px-5 py-[50px] md:px-20"
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
      <div class="flex flex-col gap-5 mb-5 md:flex-row">
        <div class="flex -space-x-3">
          <img
            src="/logos/profile1.jpg"
            alt="clients"
            class="w-14 h-14 rounded-full"
          />
          <img
            src="/logos/profile2.jpg"
            alt="clients"
            class="w-14 h-14 rounded-full"
          />
          <img
            src="/logos/profile3.jpg"
            alt="clients"
            class="w-14 h-14 rounded-full"
          />
        </div>
        <div class="">
          <p>⭐⭐⭐⭐⭐</p>
          <p class="font-medium text-white text-sm md:text-base">
            <span class="text-base md:text-xl">4,8</span>/5 sur 308 avis google
          </p>
        </div>
      </div>

      <div class="flex justify-between items-center">
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
              src="/logos/icon-arrow-white.svg"
              class="btn-cta-arrow w-4 h-4"
              alt="icon-arrow"
            />
          </span>
        </NuxtLink>

        <!-- scroll icon -->

        <div
          class="flex h-12 w-12 items-center justify-center rounded-full border-[3px] border-beige-light bg-black-2 hidden md:flex"
        >
          <img
            src="/logos/icon-arrow-down.svg"
            alt="arrow-down"
            class="block h-4 w-4"
          />
        </div>
      </div>
    </section>

    <!-- SECTION PROMO -->
    <section class="bg-white-section px-5 md:px-20">
      <!-- header -->
      <div class="flex items-center gap-2 py-10">
        <img src="/logos/icon-section.svg" alt="icon-section" />
        <p class="uppercase text-red-light text-lg font-semibold">
          <span class="hidden md:inline">Nos meilleures </span>offres du moment
        </p>
      </div>
      <div class="grid items-start gap-8 md:grid-cols-2 md:gap-20 lg:gap-28">
        <h2
          class="max-w-xl text-3xl font-bold leading-tight text-black-2 md:text-5xl"
        >
          Les promotions à ne pas manquer
        </h2>
        <p class="text-black-1 max-w-prose leading-8">
          C’est le moment ou jamais de craquer ! Nous avons sélectionné pour
          vous des produits phares à prix réduits, sans compromis sur la
          qualité. Que ce soit pour vous faire plaisir ou pour gâter vos
          proches, ces promotions sont l’occasion idéale d’acheter malin.
        </p>
      </div>

      <!-- cards -->
      <div
        class="mt-10 grid grid-cols-2 gap-x-2 gap-y-6 md:grid-cols-3 md:gap-x-3 md:gap-y-8 lg:grid-cols-4"
      >
        <ProductCard
          v-for="product in (products ?? []).slice(0, 8)"
          :key="product.id"
          :product="product"
        />
      </div>

      <div class="mt-10 flex justify-center">
        <NuxtLink
          class="btn-cta group bg-red-light text-white transition-colors duration-200 hover:bg-red-dark"
        >
          <span class="btn-cta-label transition-colors duration-200"
            >Faire une commande</span
          >
          <span
            class="btn-cta-circle bg-white flex items-center justify-center w-10 h-10 rounded-full transition-colors duration-200"
          >
            <img
              src="/logos/icon-arrow-red.svg"
              class="btn-cta-arrow w-4 h-4"
              alt="icon-arrow"
            />
          </span>
        </NuxtLink>
      </div>
    </section>
  </main>
</template>