<script setup lang="ts">
</script>

<template>
    <section class="py-10 px-5 md:px-20 md:py-20">
        <h1 class="text-red-light text-3xl font-bold text-center mb-14 md:text-5xl">Création de compte</h1>
        <div class="flex justify-between items-center bg-green-light/5 border border-black/25 rounded-lg p-10 mb-10">
            <span class="font-semibold">Mes coordonnées</span>
            <span class="font-semibold">1/2</span>
        </div>
        <form action="" class="grid grid-cols-1 gap-x-6 gap-y-4 items-center md:grid-cols-[200px_minmax(0,320px)]">
            <label class="font-semibold text-lg md:text-right" for="civility-mrs">Civilité *</label>
            <div class="inline-flex w-full rounded-lg border border-black/25 p-1">
                <label class="flex-1">
                    <input type="radio" id="civility-mrs" name="civility" value="Mrs" class="peer sr-only py-3" checked>
                    <span class="block w-full cursor-pointer rounded-md px-2 py-3 text-center font-medium leading-none text-black transition peer-checked:bg-green-light peer-checked:text-white">Madame</span>
                </label>
                <label class="flex-1">
                    <input type="radio" id="civility-mr" name="civility" value="Mr" class="peer sr-only py-3">
                    <span class="block w-full cursor-pointer rounded-md px-2 py-3 text-center font-medium leading-none text-black transition peer-checked:bg-green-light peer-checked:text-white">Monsieur</span>
                </label>
                <label class="flex-1">
                    <input type="radio" id="civility-other" name="civility" value="Other" class="peer sr-only py-3">
                    <span class="block w-full cursor-pointer rounded-md px-2 py-3 text-center font-medium leading-none text-black transition peer-checked:bg-green-light peer-checked:text-white">Autres</span>
                </label>
            </div>

            <!-- Nom -->
            <label for="lastName" class="font-semibold text-lg md:text-right">Nom *</label>
            <input type="text" id="lastName" name="lastName" placeholder="Nom" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">

            <!-- Prénom -->
            <label for="firstName" class="font-semibold text-lg md:text-right">Prénom *</label>
            <input type="text" id="firstName" name="firstName" placeholder="Prénom" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">

            <!-- Date de naissance -->
            <label class="font-semibold text-lg md:text-right">Date de naissance *</label>
            <BaseDateInput name="birthDate" />

            <!-- Code postal -->
            <label for="postalCode" class="font-semibold text-lg md:text-right">Code postal *</label>
            <input type="text" id="postalCode" name="postalCode" placeholder="Code postal" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">

            <!-- Ville -->
            <label for="city" class="font-semibold text-lg md:text-right">Ville *</label>
            <input type="text" id="city" name="city" placeholder="Ville" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">

            <!-- Téléphone -->
            <label for="phone" class="font-semibold text-lg md:text-right">Téléphone *</label>
            <input type="tel" id="phone" name="phone" placeholder="Numéro de téléphone" class="rounded-lg border border-black/25 outline-none w-full py-3 px-2 text-sm">

            <!-- Infos obligatoires -->
            <span class="text-sm text-center md:col-start-2 md:text-right">* Informations obligatoires</span>

            <!-- Bouton valider -->
            <BaseButton type="submit" class="mt-4 md:col-start-2">Valider</BaseButton>
        </form>
    </section>
</template>