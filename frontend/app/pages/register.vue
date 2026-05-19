<script setup lang="ts">

const step = ref<1 | 2>(1)

const errorMessage = ref('')

const formData = reactive({
    // Étape 1 : Mes coordonnées
    title: 'Mrs',
    lastName: '',
    firstName: '',
    birthDate: '',
    postalCode: '',
    city: '',
    phone: '',

    // Étape 2 : Mes identifiants
    email: '',
    password: '',
    confirmPassword: ''
})

const goToStep2 = () => {
    errorMessage.value = ''

    const requiredFields = [
        formData.title,
        formData.lastName,
        formData.firstName,
        formData.birthDate,
        formData.postalCode,
        formData.city,
        formData.phone
    ]

    const hasEmptyField = requiredFields.some(value => !String(value).trim())

    if (hasEmptyField) {
        errorMessage.value = 'Merci de remplir tous les champs obligatoires.'
        return
    }

    step.value = 2
}

const submitRegister = async () => {
    errorMessage.value = ''

    const allRequiredFields = [
        formData.title,
        formData.lastName,
        formData.firstName,
        formData.birthDate,
        formData.postalCode,
        formData.city,
        formData.phone,
        formData.email,
        formData.password,
        formData.confirmPassword
    ]

    const allEmptyField = allRequiredFields.some(value => !String(value).trim())

    if (allEmptyField) {
        errorMessage.value = 'Merci de remplir tous les champs obligatoires.'
        return
    }

    if (formData.password !== formData.confirmPassword) {
        errorMessage.value = 'Les mots de passe ne correspondent pas.'
        return
    }

    const payload = {
        title: formData.title,
        lastName: formData.lastName,
        firstName: formData.firstName,
        birthDate: formData.birthDate,
        postalCode: formData.postalCode,
        city: formData.city,
        phone: formData.phone,
        email: formData.email,
        password: formData.password
    }

    try {
        await $fetch('/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: payload
        })

        errorMessage.value = ''
    } catch (error) {
        const apiError = error as { data?: { error?: string; errors?: string }; message?: string }
        errorMessage.value = apiError.data?.error || apiError.data?.errors || apiError.message || 'Une erreur est survenue lors de l\'inscription.'
    }
}
</script>

<template>
    <section class="py-10 px-5 md:px-20 md:py-20">
        <h1 class="text-red-light text-3xl font-bold text-center mb-14 md:text-5xl">Création de compte</h1>
        <div class="flex justify-between items-center bg-green-light/5 border border-black/25 rounded-lg p-10 mb-10">
            <span class="font-semibold">{{ step === 1 ? 'Mes coordonnées' : 'Mes identifiants' }}</span>
            <span class="font-semibold">{{ step }}/2</span>
        </div>
        <form @submit.prevent="submitRegister()" class="grid grid-cols-1 gap-x-6 gap-y-4 items-center md:grid-cols-[200px_minmax(0,320px)]">
            <template v-if="step === 1">
                <label class="font-semibold text-lg md:text-right" for="title-mrs">Civilité *</label>
                <div class="inline-flex w-full rounded-lg border border-black/25 p-1">
                    <label class="flex-1">
                        <input v-model="formData.title" type="radio" id="title-mrs" name="title" value="Mrs" class="peer sr-only py-3" checked>
                        <span class="block w-full cursor-pointer rounded-md px-2 py-3 text-center font-medium leading-none text-black transition peer-checked:bg-green-light peer-checked:text-white">Madame</span>
                    </label>
                    <label class="flex-1">
                        <input v-model="formData.title" type="radio" id="title-mr" name="title" value="Mr" class="peer sr-only py-3">
                        <span class="block w-full cursor-pointer rounded-md px-2 py-3 text-center font-medium leading-none text-black transition peer-checked:bg-green-light peer-checked:text-white">Monsieur</span>
                    </label>
                    <label class="flex-1">
                        <input v-model="formData.title" type="radio" id="title-other" name="title" value="Other" class="peer sr-only py-3">
                        <span class="block w-full cursor-pointer rounded-md px-2 py-3 text-center font-medium leading-none text-black transition peer-checked:bg-green-light peer-checked:text-white">Autres</span>
                    </label>
                </div>

                <!-- Nom -->
                <label for="lastName" class="font-semibold text-lg md:text-right">Nom *</label>
                <input v-model="formData.lastName" type="text" id="lastName" name="lastName" placeholder="Nom" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">

                <!-- Prénom -->
                <label for="firstName" class="font-semibold text-lg md:text-right">Prénom *</label>
                <input v-model="formData.firstName" type="text" id="firstName" name="firstName" placeholder="Prénom" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">

                <!-- Date de naissance -->
                <label class="font-semibold text-lg md:text-right">Date de naissance *</label>
                <BaseDateInput v-model="formData.birthDate" name="birthDate" />

                <!-- Code postal -->
                <label for="postalCode" class="font-semibold text-lg md:text-right">Code postal *</label>
                <input v-model="formData.postalCode" type="text" id="postalCode" name="postalCode" placeholder="Code postal" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">

                <!-- Ville -->
                <label for="city" class="font-semibold text-lg md:text-right">Ville *</label>
                <input v-model="formData.city" type="text" id="city" name="city" placeholder="Ville" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">

                <!-- Téléphone -->
                <label for="phone" class="font-semibold text-lg md:text-right">Téléphone *</label>
                <input v-model="formData.phone" type="tel" id="phone" name="phone" placeholder="Numéro de téléphone" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">

                <!-- Infos obligatoires -->
                <span class="text-sm text-center md:col-start-2 md:text-right">* Informations obligatoires</span>

                <p v-if="errorMessage" class="text-sm text-red-light md:col-start-2">
                    {{ errorMessage }}
                </p>

                <!-- Bouton valider -->
                <BaseButton type="button" class="mt-4 md:col-start-2" @click="goToStep2">Valider</BaseButton>
            </template>

            <template v-else>
                 <!-- Email -->
                <label for="email" class="font-semibold text-lg md:text-right">Adresse email *</label>
                <input v-model="formData.email" type="email" id="email" name="email" placeholder="Email" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">

                <!-- Mot de passe -->
                <label for="password" class="font-semibold text-lg md:text-right">Mot de passe *</label>
                <input v-model="formData.password" type="password" id="password" name="password" placeholder="Mot de passe (8 caractères minimum)" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">

                <div class="md:col-start-2 text-sm text-left">
                    <p class="mb-1">Au minimum 8 caractères dont au moins :</p>
                    <ul>
                        <li>- 1 minuscule</li>
                        <li>- 1 majuscule</li>
                        <li>- 1 chiffre</li>
                        <li>- 1 caractère spécial</li>
                    </ul>
                </div>

                <!-- Confirmation mot de passe -->
                <label for="confirmPassword" class="font-semibold text-lg md:text-right">Confirmation mot de passe *</label>
                <input v-model="formData.confirmPassword" type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmation du mot de passe" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">

                <p v-if="errorMessage" class="text-sm text-red-light md:col-start-2">
                    {{ errorMessage }}
                </p>

                <BaseButton type="submit" class="mt-4 md:col-start-2">Valider</BaseButton>
            </template>
        </form>
    </section>
</template>