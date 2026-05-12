<script setup lang="ts">
    defineProps<{
        userName: string;
        rating: number;
        comment: string;
    }>();
</script>

<template>
    <article class="bg-black-1 w-full h-full p-6 rounded-2xl flex flex-col gap-6">
        <img src="/logos/icon-quote.svg" alt="" aria-hidden="true" class="w-14 h-14 object-contain">
        <blockquote class="text-white">{{ comment }}</blockquote>
        <div class="bg-black-2 rounded-2xl p-5 flex items-center justify-between mt-auto">
            <img src="/logos/profile1.jpg" :alt="`Photo de profil de ${userName}`" class="w-[56px] rounded-full">
            <div>
                <span role="img" :aria-label="`Note ${rating} sur 5`">
                    <span aria-hidden="true">{{ '⭐'.repeat(rating) }}</span>
                </span>
                <p class="text-white">{{ userName }}</p>
            </div>
        </div>
    </article>
</template>