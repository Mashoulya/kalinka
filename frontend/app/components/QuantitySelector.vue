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
          :class="['flex items-center justify-center font-bold text-white', props.compact ? 'h-full w-[18px] text-sm leading-none xl:w-6' : 'w-6 text-lg']"
            type="button"
            aria-label="Diminuer la quantité"
          >
            <svg class="size-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M2 6h8" /></svg>
          </button>
          <span :class="['text-center font-semibold text-white', props.compact ? 'flex h-full w-[18px] items-center justify-center text-xs leading-none xl:w-6' : 'w-6 text-base']">{{
            props.modelValue
          }}</span>
          <button
            @click="increment"
            :class="['flex items-center justify-center font-bold text-white', props.compact ? 'h-full w-[18px] text-sm leading-none xl:w-6' : 'w-6 text-lg']"
            type="button"
            aria-label="Augmenter la quantité"
          >
            <svg class="size-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M2 6h8M6 2v8" /></svg>
          </button>
        </div>
</template>