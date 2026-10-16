<script setup lang="ts">
const props = withDefaults(
  defineProps<{
    modelValue?: number;
    min?: number;
    step?: number;
    compact?: boolean;
  }>(),
  {
    modelValue: 0,
    min: 0,
    step: 1,
    compact: false,
  }
);

const emit = defineEmits<{
  (e: "update:modelValue", value: number): void;
}>();

const increment = () => {
  emit("update:modelValue", props.modelValue + props.step);
};

const decrement = () => {
  emit("update:modelValue", Math.max(props.min, props.modelValue - props.step));
};
</script>

<template>
        <div :class="['inline-flex items-center rounded-md bg-black', props.compact ? 'h-[22px]' : '']">
          <button
            @click="decrement"
          :class="['flex w-6 items-center justify-center font-bold text-white', props.compact ? 'h-full text-sm leading-none' : 'text-lg']"
            type="button"
            aria-label="Diminuer la quantité"
          >
            −
          </button>
          <span :class="['w-6 text-center font-semibold text-white', props.compact ? 'flex h-full items-center justify-center text-xs leading-none' : 'text-base']">{{
            props.modelValue
          }}</span>
          <button
            @click="increment"
            :class="['flex w-6 items-center justify-center font-bold text-white', props.compact ? 'h-full text-sm leading-none' : 'text-lg']"
            type="button"
            aria-label="Augmenter la quantité"
          >
            +
          </button>
        </div>
</template>