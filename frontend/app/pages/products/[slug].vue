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
const quantity = ref(0)
</script>

<template>
    <div class="min-h-screen bg-white-section md:grid md:grid-cols-6">
        <SidebarMenu />

        <!-- SECTION DETAILS PRODUIT -->
        <div class="md:col-span-4 flex min-w-0 flex-col">
            <section class="flex-1 px-5 py-10 md:px-10 lg:px-10">
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
                <div class="flex mt-6">
                    <div class="w-full max-w-[400px] aspect-square">
                        <!-- <img v-if="product && product.photo" :src="product.photo" class="w-full h-full object-cover" :alt="product.name"> -->
                        <img :src="'/images/milk.jpg'" class="w-full h-full object-cover">
                    </div>
                    
                    <div v-if="product" class="flex flex-col">
                        <h1 class="font-semibold text-2xl">{{ capitalizeFirstLetter(product.name) }}</h1>
                        <span class="font-medium text-xl">{{ product.size.weightVolume }}{{ product.size.unit }}</span>
                        <span class="font-semibold text-3xl">{{ product.price }}€</span> 
                        <div class="flex">
                            <QuantitySelector v-model="quantity" />
                            <PurchaseActionButton />
                        </div>
                        <p>{{ product.description }}</p>
                    </div>
                    <p v-else>Produit introuvable</p>
                </div>
            </section>

            <section>
                <!-- produits similaires -->
            </section>
            
            <Footer />
        </div>
        <aside class="md:col-span-1 md:sticky md:top-0 md:h-screen md:overflow-y-auto bg-black-1 text-white">
            Panier
        </aside>
    </div>
</template>