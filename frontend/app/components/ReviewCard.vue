<script setup lang="ts">
    defineProps<{
        userName: string;
        rating: number;
        comment: string;
    }>();
</script>

<template>
    <div class="bg-black-1 w-full p-6 rounded-2xl space-y-6">
        <img src="/logos/icon-quote.svg" alt="quote icon">
        <p class="text-white">{{ comment }}</p>
        <div class="bg-black-2 rounded-2xl p-5 flex items-center justify-between">
            <img src="/logos/profile1.jpg" alt="user profile" class="w-[56px] rounded-full">
            <div>
                <span>{{ rating }}</span>
                <p class="text-white">{{ userName }}</p>
            </div>
        </div>
    </div>
</template>