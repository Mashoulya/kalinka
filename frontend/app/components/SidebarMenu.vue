<script setup lang="ts">

const config = useRuntimeConfig()
const {data: categories} = await useFetch<Array<{
    id: number
    name: string
    subcategories: Array<{
        id: number
        name: string
    }>
}>>('/api/categories', {
    baseURL: config.apiBase
})


</script>

<template>
    <aside class="bg-white">
        <nav class="bg-white">
            <ul class="flex flex-col text-left text-sm">
                <li class="flex items-center gap-3 p-3 font-semibold">
                    <img src="/logos/icon-label1.svg" class="h-4 w-4" alt="">
                    <NuxtLink to="#">Promotion</NuxtLink>
                </li>
                <li class="flex items-center gap-3 p-3 font-semibold">
                    <img src="/logos/icon-heart.svg" class="h-4 w-4" alt="">
                    <NuxtLink to="#">Les plus aimés</NuxtLink>
                </li>
                <li class="flex items-center gap-3 p-3 font-semibold">
                    <img src="/logos/icon-category.svg" class="h-4 w-4" alt="">
                    <span>Catégories</span>
                </li>
                 <li v-for="cat in categories" :key="cat.id" class="flex flex-col items-start gap-3 p-3 font-medium">
                            <button type="button" class="group flex w-full items-center justify-between gap-2 rounded-md px-2 py-1 hover:bg-red-light hover:text-white">
                        {{ cat.name }}
                                <img src="/logos/icon-chevron-down.svg" class="h-4 w-4 transition-transform group-hover:brightness-0 group-hover:invert" alt="">
                    </button>
                    <ul class="mt-2 space-y-1">
                        <li v-for="subcat in cat.subcategories" :key="subcat.id">
                            {{ subcat.name }}
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
</template>