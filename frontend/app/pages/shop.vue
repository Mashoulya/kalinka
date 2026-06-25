<!-- pages/shop.vue -->
<script setup>

</script>

<template>
  <section class="min-h-screen bg-white-section md:grid md:grid-cols-6">
    <SidebarMenu class="md:col-span-1 md:self-stretch md:sticky md:top-0 md:h-screen md:overflow-y-auto" />

    <div class="md:col-span-4 flex min-w-0 flex-col">
      <div class="flex-1 px-5 py-10 md:px-10 md:py-14 lg:px-16">
        <h1 class="mb-10 text-center text-3xl font-bold text-red-light md:mb-14 md:text-5xl">Boutique</h1>

        <div class="grid grid-cols-1 gap-8">
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
           
          </div>

          <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            
          </div>
        </div>
      </div>

      <Footer />
    </div>

    <aside class="md:col-span-1 md:sticky md:top-0 md:h-screen md:overflow-y-auto bg-black-1 text-white">
      Panier
    </aside>
  </section>
</template>