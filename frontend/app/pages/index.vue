<!-- pages/index.vue -->
<script setup lang="ts">
import { ref } from "vue";
import type { Product } from "~/types/product";

const config = useRuntimeConfig();
const { data: products } = await useFetch<Product[]>("/api/products", {
  baseURL: config.apiBase,
});
const { data: reviews} = await useFetch<{id: number; userName: string; rating: number; comment: string;}[]>("/api/reviews", {
  baseURL: config.apiBase,
});


// caroussel btn
const reviewsTrack = ref<HTMLElement | null>(null);

const scrollReviews = (direction: 1 | -1) => {
  if (!reviewsTrack.value) return;

  reviewsTrack.value.scrollBy({
    left: direction * reviewsTrack.value.clientWidth,
    behavior: "smooth",
  });
};
</script>

<template>
    <!-- SECTION HERO -->
    <section
      class="w-full flex flex-col justify-end bg-[linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('/images/image-home.png')] bg-cover bg-center bg-no-repeat z-[-1] py-[50px] px-5 md:px-20"
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
          icon-alt="icon-arrow"
        >
          Faire une commande
        </AppButton>

        <!-- scroll icon -->

        <div
          class="h-12 w-12 rounded-full border-[3px] border-beige-light bg-black-2 hidden md:flex md:items-center md:justify-center"
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
    <section class="bg-white-section py-20 px-5 md:px-20">
      <!-- header -->
      <div class="flex items-center gap-2 pb-5">
        <img src="/logos/icon-section.svg" alt="icon-section" />
        <p class="uppercase text-red-light text-lg font-semibold">
          <span class="hidden md:inline">Nos meilleures </span>offres du moment
        </p>
      </div>
      <div class="grid items-start gap-8 md:grid-cols-2 md:gap-20 lg:gap-28">
        <h2
          class="max-w-xl text-3xl font-bold leading-tight text-black-2 md:text-5xl"
        >
          Les promotions à ne pas manquer.
        </h2>
        <p class="text-black-1 max-w-prose leading-8 font-medium">
          C’est le moment ou jamais de craquer ! Nous avons sélectionné pour
          vous des produits phares à prix réduits, sans compromis sur la
          qualité. Que ce soit pour vous faire plaisir ou pour gâter vos
          proches, ces promotions sont l’occasion idéale d’acheter malin.
        </p>
      </div>

      <!-- cartes de produits -->
      <div
        class="mt-20 grid grid-cols-2 gap-4 md:grid-cols-3 md:gap-x-4 md:gap-y-8 lg:grid-cols-4"
      >
        <ProductCard
          v-for="product in (products ?? []).slice(0, 8)"
          :key="product.id"
          :product="product"
        />
      </div>

      <div class="mt-10 flex justify-center">
        <AppButton
          variant="red-btn"
          icon-alt="icon-arrow"
        >
          Faire une commande
        </AppButton>
      </div>
    </section>

    <!-- SECTION SERVICES -->
    <section class="py-20 px-5 md:px-20">
      <div class="flex items-center justify-center gap-2 pb-5">
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

    <!-- POPULAR PRODUCTS -->
    <section class="bg-white-section py-20 px-5 md:px-20">
    <!-- header -->
      <div class="flex items-center gap-2 pb-5">
        <img src="/logos/icon-section.svg" alt="icon-section" />
        <p class="uppercase text-red-light text-lg font-semibold">
          Les meilleures ventes
        </p>
      </div>
      <div class="grid items-start gap-8 md:grid-cols-2 md:gap-20 lg:gap-28">
        <h2
          class="max-w-xl text-3xl font-bold leading-tight text-black-2 md:text-5xl"
        >
          Découvrez nos produits les plus appréciés.
        </h2>
        <p class="text-black-1 max-w-prose leading-8 font-medium">
          Des produits qui ont conquis le cœur d'innombrables clients ! Réputés pour leur qualité exceptionnelle, leur fonctionnalité et leur style, ces articles phares représentent le meilleur de notre offre. Découvrez pourquoi ces articles sont si appréciés !
        </p>
      </div>

      <!-- cartes de produits -->
      <div
        class="mt-20 grid grid-cols-2 gap-4 md:grid-cols-3 md:gap-x-4 md:gap-y-8 lg:grid-cols-4"
      >
        <ProductCard
          v-for="product in (products ?? []).slice(0, 8)"
          :key="product.id"
          :product="product"
        />
      </div>

      <div class="mt-10 flex justify-center">
        <AppButton
          variant="red-btn"
          icon-alt="icon-arrow"
        >
          Voir nos produits vedettes
        </AppButton>
      </div>
    </section>

    <!-- RECIPES SECTION -->
    <section class="w-full">
      <div class="grid w-full h-full lg:grid-cols-2">
        <div class="hidden lg:block">
          <img
            src="/images/boeuf.png"
            class="h-full w-full object-cover"
            alt="Boeuf Stroganoff"
          />
        </div>

        <div
          class="bg-black-1 flex flex-col px-6 sm:px-10 md:px-14 lg:justify-evenly lg:px-16"
        >
          <div class="flex flex-col gap-8">
            <div class="flex items-center gap-2">
              <img src="/logos/icon-section.svg" alt="icon-section" class="h-4 w-4" />
              <p class="text-sm font-semibold uppercase tracking-[0.2em] text-white">
                Nos recettes
              </p>
            </div>

            <h2 class="max-w-xl text-3xl font-bold leading-tight text-white md:text-5xl">
              Nos Recettes traditionnelles à découvrir.
            </h2>

            <p class="max-w-prose text-base font-medium leading-8 text-white">
              Découvrez nos recettes traditionnelles russes, savoureuses et
              authentiques. Un voyage culinaire au cœur des saveurs slaves.
            </p>
          </div>

          <div class="flex flex-col gap-4">
            <div class="flex items-center gap-4" data-index="0">
              <svg class="spinner-svg shrink-0" width="90" height="90">
                <circle class="spinner-bg" cx="45" cy="45" r="40" stroke="#444" stroke-width="2" fill="none"/>
                <circle class="spinner-fg" cx="45" cy="45" r="40" stroke="#fff" stroke-width="2" fill="none"/>
                <text x="50%" y="50%" text-anchor="middle" dominant-baseline="middle" class="text-white">01</text>
              </svg>
              <div class="pt-1">
                <div class="flex items-center gap-3">
                  <span class="text-xl font-medium text-white">Boeuf Stroganoff</span>
                  <img src="/logos/flag-ru.svg" alt="flag-ru" class="h-4 w-6" />
                </div>
                <p class="text-grey-1">
                  Bœuf sauté en sauce crémeuse à la moutarde.
                </p>
              </div>
            </div>

            <div class="flex items-center gap-4" data-index="1">
              <svg class="spinner-svg shrink-0" width="90" height="90">
                <circle class="spinner-bg" cx="45" cy="45" r="40" stroke="#444" stroke-width="2" fill="none"/>
                <circle class="spinner-fg" cx="45" cy="45" r="40" stroke="#fff" stroke-width="2" fill="none"/>
                <text x="50%" y="50%" text-anchor="middle" dominant-baseline="middle" class="text-white">02</text>
              </svg>
              <div class="pt-1">
                <div class="flex items-center gap-3">
                  <span class="text-xl font-medium text-white">Draniki</span>
                  <img src="/logos/flag-by.svg" alt="flag-by" class="h-4 w-6" />
                </div>
                <p class="text-grey-1">
                  Galettes de pommes de terre, servies avec crème aigre.
                </p>
              </div>
            </div>

            <div class="flex items-center gap-4" data-index="2">
              <svg class="spinner-svg shrink-0" width="90" height="90">
                <circle class="spinner-bg" cx="45" cy="45" r="40" stroke="#444" stroke-width="2" fill="none"/>
                <circle class="spinner-fg" cx="45" cy="45" r="40" stroke="#fff" stroke-width="2" fill="none"/>
                <text x="50%" y="50%" text-anchor="middle" dominant-baseline="middle" class="text-white">03</text>
              </svg>
              <div class="pt-1">
                <div class="flex items-center gap-3">
                  <span class="text-xl font-medium text-white">Bortsch</span>
                  <img src="/logos/flag-ru.svg" alt="flag-ru" class="h-4 w-6" />
                </div>
                <p class="text-grey-1">
                  Soupe traditionnelle à base de betterave.
                </p>
              </div>
            </div>
          </div>

          <div class="pt-2">
            <AppButton
              variant="red-btn"
              icon-alt="icon-arrow"
            >
              Découvrir nos recettes
            </AppButton>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION REVIEWS -->
    <section class="py-20 px-5 md:px-20">
    <!-- header -->
      <div class="flex items-center gap-2 pb-5">
        <img src="/logos/icon-section.svg" alt="icon-section" />
        <p class="uppercase text-red-light text-lg font-semibold">
          Témoignages de clients
        </p>
      </div>
      <div class="grid items-start gap-8 md:grid-cols-2 md:gap-20 lg:gap-28">
        <h2 class="max-w-xl text-3xl font-bold leading-tight text-black-2 md:text-5xl">
          Ce que nos clients disent de nous.
        </h2>
        <p class="text-black-1 max-w-prose leading-8 font-medium">
         Des produits qui ont conquis le cœur d'innombrables clients ! Réputés pour leur qualité, leur fonctionnalité et leur style exceptionnels, ces produits phares représentent le meilleur de notre offre.
        </p>
      </div>

      <!-- caroussel reviews -->
     
        <!-- reviews -->
        <div ref="reviewsTrack" class="reviews-track mt-20 flex w-full gap-10 overflow-x-auto">
          <div
            v-for="review in (reviews ?? [])"
            :key="review.id"
            class="review-slide"
          >
            <ReviewCard
              :user-name="review.userName"
              :rating="review.rating"
              :comment="review.comment"
            />
          </div>
        </div>

        <!-- navigation buttons -->
        <div class="mt-10 flex flex-col items-center gap-6 md:flex-row md:justify-between">
          <div class="flex w-full justify-between md:contents">
            <button type="button" @click="scrollReviews(-1)">
              <img src="/logos/left-arrow.svg" alt="caroussel-prev" class="w-12">
            </button>
            <button type="button" @click="scrollReviews(1)" class="md:order-last">
              <img src="/logos/right-arrow.svg" alt="caroussel-next" class="w-12">
            </button>
          </div>
          <AppButton variant="black-btn" icon-alt="icon-arrow">
            Voir nos avis sur Google
          </AppButton>
        </div>
   
    </section>
</template>

<style scoped>
.reviews-track {
  scroll-snap-type: x mandatory;
  scrollbar-width: none;
}

.reviews-track::-webkit-scrollbar {
  display: none;
}

.review-slide {
  flex: 0 0 100%;
  scroll-snap-align: start;
}

@media (min-width: 768px) {
  .review-slide {
    flex-basis: calc((100% - 2.5rem) / 2);
  }
}

@media (min-width: 1024px) {
  .review-slide {
    flex-basis: calc((100% - 5rem) / 3);
  }
}
</style>