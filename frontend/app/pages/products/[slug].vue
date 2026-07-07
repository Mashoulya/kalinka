<script setup lang="ts">
import { capitalizeFirstLetter } from '~/utils/text'
import type { Product } from '~/types/product'

const route = useRoute()
const config = useRuntimeConfig()
const slug = route.params.slug
const { data: product, pending, error } = await useFetch<Product>(`/api/products/${slug}`, {
    baseURL: config.apiBase
})
const category = computed(() => product.value?.category ?? null)
const subcategory = computed(() => product.value?.subcategory ?? null)
</script>

<template>
    <main>
        <nav aria-label="fil d'ariane">
            <ol class="flex font-medium">
                <li>
                    <NuxtLink to="/">Accueil</NuxtLink> >
                </li>
                <li>
                    <NuxtLink to="/shop">Boutique</NuxtLink> >
                </li>
                <li>
                    <NuxtLink v-if="category" :to="`/shop/${category.slug}`">{{ capitalizeFirstLetter(category.name) }}</NuxtLink> >
                </li>
                <li>
                    <NuxtLink v-if="category && subcategory" :to="`/shop/${category.slug}/${subcategory.slug}`">{{ capitalizeFirstLetter(subcategory.name) }}</NuxtLink> >
                </li>
                <li class="text-red-light">
                    <NuxtLink v-if="product && category && subcategory" :to="`/shop/${category.slug}/${subcategory.slug}/${product.slug}`">{{ capitalizeFirstLetter(product.name) }}</NuxtLink>
                </li>
            </ol>
        </nav>

        <section>
            <img src="" alt="">
            <div>
                <!-- <h1>produit 1</h1>
                pour la description -->
            </div>
        </section>

        <section>
            <!-- produits similaires -->
        </section>
    </main>
</template>