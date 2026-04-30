<script setup lang="ts">
import { ref } from "vue";

interface Product {
  id: number;
  name: string;
  price: string;
  size: {
    weightVolume: string | null;
    unit: string | null;
  };
  description: string;
  photo: string | null;
}

defineProps<{
  product: Product;
}>();

const quantity = ref(0);

const increment = () => {
  quantity.value += 1;
};

const decrement = () => {
  quantity.value = Math.max(0, quantity.value - 1);
};
</script>


<template>
  <div class="w-full max-w-[300px] justify-self-start bg-white">
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
        <div class="inline-flex items-center bg-black rounded-md">
          <button
            @click="decrement"
            class="text-white text-lg font-bold w-6 flex items-center justify-center"
          >
            −
          </button>
          <span class="text-white text-base font-semibold w-6 text-center">{{
            quantity
          }}</span>
          <button
            @click="increment"
            class="text-white text-lg font-bold w-6 flex items-center justify-center"
          >
            +
          </button>
        </div>
        <NuxtLink>
          <img src="/logos/icon-product-detail.svg" alt="icon-product-detail" />
        </NuxtLink>
      </div>
    </div>
  </div>
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