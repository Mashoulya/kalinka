<script setup lang="ts">
import { computed } from "vue";

const props = withDefaults(
  defineProps<{
    to?: string;
    variant?: "white-btn" | "red-btn" | "black-btn";
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
    arrow: "text-white",
  },
  "red-btn": {
    root: "bg-red-light text-white hover:bg-red-dark",
    circle: "bg-white",
    arrow: "text-red-light",
  },
  "black-btn": {
    root: "bg-black text-white hover:bg-black-2",
    circle: "bg-white",
    arrow: "text-black-2",
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
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 18 20"
        class="btn-cta-arrow w-4 h-4"
        :class="variantClasses[props.variant].arrow"
        :aria-label="props.iconAlt"
        role="img"
      >
        <path
          d="M17.4842 0.67984L17.4833 3.42316L17.4842 8.35528C17.4842 10.4966 15.7485 12.2323 13.6072 12.2323L13.6072 7.29925L1.88489 19.0216C0.371175 17.5079 0.371175 15.0542 1.88489 13.5405L10.8694 4.55593L5.93637 4.55593C5.93729 2.41554 7.67299 0.67984 9.81338 0.678926L14.7446 0.678927L17.4833 0.678927L17.4842 0.67984Z"
          fill="currentColor"
        />
      </svg>
    </span>
  </component>
</template>