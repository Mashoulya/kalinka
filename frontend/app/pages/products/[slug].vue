<script setup lang="ts">
import type { Product } from "~/types/product";

const config = useRuntimeConfig();
const route = useRoute();

const { data: products, pending } = await useFetch<Product[]>('/api/products', {
  baseURL: config.apiBase,
  default: () => []
});

const product = computed(() =>
  products.value.find((item) => item.slug === route.params.slug)
);
</script>

<template>
  <main class="min-h-screen bg-white-section px-5 py-10 md:px-10 lg:px-16">
    <NuxtLink to="/shop" class="mb-8 inline-flex items-center gap-2 text-sm font-semibold text-green-light">
      <span aria-hidden="true">←</span>
      Retour à la boutique
    </NuxtLink>

    <p v-if="pending" class="text-sm font-medium">Chargement du produit...</p>

    <p v-else-if="!product" class="text-sm font-medium">Produit introuvable.</p>

    <section v-else class="mx-auto grid max-w-5xl gap-8 md:grid-cols-2 md:items-start">
      <div class="product-mask relative aspect-[138/160] w-full overflow-hidden rounded-[10px] bg-white">
        <img :src="product.photo || '/images/milk.jpg'" :alt="product.name" class="h-full w-full object-cover" />
      </div>

      <div>
        <p class="mb-2 text-sm font-semibold uppercase tracking-[0.2em] text-green-light">Détail produit</p>
        <h1 class="text-3xl font-bold text-black md:text-5xl">{{ product.name }}</h1>
        <p class="mt-4 text-xl font-semibold text-green-light">{{ product.price }}€</p>
        <p class="mt-6 text-base leading-7 text-black/80">{{ product.description }}</p>

        <div class="mt-8 flex items-center gap-4">
          <span class="rounded-full bg-black px-4 py-2 text-sm font-semibold text-white">
            {{ product.size.weightVolume }}{{ product.size.unit }}
          </span>
        </div>
      </div>
    </section>
  </main>
</template>

<style scoped>
.product-mask {
  mask-image: url("/masks/small-card-mask.svg");
  mask-repeat: no-repeat;
  mask-position: top center;
  mask-size: 100% 100%;
  -webkit-mask-image: url("/masks/small-card-mask.svg");
  -webkit-mask-repeat: no-repeat;
  -webkit-mask-position: top center;
  -webkit-mask-size: 100% 100%;
}
</style>
