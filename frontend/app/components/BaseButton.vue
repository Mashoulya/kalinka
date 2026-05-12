<script setup lang="ts">
import { resolveOptions } from 'vue-router/dist/unplugin/index.cjs';

const props = withDefaults(defineProps<{
    to?: string
    type?: "button" | "submit"
}>(), {
    to: undefined,
    type: "button"
})
</script>

<template>
    <component
    :is = "props.to ? 'NuxtLink' : 'button'"
    v-bind="props.to ? {to: props.to} : {type: props.type}"
    class="bg-green-light text-white py-4 px-4 rounded-full"
    >
        <slot />
    </component>
</template>