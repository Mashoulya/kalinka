<script setup lang="ts">
</script>

<template>
    <main>
        <h1 class="text-red-light text-5xl font-bold text-center">Connexion</h1>
        <section class="flex">
            <article>
                <h2 class="text-3xl font-semibold">Déjà client ?</h2>
                <p class="font-medium">Vos identifiants vous permettent désormais de vous connecter à Kalinka.</p>
                <form action="" class="flex flex-col">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" id="email" placeholder="Adresse email">

                    <label for="password" class="sr-only">Mot de passe</label>
                    <input type="password" id="password" placeholder="Mot de passe">

                    <BaseButton type="submit">
                        Se connecter
                    </BaseButton>
                </form>
            </article>

            <article class="bg-green-light/5">
                <h2 class="text-3xl font-semibold">Nouveau client ?</h2>
                <p class="font-medium">Créer votre compte unique Kalinka pour passer votre commande et bénéficier des avantages Kalinka.</p>
                <form action="" class="flex flex-col">
                    <BaseButton type="submit">
                        Créer un compte
                    </BaseButton>
                </form>
            </article>
        </section>
    </main>
</template>