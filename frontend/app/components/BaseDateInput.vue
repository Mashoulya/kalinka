<script setup lang="ts">
import { ref, watch } from 'vue'

const props = defineProps<{
  modelValue?: string
}>()

const emit = defineEmits<{
  (e: 'update:modelValue', value: string): void
}>()

const currentYear = new Date().getFullYear()

const day = ref(props.modelValue?.split('-')[2] ?? '')
const month = ref(props.modelValue?.split('-')[1] ?? '')
const year = ref(props.modelValue?.split('-')[0] ?? '')

watch(
  () => props.modelValue,
  (value) => {
    if (!value) {
      day.value = ''
      month.value = ''
      year.value = ''
      return
    }

    const [y, m, d] = value.split('-')
    year.value = y ?? ''
    month.value = m ?? ''
    day.value = d ?? ''
  }
)

watch([day, month, year], ([d, m, y]) => {
  if (!d || !m || !y) {
    emit('update:modelValue', '')
    return
  }

  emit('update:modelValue', `${y}-${m}-${d}`)
})
</script>

<template>
  <div class="flex justify-start md:justify-between gap-3 w-full max-w-full">
    <select
      v-model="day"
      class="rounded-lg border border-black/25 outline-none py-3 px-2 text-sm bg-white appearance-none w-full max-w-[90px] font-semibold placeholder:font-semibold focus:ring-2 focus:ring-green-light"
      style="background-image: url('data:image/svg+xml;utf8,<svg fill=\'none\' stroke=\'%23C0392B\' stroke-width=\'2\' viewBox=\'0 0 24 24\' xmlns=\'http://www.w3.org/2000/svg\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M19 9l-7 7-7-7\'></path></svg>'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1.25em 1.25em;"
    >
      <option value="" disabled class="font-semibold text-black">JJ</option>
      <option v-for="i in 31" :key="`d-${i}`" :value="String(i).padStart(2, '0')">{{ String(i).padStart(2, '0') }}</option>
    </select>

    <select
      v-model="month"
      class="rounded-lg border border-black/25 outline-none py-3 px-2 text-sm bg-white appearance-none w-full max-w-[90px] font-semibold placeholder:font-semibold focus:ring-2 focus:ring-green-light"
      style="background-image: url('data:image/svg+xml;utf8,<svg fill=\'none\' stroke=\'%23C0392B\' stroke-width=\'2\' viewBox=\'0 0 24 24\' xmlns=\'http://www.w3.org/2000/svg\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M19 9l-7 7-7-7\'></path></svg>'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1.25em 1.25em;"
    >
      <option value="" disabled class="font-semibold text-black">MM</option>
      <option v-for="i in 12" :key="`m-${i}`" :value="String(i).padStart(2, '0')">{{ String(i).padStart(2, '0') }}</option>
    </select>

    <select
      v-model="year"
      class="rounded-lg border border-black/25 outline-none py-3 px-2 text-sm bg-white appearance-none w-full max-w-[110px] font-semibold placeholder:font-semibold focus:ring-2 focus:ring-green-light"
      style="background-image: url('data:image/svg+xml;utf8,<svg fill=\'none\' stroke=\'%23C0392B\' stroke-width=\'2\' viewBox=\'0 0 24 24\' xmlns=\'http://www.w3.org/2000/svg\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M19 9l-7 7-7-7\'></path></svg>'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1.25em 1.25em;"
    >
      <option value="" disabled class="font-semibold text-black">AAAA</option>
      <option v-for="i in 100" :key="`y-${i}`" :value="String(currentYear - i + 1)">{{ currentYear - i + 1 }}</option>
    </select>
  </div>
</template>
