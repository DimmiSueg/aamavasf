<template>
    <section
        id="hero"
        ref="heroRef"
        class="relative min-h-screen flex items-center bg-[#1B2A6B] overflow-hidden"
        @mousemove="onMouseMove"
        @mouseleave="resetMouse"
    >
        <!-- Background blurs -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-[#2D3AB0]/30 blur-3xl" />
            <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-blue-900/40 blur-3xl" />
        </div>

        <!-- Puzzle pieces (desktop only) -->
        <img
            v-for="piece in pieces"
            :key="piece.id"
            src="/images/peca.png"
            alt=""
            class="absolute pointer-events-none select-none hidden md:block"
            :style="pieceStyle(piece)"
        />

        <!-- Girl illustration (desktop only) — wrapper handles parallax, img handles float -->
        <div
            class="absolute bottom-0 right-0 pointer-events-none select-none hidden md:block"
            :style="girlWrapperStyle"
        >
            <img
                src="/images/menina.png"
                alt=""
                class="girl-float"
                style="height: 82vh; max-height: 680px;"
            />
        </div>

        <!-- Content -->
        <div class="container mx-auto px-4 pt-24 pb-16 relative z-10">
            <div class="max-w-xl mx-auto md:mx-0 text-center md:text-left">
                <div class="flex justify-center md:justify-start mb-8">
                    <img src="/logo-branco.png" alt="AAMAVASF" class="w-auto h-28 md:h-36" />
                </div>

                <h1 class="text-white text-4xl md:text-5xl font-extrabold leading-tight mb-4">
                    Juntos pelo Autismo no<br />
                    <span class="text-yellow-400">Vale do São Francisco</span>
                </h1>

                <p class="text-white/80 text-lg max-w-lg mb-10 mx-auto md:mx-0">
                    Uma associação formada por famílias que acreditam que toda pessoa no espectro
                    autista merece apoio, inclusão e uma vida plena.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="#faca-parte" class="btn-secondary text-lg px-8 py-4">Quero Fazer Parte</a>
                    <a href="#doacao" class="inline-flex items-center justify-center px-8 py-4 rounded-full bg-yellow-400 hover:bg-yellow-300 text-[#1B2A6B] font-bold text-lg transition-all">
                        Fazer uma Doação
                    </a>
                </div>
            </div>

            <!-- Stats counter -->
            <div ref="statsRef" class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8 max-w-3xl mx-auto md:mx-0">
                <div v-for="(stat, i) in stats" :key="stat.label" class="text-center">
                    <div class="text-4xl font-extrabold text-yellow-400 tabular-nums">
                        {{ stat.prefix }}{{ counts[i] }}{{ stat.suffix }}
                    </div>
                    <div class="text-white/70 text-sm mt-2 leading-snug">{{ stat.label }}</div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

// ── Parallax ──────────────────────────────────────────────
const heroRef = ref(null)
const mouseX  = ref(0) // -0.5 … +0.5 (left … right)
const mouseY  = ref(0) // -0.5 … +0.5 (top  … bottom)

function onMouseMove(e) {
    const rect = heroRef.value.getBoundingClientRect()
    mouseX.value = (e.clientX - rect.left)  / rect.width  - 0.5
    mouseY.value = (e.clientY - rect.top)   / rect.height - 0.5
}

function resetMouse() {
    mouseX.value = 0
    mouseY.value = 0
}

// Puzzle pieces — pos, size, rotation, depth (dx/dy)
const pieces = [
    // Peças grandes (já existentes)
    { id:  1, pos: { top: '8%',    left: '4%'   }, size: '110px', rotation: -20, dx:  45, dy:  30 },
    { id:  2, pos: { top: '4%',    left: '40%'  }, size: '72px',  rotation:  50, dx: -30, dy:  20 },
    { id:  3, pos: { top: '38%',   left: '1%'   }, size: '92px',  rotation:  15, dx:  55, dy: -25 },
    { id:  4, pos: { bottom: '22%',left: '8%'   }, size: '82px',  rotation: -40, dx: -45, dy:  35 },
    { id:  5, pos: { top: '10%',   right: '3%'  }, size: '100px', rotation:  65, dx:  35, dy: -45 },
    { id:  6, pos: { bottom: '32%',right: '37%' }, size: '62px',  rotation: -10, dx: -20, dy:  30 },
    // Peças menores para preencher os vazios
    { id:  7, pos: { top: '20%',   left: '22%'  }, size: '48px',  rotation:  30, dx: -25, dy:  20 },
    { id:  8, pos: { top: '55%',   left: '30%'  }, size: '42px',  rotation: -55, dx:  30, dy: -20 },
    { id:  9, pos: { top: '70%',   left: '18%'  }, size: '52px',  rotation:  80, dx: -35, dy:  25 },
    { id: 10, pos: { top: '45%',   left: '48%'  }, size: '38px',  rotation: -25, dx:  20, dy:  35 },
    { id: 11, pos: { top: '15%',   left: '60%'  }, size: '44px',  rotation:  40, dx: -40, dy: -20 },
    { id: 12, pos: { bottom: '10%',left: '38%'  }, size: '50px',  rotation: -70, dx:  25, dy: -30 },
    { id: 13, pos: { bottom: '15%',right: '20%' }, size: '40px',  rotation:  20, dx: -30, dy:  20 },
    { id: 14, pos: { top: '30%',   left: '35%'  }, size: '36px',  rotation: -45, dx:  40, dy:  15 },
    { id: 15, pos: { top: '60%',   right: '28%' }, size: '46px',  rotation:  55, dx: -20, dy: -35 },
    { id: 16, pos: { top: '3%',    right: '20%' }, size: '40px',  rotation: -30, dx:  30, dy:  25 },
]

function pieceStyle(piece) {
    const px = mouseX.value * piece.dx
    const py = mouseY.value * piece.dy
    return {
        ...piece.pos,
        width: piece.size,
        transform: `translate(${px}px, ${py}px) rotate(${piece.rotation}deg)`,
        transition: 'transform 0.18s ease-out',
        willChange: 'transform',
    }
}

// Girl wrapper — only parallax here; float animation is on the <img> via CSS
const girlWrapperStyle = computed(() => ({
    transform: `translate(${mouseX.value * 22}px, ${mouseY.value * 16}px)`,
    transition: 'transform 0.18s ease-out',
    willChange: 'transform',
}))

// ── Stats counter ─────────────────────────────────────────
const stats = [
    { target: 50,  prefix: '+', suffix: '', label: 'crianças e adolescentes atendidos' },
    { target: 100, prefix: '+', suffix: '', label: 'famílias apoiadas' },
    { target: 5,   prefix: '',  suffix: '', label: 'anos de atuação' },
    { target: 30,  prefix: '+', suffix: '', label: 'voluntários' },
]

const counts   = ref(stats.map(() => 0))
const statsRef = ref(null)
let observer   = null

function animateCounters() {
    const duration = 2000
    const steps    = 60
    stats.forEach((stat, i) => {
        const stepTime  = duration / steps
        const stepValue = stat.target / steps
        let current     = 0
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
        ([entry]) => { if (entry.isIntersecting) { animateCounters(); observer.disconnect() } },
        { threshold: 0.4 }
    )
    if (statsRef.value) observer.observe(statsRef.value)
})

onUnmounted(() => observer?.disconnect())
</script>

<style scoped>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50%       { transform: translateY(-20px); }
}

.girl-float {
    animation: float 4s ease-in-out infinite;
}
</style>
