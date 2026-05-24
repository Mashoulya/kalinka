<script setup lang="ts">
type OrderItem = {
    id: number
    totalPrice: string
    status: string
    createdAt: string
}

const orders = ref<OrderItem[]>([])
const isLoading = ref(false)
const errorMessage = ref('')
const { authToken } = useAuth()

async function findOrders() {
    if(!authToken.value) {
        orders.value = []
        errorMessage.value = 'Vous devez être connecté pour voir vos commandes.'
        return
    }

    isLoading.value = true

    try {
        const response = await $fetch<OrderItem[]>('/api/orders', {
            method: 'GET',
            headers: {
                Authorization: `Bearer ${authToken.value}`
            }
        })
        orders.value = response 
    } catch(error) {
        orders.value = []
        errorMessage.value = 'Une erreur est survenue lors de la récupération des commandes.'
    } finally {
        isLoading.value = false
    }
}

onMounted(() => {
    findOrders()
})
</script>

<template>
    <section class="py-10 px-5 md:px-20 md:py-20">
        <h1 class="text-red-light text-3xl font-bold text-center mb-14 md:text-5xl">Mon compte</h1>
        <!-- commandes -->
        <div class="flex justify-between items-center bg-green-light/5 border border-black/25 rounded-lg p-10 mb-10">
            <span class="font-semibold">Mes commandes</span>
            <span class="font-semibold">{{ orders.length }}/3</span>
        </div>

        <p v-if="isLoading" class="mb-6 font-medium">Chargement des commandes...</p>
        <p v-else-if="errorMessage" class="mb-6 font-medium text-red-light">{{ errorMessage }}</p>

        <table class="w-full border-collapse">
            <thead class="border-b border-black/15">
                <tr class="text-left">
                    <th class="py-5 pr-6 font-semibold">N° de Commande</th>
                    <th class="py-5 pr-6 font-semibold">Date</th>
                    <th class="py-5 pr-6 font-semibold">Prix</th>
                    <th class="py-5 font-semibold">État</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" :key="order.id" class="border-b border-black/15 last:border-b-0">
                    <td class="py-5 pr-6">#{{ order.id }}</td>
                    <td class="py-5 pr-6">{{ order.createdAt }}</td>
                    <td class="py-5 pr-6">{{ order.totalPrice }}</td>
                    <td class="py-5">
                        <span
                            class="mr-3 inline-block h-2 w-2 rounded-full align-middle"
                            :class="order.status === 'paid' ? 'bg-green-light' : 'bg-red-light'"
                        ></span>{{ order.status }}
                    </td>
                </tr>
                <tr v-if="!isLoading && !errorMessage && orders.length === 0">
                    <td colspan="4" class="py-5 text-center text-black/60">Aucune commande trouvée.</td>
                </tr>
            </tbody>
        </table>

        <!-- identifiants -->
        <div class="flex justify-between items-center bg-green-light/5 border border-black/25 rounded-lg p-10 mb-10">
            <span class="font-semibold">Mes identifiants</span>
            <span class="font-semibold">2/3</span>
        </div>

        <!-- coordonnées -->
        <div class="flex justify-between items-center bg-green-light/5 border border-black/25 rounded-lg p-10 mb-10">
            <span class="font-semibold">Mes coordonnées</span>
            <span class="font-semibold">3/3</span>
        </div>
    </section>
</template>