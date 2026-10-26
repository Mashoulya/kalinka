<script setup lang="ts">
import { capitalizeFirstLetter } from '~/utils/text'
import type { Product } from '~/types/product'

const route = useRoute()
const config = useRuntimeConfig()
const slug = route.params.slug
const { data: product, pending, error } = await useFetch<Product>(`/api/products/${slug}`, {
    baseURL: config.apiBase
})
const similarProductsQuery = computed(() => {
    const subcategoryId = product.value?.subcategory?.id
    return subcategoryId ? { subcategory: subcategoryId } : {}
})
const { data: products } = await useFetch<Product[]>('/api/products', {
    baseURL: config.apiBase,
    query: similarProductsQuery,
    watch: [similarProductsQuery],
    default: () => []
})
const similarProducts = computed(() =>
    products.value
        .filter(item => item.id !== product.value?.id)
        .slice(0, 3)
)
const galleryImages = ['/images/milk.jpg', '/images/yourt.jpg', '/images/draniki.png']
const selectedImage = ref('/images/milk.jpg')
const category = computed(() => product.value?.category ?? null)
const subcategory = computed(() => product.value?.subcategory ?? null)
const quantity = ref(0)
</script>

<template>
    <div class="min-h-screen bg-white-section md:grid md:grid-cols-6">
        <SidebarMenu />

        <!-- SECTION DETAILS PRODUIT -->
        <div class="md:col-span-4 flex min-w-0 flex-col">
            <section class="flex-1 px-5 py-10 md:px-5 lg:px-5">
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
                <div class="mt-6 grid gap-x-5 gap-y-3 md:grid-cols-2 xl:grid-cols-[minmax(0,400px)_minmax(0,1fr)]">
                    <div class="order-1 flex min-w-0 flex-col gap-3 md:col-start-1 md:row-start-1">
                        <div class="aspect-square w-full max-w-[400px]">
                            <img :src="selectedImage" alt="Image du produit" class="block h-full w-full object-cover">
                        </div>
                        <div class="grid max-w-[400px] grid-cols-[repeat(3,minmax(0,6rem))] gap-2">
                            <button
                                v-for="image in galleryImages"
                                :key="image"
                                type="button"
                                class="aspect-square w-full overflow-hidden rounded border-[0.5px]"
                                :class="selectedImage === image ? 'border-black' : 'border-black/25'"
                                :aria-label="`Afficher l’image ${image}`"
                                @click="selectedImage = image"
                            >
                                <img :src="image" alt="" class="h-full w-full object-cover">
                            </button>
                        </div>
                    </div>

                    <div v-if="product" class="order-3 flex min-w-0 flex-col gap-5 md:col-start-2 md:row-start-1">
                        <div>
                            <h4 class="font-semibold text-[22px]">{{ capitalizeFirstLetter(product.name) }}</h4>
                            <span class="font-medium text-base">{{ product.size.weightVolume }}{{ product.size.unit }}</span>
                        </div>
                        <span class="font-semibold text-3xl">{{ product.price }}€</span> 
                        <div class="flex gap-4">
                            <QuantitySelector v-model="quantity" />
                            <PurchaseActionButton class="w-full"/>
                        </div>
                        <p class="flex-1 text-justify">{{ product.description }}</p>
                    </div>
                    <p v-else class="order-3 md:col-start-2 md:row-start-1">Produit introuvable</p>

                    <!-- PRODUITS SIMILAIRES -->
                    <section v-if="product" class="similar-products order-4 min-w-0 md:col-start-2 md:row-start-2">
                        <h4 class="mb-3 font-semibold text-[20px] lg:text-[20px]">Produits similaires :</h4>
                        <div class="grid grid-cols-2 divide-x divide-gray-300 overflow-hidden xl:grid-cols-3 max-xl:[&>*:nth-child(3)]:hidden rounded-md border border-gray-300">
                            <ProductCard
                                v-for="similarProduct in similarProducts"
                                :key="similarProduct.id"
                                :product="similarProduct"
                                compact
                                class="!max-w-none !rounded-none"
                            />
                        </div>
                    </section>
                </div>
            </section>
            
            <Footer />
        </div>
        <aside class="md:col-span-1 md:sticky md:top-0 md:h-screen md:overflow-y-auto bg-black-1 text-white">
            Panier
        </aside>
    </div>
</template>
