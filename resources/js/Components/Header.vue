<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { Link } from '@inertiajs/vue3'

const scrolled = ref(false)
const menuOpen = ref(false)

const navLinks = [
    { label: 'Início', href: '#hero' },
    { label: 'Sobre', href: '#sobre' },
    { label: 'Nossa Causa', href: '#causa' },
    { label: 'Eventos', href: '#eventos' },
    { label: 'Blog', href: '#blog' },
    { label: 'Faça Parte', href: '#faca-parte' },
    { label: 'Contato', href: '#contato' },
]

function onScroll() { scrolled.value = window.scrollY > 50 }
onMounted(() => window.addEventListener('scroll', onScroll))
onUnmounted(() => window.removeEventListener('scroll', onScroll))
</script>

<template>
    <header :class="['fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-[#1B2A6B]', scrolled ? 'shadow-lg py-2' : 'py-4']">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <a href="#hero" class="flex items-center gap-3">
                <img src="/logo-branco.png" alt="AAMAVASF" class="h-10 w-auto" />
            </a>

            <nav class="hidden lg:flex items-center gap-6">
                <a v-for="link in navLinks" :key="link.href" :href="link.href"
                   class="text-white/90 hover:text-white font-semibold text-sm transition-colors">
                    {{ link.label }}
                </a>
                <a href="#doacao" class="btn-secondary text-sm py-2 px-5">Doe Agora</a>
            </nav>

            <button class="lg:hidden text-white p-2" @click="menuOpen = !menuOpen" aria-label="Abrir menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path v-if="menuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div v-if="menuOpen" class="lg:hidden border-t border-white/20">
            <nav class="container mx-auto px-4 py-4 flex flex-col gap-3">
                <a v-for="link in navLinks" :key="link.href" :href="link.href"
                   class="text-white font-semibold py-2 border-b border-white/10"
                   @click="menuOpen = false">
                    {{ link.label }}
                </a>
                <a href="#doacao" class="btn-secondary text-center mt-2" @click="menuOpen = false">Doe Agora</a>
            </nav>
        </div>
    </header>
</template>
