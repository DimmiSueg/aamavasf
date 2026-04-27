<template>
    <section id="hero" class="relative min-h-screen flex items-center justify-center bg-[#1B2A6B] overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-[#2D3AB0]/30 blur-3xl" />
            <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-blue-900/40 blur-3xl" />
        </div>

        <div class="container mx-auto px-4 pt-24 pb-16 relative z-10 text-center">
            <div class="flex justify-center mb-8">
                <img src="/logo-branco.png" alt="AAMAVASF" class="w-auto h-32 md:h-44" />
            </div>

            <h1 class="text-white text-4xl md:text-6xl font-extrabold leading-tight mb-4">
                Juntos pelo Autismo no<br />
                <span class="text-yellow-400">Vale do São Francisco</span>
            </h1>

            <p class="text-white/80 text-lg md:text-xl max-w-2xl mx-auto mb-10">
                Uma associação formada por famílias que acreditam que toda pessoa no espectro
                autista merece apoio, inclusão e uma vida plena.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#faca-parte" class="btn-secondary text-lg px-8 py-4">Quero Fazer Parte</a>
                <a href="#doacao" class="inline-flex items-center justify-center px-8 py-4 rounded-full bg-yellow-400 hover:bg-yellow-300 text-[#1B2A6B] font-bold text-lg transition-all">
                    Fazer uma Doação
                </a>
            </div>

            <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto">
                <div v-for="stat in stats" :key="stat.label" class="text-center">
                    <div class="text-3xl font-extrabold text-yellow-400">{{ stat.number }}</div>
                    <div class="text-white/70 text-sm mt-1">{{ stat.label }}</div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </section>
</template>

<script setup>
const stats = [
    { number: '1 em 44', label: 'crianças são autistas' },
    { number: '2M+', label: 'pessoas com autismo no Brasil' },
    { number: '100%', label: 'sem fins lucrativos' },
    { number: 'VSF', label: 'Vale do São Francisco' },
]
</script>
