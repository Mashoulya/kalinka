<script setup lang="ts">
import AppButton from './AppButton.vue';

</script>

<template>
<footer class="bg-black-1 flex flex-col gap-14 py-10 px-5 md:py-20 md:px-20 md:gap-20">
    <!-- Contacts -->
    <div class="flex flex-col">
        <div class="flex flex-col md:flex-row justify-between items-start gap-4">
            <div class="contacts flex flex-col items-start gap-10 md:w-1/2">
                <h2 class="text-white text-3xl font-bold md:text-5xl">Contactez-nous si vous avez des questions</h2>
                <div class="mb-14 md:mb-0">
                    <AppButton
                        variant="red-btn"
                        icon-alt="icon-arrow"
                        >
                        Contactez-nous
                    </AppButton>
                </div>
            </div>
            <div class="flex flex-col items-start md:items-end flex-shrink-0">
                <p class="text-grey-2 text-lg uppercase md:text-2xl ">Suivez-nous</p>
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
    </div>
    <span class="h-[1px] bg-white/30"></span>
    <!-- Links -->
    <div class="flex flex-col lg:flex-row justify-between items-start text-white md:gap-10">
        <div class="flex flex-col items-start gap-8 md:flex-row md:justify-between md:gap-10 lg:gap-20 mb-14">
            <div class="flex flex-col justify-center items-start">
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
        <div class="flex flex-col items-stretch justify-end gap-6">
            <h5 class="text-2xl font-semibold text-white">Entrez en contact pour savoir nos dernières promotions !</h5>
            <form action="" method="post" class="flex justify-between rounded-full bg-white py-2 px-2">
                <input type="email" name="email" placeholder="Entrez votre email" required class="border-0 bg-white text-black text-base outline-none placeholder-gray-400 ps-4">
                <button class="flex items-center justify-center px-6 py-2 flex-shrink-0 rounded-full bg-red-light text-white text-base font-semibold border-0 hover:bg-red-dark">S'abonner</button>
            </form>
        </div>
    </div>
    <!-- Legal -->
    <div class="flex flex-col-reverse justify-between items-start md:flex-row md:items-center text-grey-2">
        <h6>© 2025 Kalinka</h6>
        <div class="flex flex-col justify-start items-start mb-6 md:flex-row md:gap-6">
            <NuxtLink>
                CGV
            </NuxtLink> 
            <NuxtLink>
                Confidentialité
            </NuxtLink>
            <NuxtLink>
                Mentions légales
            </NuxtLink>
        </div>
    </div>
</footer>
</template>