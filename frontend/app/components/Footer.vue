<script setup lang="ts">
import AppButton from './AppButton.vue';

</script>

<template>
<footer class="flex flex-col gap-10 bg-black-1 py-20 px-5 md:px-20">
    <!-- Contacts -->
    <div class="flex flex-col">
        <div class="flex flex-col md:flex-row justify-between items-start gap-4">
            <div class="contacts flex flex-col items-start gap-10 w-1/2">
                <h2 class="text-white text-3xl font-bold md:text-5xl">Contactez-nous si vous avez des questions</h2>
                <div class="mb-14">
                    <AppButton
                        variant="red-btn"
                        icon-alt="icon-arrow"
                        >
                        Contactez-nous
                    </AppButton>
                </div>
            </div>
            <div class="flex flex-col items-start md:items-end flex-shrink-0">
                <p class="text-grey-2 text-2xl uppercase">Suivez-nous</p>
                <div class="text-white space-x-5 mt-4">
                    <NuxtLink class="bg-black-2 py-2 px-3 rounded-full">
                        TikTok
                    </NuxtLink>
                    <NuxtLink class="bg-black-2 py-2 px-3 rounded-full">
                        Facebook
                    </NuxtLink>
                    <NuxtLink class="bg-black-2 py-2 px-3 rounded-full">
                        Instagram
                    </NuxtLink>
                </div>
            </div>
        </div>
        <span class="h-[1px] bg-grey-2"></span>
    </div>
    <!-- Links -->
    <div class="flex flex-col lg:flex-row justify-between items-start flex-shrink-0">
        <div class="flex gap-5 mb-5 flex-col lg:flex-row items-start">
            <div class="flex flex-col justify-center items-start text-white">
                <h4 class="text-grey-2 uppercase text-lg mb-5">Kalinka</h4>
                <NuxtLink>
                    Accueil
                </NuxtLink>
                <NuxtLink>
                    À propos
                </NuxtLink>
                <NuxtLink>
                    Contact
                </NuxtLink>
            </div>
            <div class="flex flex-col justify-center items-start text-white">
                <h4 class="text-grey-2 uppercase text-lg mb-5">Ressources</h4>
                <NuxtLink>
                    Nos recettes
                </NuxtLink>
                <NuxtLink>
                    Témoignages de clients
                </NuxtLink>              
            </div>
            <div class="flex flex-col justify-center items-start text-white">
                <h4 class="text-grey-2 uppercase text-lg mb-5">Aides</h4>
                <NuxtLink>
                    FAQ
                </NuxtLink> 
            </div>
        </div>
        <div class="flex flex-col items-end justify-end gap-6">
            <h5 class="text-xl text-white">Entrez en contact pour savoir nos dernières promotions !</h5>
            <form action="" method="post" class="flex justify-between items-center rounded-full bg-white py-2 px-2 gap-2">
                <input type="email" name="email" placeholder="Entrez votre email" required class="border-0 bg-white text-black text-base leading-[140%] outline-none placeholder-gray-400 flex-1 px-4">
                <button class="flex items-center justify-center px-6 py-2 flex-shrink-0 rounded-full bg-red-light text-white text-base font-semibold border-0 hover:bg-red-dark">S'abonner</button>
            </form>
        </div>
    </div>
    <!-- Legal -->
    <div class="footer-legal d-flex flex-column-reverse flex-md-row justify-content-between align-items-center">
        <h6>© 2025 Kalinka. Tous droits réservés.</h6>
        <div class="footer-legal-links">
            <a href="#">CGV</a>
            <a href="#">Confidentialité</a>
            <a href="#">Mentions légales</a>
        </div>
    </div>
</footer>
</template>