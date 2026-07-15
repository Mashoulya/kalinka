<template>
    <div>
        <Navbar />
        <main>
            <slot />
        </main>
        <Footer v-if="$route.path !== '/shop' && !$route.path.startsWith('/products/')" />
    </div>
</template>