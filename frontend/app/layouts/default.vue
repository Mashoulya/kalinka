<template>
    <div>
        <Navbar />
        <main>
            <slot />
        </main>
        <Footer v-if="$route.path !== '/shop'" />
    </div>
</template>