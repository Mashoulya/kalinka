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
    <!-- Link to the page -->
    <NuxtLink
        v-if="props.to"
        :to="props.to"
        class="inline-flex items-center justify-center rounded-full bg-green-light font-medium px-4 py-4 text-white"
        v-bind="$attrs"
    >
        <slot />
    </NuxtLink>

    <!-- Submit or action button -->
    <button
        v-else
        :type="props.type"
        class="inline-flex items-center justify-center rounded-full bg-green-light font-medium px-4 py-4 text-white"
        v-bind="$attrs"
    >
        <slot />
    </button>
</template>