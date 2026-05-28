<script setup lang="ts">
definePageMeta({
    middleware: 'auth'
})

// ORDERS
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


// USER INFO
type MeResponse = {
    credentials?: { email?: string }
    profile?: {
        title?: string
        lastName?: string
        firstName?: string
        birthDate?: string
        postalCode?: string
        city?: string
        phone?: string
    }
}

const userInfo = reactive({
    email: '',
    title: '',
    lastName: '',
    firstName: '',
    birthDate: '',
    postalCode: '',
    city: '',
    phone: ''
})

async function fetchUserInfo() {
    try {
        const response = await $fetch<MeResponse>('/api/me', {
            method: 'GET',
            headers: {
                Authorization: `Bearer ${authToken.value}`
            }
        })
        userInfo.email = response.credentials?.email || ''
        userInfo.title = response.profile?.title || ''
        userInfo.lastName = response.profile?.lastName || ''
        userInfo.firstName = response.profile?.firstName || ''
        userInfo.birthDate = response.profile?.birthDate || ''
        userInfo.postalCode = response.profile?.postalCode || ''
        userInfo.city = response.profile?.city || ''
        userInfo.phone = response.profile?.phone || ''
    } catch (error) {
        // Optionnel: gestion d'erreur
    }
}

onMounted(() => {
    fetchUserInfo()
})
</script>

<template>
    <section class="py-10 space-y-10 px-5 md:px-20 md:py-20 md:space-y-20">
        <h1 class="text-red-light text-3xl font-bold text-center mb-14 md:text-5xl">Mon compte</h1>
        <!-- commandes -->
        <div class="flex justify-between items-center bg-green-light/5 border border-black/25 rounded-lg p-10">
            <span class="font-semibold text-lg">Mes commandes</span>
            <span class="font-semibold text-lg">{{ orders.length }}/3</span>
        </div>

        <p v-if="isLoading" class="mb-6 font-medium">Chargement des commandes...</p>
        <p v-else-if="errorMessage" class="mb-6 font-medium text-red-light">{{ errorMessage }}</p>

        <div class="px-10">
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
        </div>
       
        <!-- identifiants -->
        <div class="flex justify-between items-center bg-green-light/5 border border-black/25 rounded-lg p-10">
            <span class="font-semibold text-lg">Mes identifiants</span>
            <span class="font-semibold text-lg">2/3</span>
        </div>

        <form class="grid grid-cols-1 gap-x-6 gap-y-4 items-center md:grid-cols-[200px_minmax(0,320px)_auto]">
            <label for="email" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-1">Adresse email *</label>
            <input type="email" id="email" name="email" placeholder="Email" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-1">

            <label for="password" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-2">Mot de passe *</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe (8 caractères minimum)" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-2">
            <button type="button" class="justify-self-start text-red-light font-semibold underline underline-offset-2 md:col-start-3 md:row-start-2 md:self-center">Modifier le mot de passe</button>
        </form>

        <!-- coordonnées -->
        <div class="flex justify-between items-center bg-green-light/5 border border-black/25 rounded-lg p-10">
            <span class="font-semibold text-lg">Mes coordonnées</span>
            <span class="font-semibold text-lg">3/3</span>
        </div>
        
        <form class="grid grid-cols-1 gap-x-6 gap-y-4 items-center md:grid-cols-[200px_minmax(0,320px)_auto]">
            <label class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-1" for="title-mrs">Civilité *</label>
            <div class="inline-flex w-full rounded-lg border border-black/25 p-1 md:col-start-2 md:row-start-1">
                <label class="flex-1">
                    <input type="radio" id="title-mrs" name="title" value="Mrs" class="peer sr-only py-3" v-model="userInfo.title">
                    <span class="block w-full cursor-pointer rounded-md px-2 py-3 text-center font-medium leading-none text-black transition peer-checked:bg-green-light peer-checked:text-white">Madame</span>
                </label>
                <label class="flex-1">
                    <input type="radio" id="title-mr" name="title" value="Mr" class="peer sr-only py-3" v-model="userInfo.title">
                    <span class="block w-full cursor-pointer rounded-md px-2 py-3 text-center font-medium leading-none text-black transition peer-checked:bg-green-light peer-checked:text-white">Monsieur</span>
                </label>
                <label class="flex-1">
                    <input type="radio" id="title-other" name="title" value="Other" class="peer sr-only py-3" v-model="userInfo.title">
                    <span class="block w-full cursor-pointer rounded-md px-2 py-3 text-center font-medium leading-none text-black transition peer-checked:bg-green-light peer-checked:text-white">Autres</span>
                </label>
            </div>

            <!-- Nom -->
            <label for="lastName" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-2">Nom *</label>
            <input v-model="userInfo.lastName" type="text" id="lastName" name="lastName" placeholder="Nom" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-2">

            <!-- Prénom -->
            <label for="firstName" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-3">Prénom *</label>
            <input v-model="userInfo.firstName" type="text" id="firstName" name="firstName" placeholder="Prénom" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-3">

            <!-- Date de naissance -->
            <label class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-4">Date de naissance *</label>
            <BaseDateInput name="birthDate" v-model="userInfo.birthDate" class="md:col-start-2 md:row-start-4" />

            <!-- Code postal -->
            <label for="postalCode" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-5">Code postal *</label>
            <input v-model="userInfo.postalCode" type="text" id="postalCode" name="postalCode" placeholder="Code postal" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-5">

            <!-- Ville -->
            <label for="city" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-6">Ville *</label>
            <input v-model="userInfo.city" type="text" id="city" name="city" placeholder="Ville" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-6">

            <!-- Téléphone -->
            <label for="phone" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-7">Téléphone *</label>
            <input v-model="userInfo.phone" type="tel" id="phone" name="phone" placeholder="Numéro de téléphone" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-7">
            <button type="button" class="text-red-light font-semibold underline underline-offset-2 md:col-start-3 md:row-start-7 md:self-center md:justify-self-start">Modifier mes coordonnées</button>
        </form>
    </section>
</template>