<script setup lang="ts">
definePageMeta({
    middleware: 'auth'
})

// COMMANDES
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

const profileError = ref('')
const profileSuccess = ref('')
const isUpdatingProfile = ref(false)

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

// CHANGEMENT DE MOT DE PASSE

const oldPassword = ref('')
const newPassword = ref('')
const confirmPassword = ref('')
const passwordError = ref('')
const passwordSuccess = ref('')

const showPasswordModal = ref(false)

function openPasswordModal() {
    passwordError.value = ''
    passwordSuccess.value = ''
    showPasswordModal.value = true
}
function closePasswordModal() {
    passwordError.value = ''
    passwordSuccess.value = ''
    showPasswordModal.value = false
}

async function changePassword() {
    passwordError.value = ''
    passwordSuccess.value = ''

    try {
        const response = await $fetch<{ message?: string }>('/api/me/password', {
            method: 'PUT',
            headers: {
                Authorization: `Bearer ${authToken.value}`
            },
            body: {
                oldPassword: oldPassword.value,
                newPassword: newPassword.value,
                confirmPassword: confirmPassword.value
            }
        })

        passwordSuccess.value = response.message || 'Mot de passe mis a jour avec succes'
        oldPassword.value = ''
        newPassword.value = ''
        confirmPassword.value = ''
    } catch (error) {
        const apiError = (error as { data?: { error?: string } })?.data?.error
        passwordError.value = apiError || 'Une erreur est survenue lors du changement de mot de passe'
    }
}


// MISE A JOUR DE PROFILE

async function updateProfile() {
    profileError.value = ''
    profileSuccess.value = ''

    if (!userInfo.title || !userInfo.lastName.trim() || !userInfo.firstName.trim() || !userInfo.postalCode.trim() || !userInfo.city.trim() || !userInfo.phone.trim()) {
        profileError.value = 'Enregistrement impossible : un ou plusieurs champs sont vides.'
        return
    }

    isUpdatingProfile.value = true

    try {
        const response = await $fetch<{ message?: string }>('/api/me/profile', {
            method: 'PATCH',
            headers: {
                Authorization: `Bearer ${authToken.value}`
            },
            body: {
                title: userInfo.title,
                lastName: userInfo.lastName,
                firstName: userInfo.firstName,
                postalCode: userInfo.postalCode,
                city: userInfo.city,
                phone: userInfo.phone
            }
        })

        profileSuccess.value = response.message || 'Vos coordonnées ont bien été mises à jour.'

    } catch (error) {
        const apiError = (error as { data?: { error?: string } })?.data?.error
        profileError.value = apiError || 'Une erreur est survenue lors de la mise a jour de vos coordonnees.'
    } finally {
        isUpdatingProfile.value = false
    }
}

</script>

<template>
<!-- modale modifier mdp -->

<!-- Overlay et modale pour modification du mot de passe -->
<div v-if="showPasswordModal" class="fixed inset-0 z-40 flex items-center justify-center bg-black/50 h-screen">
    <div class="bg-white rounded-lg p-8 w-full max-w-xl mx-4">
        <h2 class="text-red-light font-bold text-2xl md:text-4xl">Modification du mot de passe</h2>
        <form class="space-y-6 mt-10" @submit.prevent="changePassword">
            <div>
                <label for="oldPassword" class="font-semibold text-lg md:text-left">Mot de passe actuel *</label>
                <input v-model="oldPassword" type="password" id="oldPassword" name="oldPassword" placeholder="Ancien mot de passe" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">
            </div>
            <div>
                <label for="newPassword" class="font-semibold text-lg md:text-left">Nouveau mot de passe *</label>
                <input v-model="newPassword" type="password" id="newPassword" name="newPassword" placeholder="Nouveau mot de passe" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">
                <div class="text-sm text-left mb-1">
                    <p>Au minimum 8 caractères dont au moins :</p>
                    <ul>
                        <li>- 1 minuscule</li>
                        <li>- 1 majuscule</li>
                        <li>- 1 chiffre</li>
                        <li>- 1 caractère spécial</li>
                    </ul>
                </div>
            </div>
            <div>
                <label for="confirmPassword" class="font-semibold text-lg md:text-left">Confirmer le mot de passe *</label>
                <input v-model="confirmPassword" type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmer le mot de passe" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">
            </div>
            <span class="text-sm">* informations obligatoires</span>

            <p v-if="passwordError" class="text-sm text-red-light">{{ passwordError }}</p>
            <p v-if="passwordSuccess" class="text-sm text-green-light">{{ passwordSuccess }}</p>

            <div class="flex justify-around items-center">
                <BaseButton type="submit">Modifier le mot de passe</BaseButton>
                <button @click="closePasswordModal" type="button" class="text-red-light font-semibold underline underline-offset-2">Annuler</button>  
            </div>
            
        </form>
    </div>
</div>

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
            <label for="email" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-1">Adresse email</label>
            <input v-model="userInfo.email" type="email" id="email" name="email" placeholder="Email" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-1">

            <label for="password" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-2">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe (8 caractères minimum)" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-2">
            <button @click="openPasswordModal" type="button" class="justify-self-start text-red-light font-semibold underline underline-offset-2 md:col-start-3 md:row-start-2 md:self-center">Modifier le mot de passe</button>
        </form>

        <!-- coordonnées -->
        <div class="flex justify-between items-center bg-green-light/5 border border-black/25 rounded-lg p-10">
            <span class="font-semibold text-lg">Mes coordonnées</span>
            <span class="font-semibold text-lg">3/3</span>
        </div>
        
        <form @submit.prevent="updateProfile" class="grid grid-cols-1 gap-x-6 gap-y-4 items-center md:grid-cols-[200px_minmax(0,320px)_auto]">
            <label class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-1" for="title-mrs">Civilité</label>
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
            <label for="lastName" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-2">Nom</label>
            <input v-model="userInfo.lastName" type="text" id="lastName" name="lastName" placeholder="Nom" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-2">

            <!-- Prénom -->
            <label for="firstName" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-3">Prénom</label>
            <input v-model="userInfo.firstName" type="text" id="firstName" name="firstName" placeholder="Prénom" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-3">

            <!-- Date de naissance -->
            <div class="md:col-start-1 md:row-start-4 flex items-center gap-2 md:justify-end">
                <label class="text-lg font-semibold">Date de naissance</label>
                <img src="/logos/icon-lock-green.svg" alt="" class="h-6 w-6">
            </div>
            <BaseDateInput name="birthDate" v-model="userInfo.birthDate" :disabled="true" class="md:col-start-2 md:row-start-4"/>
            <img src="/logos/icon-question-green.svg" alt="" class="h-6 w-6 md:col-start-3 md:row-start-4 md:self-center md:justify-self-start" title="Pour modifier votre date de naissance, contactez le service client."/>
            

            <!-- Code postal -->
            <label for="postalCode" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-5">Code postal</label>
            <input v-model="userInfo.postalCode" type="text" id="postalCode" name="postalCode" placeholder="Code postal" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-5">

            <!-- Ville -->
            <label for="city" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-6">Ville</label>
            <input v-model="userInfo.city" type="text" id="city" name="city" placeholder="Ville" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-6">

            <!-- Téléphone -->
            <label for="phone" class="font-semibold text-lg md:text-right md:col-start-1 md:row-start-7">Téléphone</label>
            <input v-model="userInfo.phone" type="tel" id="phone" name="phone" placeholder="Numéro de téléphone" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm md:col-start-2 md:row-start-7">
            <button
                type="submit"
                :disabled="isUpdatingProfile"
                class="text-red-light font-semibold underline underline-offset-2 md:col-start-3 md:row-start-7 md:self-center md:justify-self-start disabled:opacity-50 disabled:cursor-not-allowed"
            >
                {{ isUpdatingProfile ? 'Enregistrement...' : 'Modifier mes coordonnées' }}
            </button>

            <p v-if="profileError" class="text-sm text-red-light md:col-start-2 md:row-start-8">{{ profileError }}</p>
            <p v-if="profileSuccess" class="text-sm text-green-light md:col-start-2 md:row-start-8">{{ profileSuccess }}</p>
        </form>
    </section>
</template>