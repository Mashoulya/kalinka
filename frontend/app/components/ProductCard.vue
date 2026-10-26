<script setup lang="ts">
import { ref } from "vue";
import type { Product } from "~/types/product";

withDefaults(defineProps<{
  product: Product;
  compact?: boolean;
}>(), {
  compact: false,
});
const quantity = ref(0);
</script>

<template>
  <article class="w-full min-w-0 max-w-[320px] justify-self-start bg-white rounded-[10px]">
    <div :class="compact ? 'p-3' : 'p-5'">
      <!-- image -->
      <div
        class="product-mask relative aspect-[138/160] w-full overflow-hidden"
      >
        <img :src="product.photo || '/images/milk.jpg'" :alt="product.name" class="h-full w-full object-cover" />
      </div>

      <!-- description -->
      <h3 :class="compact ? 'text-[13px]' : 'text-lg'" class="pt-3 font-semibold">{{ product.name }}</h3>
      <div class="mb-3 mt-1 flex flex-wrap items-center justify-between gap-x-2">
        <div class="flex items-center gap-2">
          <span :class="compact ? 'text-sm' : 'text-xl'" class="font-semibold text-green-light">{{ product.price }}€</span>
        </div>
        <span :class="compact ? 'text-[13px]' : ''" class="size">{{ product.size.weightVolume }}{{ product.size.unit }}</span>
      </div>

      <!-- button and details -->
      <div class="flex items-center justify-between gap-1">
        <QuantitySelector v-model="quantity" :compact="compact" />
        <NuxtLink :to="{name: 'products-slug', params: {slug: product.slug}}" aria-label="Voir le détail du produit" class="shrink-0 cursor-pointer">
          <img src="/logos/icon-product-detail.svg" :class="compact ? 'h-5 w-5' : ''" />
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