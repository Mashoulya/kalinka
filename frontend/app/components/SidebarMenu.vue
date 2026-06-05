<script setup lang="ts">
</script>

<template>
    <aside>
        <nav>
            <ul class="font-semibold">
                <li class="flex items-center">
                    <img src="/logos/icon-label.svg" class="h-10 w-10" alt="">
                    <NuxtLink to="#">Promotion</NuxtLink>
                </li>
                <li class="flex items-center">
                    <img src="/logos/icon-heart.svg" class="h-4 w-4" alt="">
                    <NuxtLink to="#">Les plus aimés</NuxtLink> 
                </li>
                <li class="flex items-center">
                    <img src="/logos/icon-category.svg" class="h-4 w-4" alt="">
                    <span>Catégories</span> 
                </li>
                <li>
                    <div class="collapse collapse-arrow">
                        <input type="checkbox" />
                        <div class="collapse-title">Catégorie 1</div>
                        <div class="collapse-content">
                            <ul>
                                <li><NuxtLink to="#">Soucatégorie 1</NuxtLink></li>
                                <li><NuxtLink to="#">Soucatégorie 2</NuxtLink></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </aside>
</template>