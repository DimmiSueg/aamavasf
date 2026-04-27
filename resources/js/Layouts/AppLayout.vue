<script setup>
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
</script>

<template>
    <div class="min-h-screen font-sans antialiased bg-white text-gray-800">
        <Header />
        <main>
            <slot />
        </main>
        <Footer />
    </div>
</template>
