<script setup lang="ts">
</script>

<template>
    <aside class="md:col-span-1 md:sticky md:top-0 md:h-screen md:overflow-y-auto bg-white text-white">
        <div class="p-1">
            <div class="flex gap-2">
                <img src='/images/milk.jpg' class="w-10 h-10">
                <p>Titre du produit</p>
            </div>
            <div class="price">
                <QuantitySelector />
                <span class="color-black-1">2 $</span>
            </div>
        </div>
    </aside>
</template>