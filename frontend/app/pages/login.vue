<script setup lang="ts">
</script>

<template>
    <section class="py-10 px-5 md:px-20 md:py-20">
        <h1 class="text-red-light text-3xl font-bold text-center mb-14 md:text-5xl">Connexion</h1>
        <div class="flex flex-col w-full gap-12 lg:flex-row">
            <article class="flex flex-1 flex-col border border-black/25 rounded-lg p-10">
                <h2 class="text-3xl font-semibold mb-2">Déjà client ?</h2>
                <p class="font-medium mb-5">Vos identifiants vous permettent désormais de vous connecter à Kalinka.</p>
                <form action="" class="flex flex-1 flex-col gap-2">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" id="email" placeholder="Adresse email" class="border border-black/25 rounded-md py-2 px-3">

                    <label for="password" class="sr-only">Mot de passe</label>
                    <input type="password" id="password" placeholder="Mot de passe" class="border border-black/25 rounded-md py-2 px-3">

                    <NuxtLink class="text-sm text-end font-medium text-red-light mb-5">Mot de passe oublié ?</NuxtLink>

                    <BaseButton type="submit" class="mt-auto">
                        Se connecter
                    </BaseButton>
                </form>
            </article>

            <article class="flex flex-1 flex-col bg-green-light/5 border border-black/25 rounded-lg p-10">
                <h2 class="text-3xl font-semibold mb-2">Nouveau client ?</h2>
                <p class="font-medium mb-5">Créer votre compte unique Kalinka pour passer votre commande et bénéficier des avantages Kalinka.</p>
                <form action="" class="flex flex-1 flex-col gap-2">
                    <BaseButton to="/register" class="mt-auto">
                        Créer un compte
                    </BaseButton>
                </form>
            </article>
        </div>
    </section>
</template>