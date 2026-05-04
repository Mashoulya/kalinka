<!-- pages/index.vue -->
<script setup lang="ts">
import type { Product } from "~/types/product";

const config = useRuntimeConfig();
const { data: products } = await useFetch<Product[]>("/api/products", {
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
      <p class="text-white font-medium mb-5">
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
        <AppButton
          to="/shop"
          variant="white-btn"
          icon-src="/logos/icon-arrow-white.svg"
          icon-alt="icon-arrow"
        >
          Faire une commande
        </AppButton>

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

    <!-- SECTION PROMOS -->
    <section class="bg-white-section px-5 md:px-20">
      <!-- header -->
      <div class="flex items-center gap-2 pt-20 pb-5">
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
        <p class="text-black-1 max-w-prose leading-8 font-medium">
          C’est le moment ou jamais de craquer ! Nous avons sélectionné pour
          vous des produits phares à prix réduits, sans compromis sur la
          qualité. Que ce soit pour vous faire plaisir ou pour gâter vos
          proches, ces promotions sont l’occasion idéale d’acheter malin.
        </p>
      </div>

      <!-- cards -->
      <div
        class="mt-10 grid grid-cols-2 gap-4 md:grid-cols-3 md:gap-x-4 md:gap-y-8 lg:grid-cols-4"
      >
        <ProductCard
          v-for="product in (products ?? []).slice(0, 8)"
          :key="product.id"
          :product="product"
        />
      </div>

      <div class="py-10 flex justify-center">
        <AppButton
          variant="red-btn"
          icon-src="/logos/icon-arrow-red.svg"
          icon-alt="icon-arrow"
        >
          Faire une commande
        </AppButton>
      </div>
    </section>

    <!-- SECTION SERVICES -->
    <section class="px-5 md:px-20">
      <div class="flex items-center justify-center gap-2 pt-20 pb-5">
        <img src="/logos/icon-section.svg" alt="icon-section" />
        <p class="uppercase text-red-light text-lg font-semibold">
          Nos services
        </p>
      </div>
      <div class="flex flex-col items-center">
        <h2
          class="max-w-xl text-3xl font-bold leading-tight text-black-2 md:text-5xl"
        >
          Organisez vos envies,<br/> on s'occupe du reste !
        </h2>
        <p class="text-black-1 font-medium leading-8 text-justify">
          Des solutions pratiques, rapides et accessibles pour mieux vous servir au quotidien.
        </p>
      </div>

      <!-- 3 cartes services -->

      <div class="mt-10 grid grid-cols-1 gap-8 lg:grid-cols-3">
          <div class="rounded-2xl border border-black-5/25 p-8">
              <div class="flex flex-col gap-8 md:gap-10">
                  <img src="/logos/icon-service-1.svg" alt="icon-service" class="w-12">
                  <h4 class="font-semibold text-2xl"><span class="bg-[#FFF172] px-1">Produits</span> authentiques d'Europe de l'Est</h4>
                  <p class="font-medium text-sm">Une sélection soignée de spécialités russes, ukrainiennes, polonaises et plus encore.</p>
              </div>
          </div>
          <div class="rounded-2xl border border-black-5/25 p-8">
              <div class="flex flex-col gap-8 md:gap-10">
                  <img src="/logos/icon-service-2.svg" alt="icon-service" class="w-12">
                  <h4 class="font-semibold text-2xl"><span class="bg-[#DAE89B] px-1">Réservation</span> en ligne & retrait en boutique</h4>
                  <p class="font-medium text-sm">Réservez facilement vos produits en ligne et récupérez-les en magasin quand vous le souhaitez.</p>
              </div>
          </div>
          <div class="rounded-2xl border border-black-5/25 p-8">
              <div class="flex flex-col gap-8 md:gap-10">
                  <img src="/logos/icon-service-3.svg" alt="icon-service" class="w-12">
                  <h4 class="font-semibold text-2xl"><span class="bg-[#F88CCD] px-1">Service</span> client à votre <br class="md:hidden" /> écoute</h4>
                  <p class="font-medium text-sm">Une équipe disponible pour vous conseiller avec passion et convivialité, en français ou en russe.</p>
              </div>
          </div>
      </div>

    </section>
  </main>
</template>