<script setup lang="ts">

// récupération des catégories
const config = useRuntimeConfig()
const {data: categories} = await useFetch<Array<{
    id: number
    name: string
    slug: string
    subcategories: Array<{
        id: number
        slug: string
        name: string
    }>
}>>('/api/categories', {
    baseURL: config.apiBase
})

const emit = defineEmits<{
    (e: 'subcategory-selected', subcategorySlug: string | null): void
}>()

const props = withDefaults(defineProps<{
    selectedSubcategorySlug?: string | null
}>(), {
    selectedSubcategorySlug: null
})

// gestion d'ouverture des catégories
const openCategoryId = ref<number | null>(null)

function toggleCategory(id: number) {
    if (openCategoryId.value === id) {
        openCategoryId.value = null
    } else {
        openCategoryId.value = id
    }
}

function toggleSubcategory(slug: string) {
    const nextSlug = props.selectedSubcategorySlug === slug ? null : slug
    emit('subcategory-selected', nextSlug)
}

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
                 <li v-for="cat in categories" :key="cat.id" class="flex flex-col items-stretch p-0 font-medium">
                    <button
                        type="button"
                        class="group flex w-full items-center justify-between gap-2 p-3 hover:bg-red-light hover:text-white"
                        :class="openCategoryId === cat.id ? 'bg-red-light text-white' : ''"
                        @click="toggleCategory(cat.id)"
                    >
                        {{ cat.name }}
                        <img
                            src="/logos/icon-chevron-down.svg"
                            class="h-4 w-4 transition-transform group-hover:brightness-0 group-hover:invert"
                            :class="openCategoryId === cat.id ? 'rotate-180 brightness-0 invert' : ''"
                            alt=""
                        >
                    </button>
                    <ul v-if="openCategoryId === cat.id" class="space-y-1 px-3">
                        <li
                            v-for="subcat in cat.subcategories"
                            :key="subcat.id"
                            class="p-2 cursor-pointer"
                            :class="props.selectedSubcategorySlug === subcat.slug ? 'text-red-light font-semibold' : ''"
                            @click="toggleSubcategory(subcat.slug)"
                        >
                            {{ subcat.name }}
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
</template>