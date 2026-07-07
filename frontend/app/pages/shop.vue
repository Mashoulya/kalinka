<!-- pages/shop.vue -->
<script setup lang="ts">
import type { Product } from "~/types/product";

const config = useRuntimeConfig()
const route = useRoute()
const router = useRouter()

const selectedSubcategoryId = computed<number | null>(() => {
  const value = Array.isArray(route.query.subcategory)
    ? route.query.subcategory[0]
    : route.query.subcategory

  if (!value) {
    return null
  }

  const parsed = Number(value)
  return Number.isInteger(parsed) && parsed > 0 ? parsed : null
})

const productQuery = computed(() => {
  if (!selectedSubcategoryId.value) {
    return {}
  }

  return { subcategory: selectedSubcategoryId.value }
})

const { data: products, pending } = await useFetch<Product[]>('/api/products', {
  baseURL: config.apiBase,
  query: productQuery,
  watch: [productQuery],
  default: () => []
})

function handleSubcategorySelected(subcategoryId: number | null) {
  const query = { ...route.query }

  if (subcategoryId) {
    query.subcategory = String(subcategoryId)
  } else {
    delete query.subcategory
  }

  router.replace({ query })
}

</script>

<template>
  <main class="min-h-screen bg-white-section md:grid md:grid-cols-6">
    <SidebarMenu
      class="md:col-span-1 md:self-stretch md:sticky md:top-0 md:h-screen md:overflow-y-auto"
      :selected-subcategory-id="selectedSubcategoryId"
      @subcategory-selected="handleSubcategorySelected"
    />

    <!-- SECTION BOUTIQUE -->
    <div class="md:col-span-4 flex min-w-0 flex-col">
      <section class="flex-1 px-5 py-10 md:px-10 lg:px-10">
        <h1 class="mb-10 text-center text-3xl font-bold text-red-light md:text-5xl">Boutique</h1>
        <div class="grid grid-cols-3 items-center">
          <nav aria-label="fil d'ariane">
             <ol class="flex font-medium">
                <li>
                    <NuxtLink to="/">Accueil</NuxtLink> >
                </li>
                <li class="text-red-light">
                    <NuxtLink to="/shop">Boutique</NuxtLink>
                </li>
            </ol>
          </nav>
          <p class="font-medium text-sm text-center">Tous nos produits Kalinka en Click & Collect</p>
        </div>
        
    
           <p v-if="pending" class="mt-10 text-sm font-medium">Chargement des produits...</p>

           <p v-else-if="!products.length" class="mt-10 text-sm font-medium">Aucun produit pour cette sous-catégorie.</p>

           <div v-else class="mt-10 grid grid-cols-2 gap-4 md:grid-cols-3 md:gap-x-4 md:gap-y-8 lg:grid-cols-4">
           <ProductCard
              v-for="product in products"
              :key="product.id"
              :product="product"
           />
          </div>
       
      </section>

      <Footer />
    </div>

    <aside class="md:col-span-1 md:sticky md:top-0 md:h-screen md:overflow-y-auto bg-black-1 text-white">
      Panier
    </aside>
  </main>
</template>