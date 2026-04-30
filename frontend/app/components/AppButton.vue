<script setup lang="ts">
import { computed } from "vue";

const props = withDefaults(
  defineProps<{
    to?: string;
    variant?: "white-btn" | "red-btn";
    iconSrc: string;
    iconAlt?: string;
  }>(),
  {
    to: undefined,
    variant: "red-btn",
    iconAlt: "button icon",
  }
);

const rootTag = computed(() => (props.to ? "NuxtLink" : "button"));

const rootProps = computed(() =>
  props.to ? { to: props.to } : { type: "button" }
);

const variantClasses = {
  "white-btn": {
    root: "bg-white text-red-light hover:text-red-dark",
    circle: "bg-red-light group-hover:bg-red-dark",
  },
  "red-btn": {
    root: "bg-red-light text-white hover:bg-red-dark",
    circle: "bg-white",
  },
};
</script>

<template>
  <component
    :is="rootTag"
    v-bind="rootProps"
    class="btn-cta group transition-colors duration-200"
    :class="variantClasses[props.variant].root"
  >
    <span class="btn-cta-label transition-colors duration-200">
      <slot />
    </span>
    <span
      class="btn-cta-circle flex items-center justify-center w-10 h-10 rounded-full transition-colors duration-200"
      :class="variantClasses[props.variant].circle"
    >
      <img
        :src="props.iconSrc"
        class="btn-cta-arrow w-4 h-4"
        :alt="props.iconAlt"
      />
    </span>
  </component>
</template>