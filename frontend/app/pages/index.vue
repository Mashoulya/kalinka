<!-- pages/index.vue -->
<script setup>
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
      <div class="flex gap-5 mb-5">
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
          <p class="font-medium text-white">
            <span class="text-xl">4,8</span>/5 sur 308 avis google
          </p>
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

    <!-- SECTION PROMO -->
    <section class="bg-white-section px-5 md:px-20">
      <!-- header -->
      <div class="flex items-center gap-2 pt-20">
        <img src="/logos/icon-section.svg" alt="icon-section" />
        <p class="uppercase text-red-light text-lg font-semibold">
          Nos meilleures offres du moment
        </p>
      </div>
      <div class="grid items-start gap-8 md:grid-cols-2 md:gap-20 lg:gap-28">
        <h2 class="max-w-xl text-5xl font-bold leading-tight text-black-2">
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
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-2 gap-y-6 md:gap-x-3 md:gap-y-8 mt-10">
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
      </div>
    </section>
  </main>
</template>