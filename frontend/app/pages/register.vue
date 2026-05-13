<script setup lang="ts">
</script>

<template>
    <section class="py-10 px-5 md:px-20 md:py-20">
        <h1 class="text-red-light text-3xl font-bold text-center mb-14 md:text-5xl">Création de compte</h1>
        <p class="mb-10 font-medium">Mes coordonnées 1/2</p>
        <form action="" class="space-y-8">
            <fieldset>
                <legend class="sr-only">Civilité *</legend>

                <div class="flex flex-wrap items-center gap-3 md:gap-8">
                    <span class="font-semibold leading-none">Civilité *</span>

                    <div class="inline-flex w-fit rounded-lg border border-black/20 bg-white p-1">
                        <label>
                            <input
                                type="radio"
                                name="civilite"
                                value="madame"
                                class="peer sr-only"
                                checked
                            >
                            <span class="block cursor-pointer rounded-md px-7 py-3 font-medium leading-none text-black transition peer-checked:bg-green-light peer-checked:text-white">
                                Madame
                            </span>
                        </label>

                        <label>
                            <input
                                type="radio"
                                name="civilite"
                                value="monsieur"
                                class="peer sr-only"
                            >
                            <span class="block cursor-pointer rounded-md px-7 py-3 font-medium leading-none text-black transition peer-checked:bg-green-light peer-checked:text-white">
                                Monsieur
                            </span>
                        </label>

                        <label>
                            <input
                                type="radio"
                                name="civilite"
                                value="autres"
                                class="peer sr-only"
                            >
                            <span class="block cursor-pointer rounded-md px-7 py-3 font-medium leading-none text-black transition peer-checked:bg-green-light peer-checked:text-white">
                                Autres
                            </span>
                        </label>
                    </div>
                </div>
            </fieldset>
        </form>
    </section>
</template>