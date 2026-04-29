<script setup lang="ts">
import { ref } from "vue";

const quantity = ref(0);

const increment = () => {
  quantity.value += 1;
};

const decrement = () => {
  quantity.value = Math.max(0, quantity.value - 1);
};
</script>


<template>
  <div class="w-[300px] bg-white">
    <div class="p-5">
      <div
        class="product-mask relative aspect-[138/160] w-full overflow-hidden"
      >
        <img src="/images/milk.jpg" alt="" class="h-full w-full object-cover" />
      </div>
    </div>

    <div class="px-5">
      <h3 class="text-lg">Milk</h3>
      <div class="mb-4 flex items-center justify-between">
        <div class="flex items-baseline gap-2">
          <span class="text-lg font-semibold text-green-light">$2.99</span>
          <span class="self-start text-base text-red-light line-through"
            >$3.99</span
          >
        </div>
        <span class="size">50cl</span>
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