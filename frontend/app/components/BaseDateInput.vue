<template>
  <div class="flex gap-3 w-full max-w-full">
    <select class="rounded-lg border border-black/25 outline-none py-3 px-2 text-sm bg-white appearance-none w-full max-w-[90px] font-semibold placeholder:font-semibold focus:ring-2 focus:ring-green-light"
      style="background-image: url('data:image/svg+xml;utf8,<svg fill=\'none\' stroke=\'%23C0392B\' stroke-width=\'2\' viewBox=\'0 0 24 24\' xmlns=\'http://www.w3.org/2000/svg\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M19 9l-7 7-7-7\'></path></svg>'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1.25em 1.25em;">
      <option disabled selected class="font-semibold text-black">JJ</option>
      <option v-for="i in 31" :key="i">{{ String(i).padStart(2, '0') }}</option>
    </select>

    <select class="rounded-lg border border-black/25 outline-none py-3 px-2 text-sm bg-white appearance-none w-full max-w-[90px] font-semibold placeholder:font-semibold focus:ring-2 focus:ring-green-light"
      style="background-image: url('data:image/svg+xml;utf8,<svg fill=\'none\' stroke=\'%23C0392B\' stroke-width=\'2\' viewBox=\'0 0 24 24\' xmlns=\'http://www.w3.org/2000/svg\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M19 9l-7 7-7-7\'></path></svg>'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1.25em 1.25em;">
      <option disabled selected class="font-semibold text-black">MM</option>
      <option v-for="i in 12" :key="i">{{ String(i).padStart(2, '0') }}</option>
    </select>

    <select class="rounded-lg border border-black/25 outline-none py-3 px-2 text-sm bg-white appearance-none w-full max-w-[110px] font-semibold placeholder:font-semibold focus:ring-2 focus:ring-green-light"
      style="background-image: url('data:image/svg+xml;utf8,<svg fill=\'none\' stroke=\'%23C0392B\' stroke-width=\'2\' viewBox=\'0 0 24 24\' xmlns=\'http://www.w3.org/2000/svg\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M19 9l-7 7-7-7\'></path></svg>'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1.25em 1.25em;">
      <option disabled selected class="font-semibold text-black">AAAA</option>
      <option v-for="i in 100" :key="i">{{ new Date().getFullYear() - i + 1 }}</option>
    </select>
  </div>
</template>
