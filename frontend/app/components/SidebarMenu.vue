<script setup lang="ts">

const isOpen = ref(false)

const toggleMenu = () => {
    isOpen.value = !isOpen.value
}

</script>

<template>
    <aside>
        <nav class="bg-white">
            <ul class="flex flex-col text-left font-semibold text-sm">
                <li class="flex items-center gap-3 p-3">
                    <img src="/logos/icon-label1.svg" class="h-4 w-4" alt="">
                    <NuxtLink to="#">Promotion</NuxtLink>
                </li>
                <li class="flex items-center gap-3 p-3">
                    <img src="/logos/icon-heart.svg" class="h-4 w-4" alt="">
                    <NuxtLink to="#">Les plus aimés</NuxtLink>
                </li>
                <li class="flex items-center gap-3 p-3">
                    <img src="/logos/icon-category.svg" class="h-4 w-4" alt="">
                    <span>Catégories</span>
                </li>
                <li class="flex flex-col items-start gap-3 p-3">
                     <button @click="toggleMenu" type="button" class="flex w-full items-center justify-between gap-2">
                        Catégorie 1
                        <img src="/logos/icon-chevron-down.svg" :class="isOpen ? 'rotate-180' : ''" class="h-4 w-4 transition-transform" alt="">
                    </button>
                    <ul v-if="isOpen" class="mt-2 space-y-1">
                        <li>Sous-catég 1</li>
                        <li>Sous-catég 2</li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
</template>