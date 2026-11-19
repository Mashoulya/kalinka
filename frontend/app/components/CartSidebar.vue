<script setup lang="ts">
const mockCartItems = [
  { id: 1, name: 'Le mélange d\'épice "Plov", 50 gr', price: 1.50, quantity: 1, image: '/images/milk.jpg' },
  { id: 2, name: 'Acide citrique - 500g', price: 7.80, quantity: 2, image: '/images/milk.jpg' },
  { id: 3, name: 'Tarama, Œufs de capélan et de saumon 165g', price: 4.70, quantity: 1, image: '/images/milk.jpg' },
  { id: 4, name: 'Pomme de terre de consommation vrac', price: 4.80, quantity: 2, image: '/images/milk.jpg' },
  { id: 5, name: 'Le mélange d\'épice "Smell-Smell"', price: 3.00, quantity: 2, image: '/images/milk.jpg' },
  { id: 6, name: 'Lait fermenté / Kéfir 2,5% жирности', price: 2.20, quantity: 1, image: '/images/milk.jpg' },
]

const total = computed(() => {
  return mockCartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0)
})
</script>

<template>
    <aside class="md:col-span-1 md:sticky md:top-0 md:h-screen md:overflow-y-auto bg-white text-black">
        <div class="flex flex-col h-full">
            <!-- Items List -->
            <div class="flex-1 overflow-y-auto">
                <div v-for="item in mockCartItems" :key="item.id" class="p-4 border-b border-gray-200">
                    <div class="flex gap-2">
                        <img :src="item.image" :alt="item.name" class="w-12 h-12 object-cover rounded">
                        <p class="text-sm font-medium flex-1">{{ item.name }}</p>
                    </div>
                    <div class="flex gap-2 items-center justify-between mt-2">
                        <QuantitySelector :model-value="item.quantity" compact />
                        <span class="font-semibold text-sm">{{ (item.price * item.quantity).toFixed(2) }}€</span>
                    </div>
                </div>
            </div>

            <!-- Black Footer Section -->
            <div class="bg-black-1 text-white p-4 space-y-3">
                <div class="flex justify-between items-center font-semibold text-lg">
                    <span>Total :</span>
                    <span>{{ total.toFixed(2) }}€</span>
                </div>
                
                <div class="space-y-2">
                    <div class="w-fit max-w-full mx-auto space-y-2">
                        <button
                            type="button"
                            class="w-full px-3 py-2 text-sm font-medium text-beige-light flex items-center justify-start gap-2"
                        >
                            <img
                                src="/logos/icon-trash.svg"
                                alt=""
                                class="h-4 w-4 md:h-4 md:w-4"
                            />
                            Vider le panier
                        </button>
                        <button
                            type="button"
                            class="w-full px-3 py-2 text-sm font-medium text-beige-light flex items-center justify-center gap-2"
                        >
                            <img
                                src="/logos/icon-cart-beige.svg"
                                alt=""
                                class="h-4 w-4 md:h-4 md:w-4"
                            />
                            Voir le détail du panier
                        </button>
                    </div>
                     <PurchaseActionButton type="button" class="w-full px-3 py-2 text-sm font-medium bg-green-light rounded">
                        Valider la commande
                    </PurchaseActionButton>
                    
                </div>
            </div>
        </div>
    </aside>
</template>