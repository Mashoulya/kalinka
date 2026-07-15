<script setup lang="ts">
const props = withDefaults(
  defineProps<{
    modelValue?: number;
    min?: number;
    step?: number;
  }>(),
  {
    modelValue: 0,
    min: 0,
    step: 1,
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
    <div class="inline-flex items-center bg-black rounded-md">
          <button
            @click="decrement"
            class="text-white text-lg font-bold w-6 flex items-center justify-center"
            type="button"
            aria-label="Diminuer la quantité"
          >
            −
          </button>
          <span class="text-white text-base font-semibold w-6 text-center">{{
            props.modelValue
          }}</span>
          <button
            @click="increment"
            class="text-white text-lg font-bold w-6 flex items-center justify-center"
            type="button"
            aria-label="Augmenter la quantité"
          >
            +
          </button>
        </div>
</template>