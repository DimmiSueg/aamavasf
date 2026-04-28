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

            <div ref="statsRef" class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-8 max-w-3xl mx-auto">
                <div v-for="(stat, i) in stats" :key="stat.label" class="text-center">
                    <div class="text-4xl font-extrabold text-yellow-400 tabular-nums">
                        {{ stat.prefix }}{{ counts[i] }}{{ stat.suffix }}
                    </div>
                    <div class="text-white/70 text-sm mt-2 leading-snug">{{ stat.label }}</div>
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
import { ref, onMounted, onUnmounted } from 'vue'

const stats = [
    { target: 50,  prefix: '+', suffix: '',  label: 'crianças e adolescentes atendidos' },
    { target: 100, prefix: '+', suffix: '',  label: 'famílias apoiadas' },
    { target: 5,   prefix: '',  suffix: '',  label: 'anos de atuação' },
    { target: 30,  prefix: '+', suffix: '',  label: 'voluntários' },
]

const counts = ref(stats.map(() => 0))
const statsRef = ref(null)
let observer = null

function animateCounters() {
    const duration = 2000
    const steps = 60

    stats.forEach((stat, i) => {
        const stepTime = duration / steps
        const stepValue = stat.target / steps
        let current = 0

        const timer = setInterval(() => {
            current += stepValue
            if (current >= stat.target) {
                counts.value[i] = stat.target
                clearInterval(timer)
            } else {
                counts.value[i] = Math.floor(current)
            }
        }, stepTime)
    })
}

onMounted(() => {
    observer = new IntersectionObserver(
        ([entry]) => {
            if (entry.isIntersecting) {
                animateCounters()
                observer.disconnect()
            }
        },
        { threshold: 0.4 }
    )
    if (statsRef.value) observer.observe(statsRef.value)
})

onUnmounted(() => observer?.disconnect())
</script>
