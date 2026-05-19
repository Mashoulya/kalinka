<script setup lang="ts">
defineOptions({
    inheritAttrs: false
})

const props = withDefaults(defineProps<{
    to?: string
    type?: "button" | "submit"
}>(), {
    to: undefined,
    type: "button"
})
</script>

<template>
    <!-- Lien vers une page -->
    <NuxtLink
        v-if="props.to"
        :to="props.to"
        class="inline-flex items-center justify-center rounded-full bg-green-light font-medium px-4 py-4 text-white"
        v-bind="$attrs"
    >
        <slot />
    </NuxtLink>

    <!-- Bouton de soumission ou action -->
    <button
        v-else
        :type="props.type"
        class="inline-flex items-center justify-center rounded-full bg-green-light font-medium px-4 py-4 text-white"
        v-bind="$attrs"
    >
        <slot />
    </button>
</template>