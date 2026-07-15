<script setup lang="ts">
import { ref } from "vue";
import type { Product } from "~/types/product";

defineProps<{
  product: Product;
}>();
const quantity = ref(0);
</script>

<template>
  <article class="w-full max-w-[320px] justify-self-start bg-white rounded-[10px]">
    <div class="p-5">
      <!-- image -->
      <div
        class="product-mask relative aspect-[138/160] w-full overflow-hidden"
      >
        <img :src="product.photo || '/images/milk.jpg'" :alt="product.name" class="h-full w-full object-cover" />
      </div>

      <!-- description -->
      <h3 class="text-lg font-semibold pt-2">{{ product.name }}</h3>
      <div class="mb-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
          <span class="text-xl font-semibold text-green-light">{{ product.price }}€</span>
        </div>
        <span class="size">{{ product.size.weightVolume }}{{ product.size.unit }}</span>
      </div>

      <!-- button and details -->
      <div class="flex justify-between items-center">
        <QuantitySelector v-model="quantity" />
        <NuxtLink :to="{name: 'products-slug', params: {slug: product.slug}}" aria-label="Voir le détail du produit" class="cursor-pointer">
          <img src="/logos/icon-product-detail.svg" />
        </NuxtLink>
      </div>
    </div>
  </article>
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