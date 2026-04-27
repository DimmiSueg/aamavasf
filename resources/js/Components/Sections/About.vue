<template>
    <section id="sobre" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="text-[#1B2A6B] font-bold text-sm uppercase tracking-widest">Quem Somos</span>
                    <h2 class="section-title mt-2">Uma família unida pela mesma causa</h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        A <strong>AAMAVASF</strong> — Associação de Amigos do Autista do Vale do São Francisco —
                        nasceu do amor e da determinação de pais, mães e familiares que não estão dispostos
                        a enfrentar essa jornada sozinhos.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        Sem vínculos políticos ou religiosos, somos uma associação plural que acolhe e
                        representa todas as famílias que convivem com o autismo na nossa região.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        Nossa missão é garantir que cada criança e adolescente autista do Vale do São
                        Francisco tenha acesso a informação, suporte, inclusão e os direitos que merecem.
                    </p>

                    <div class="grid grid-cols-2 gap-4">
                        <div v-for="item in pillars" :key="item.label"
                             class="flex items-center gap-3 p-3 rounded-xl bg-gray-50">
                            <span class="text-2xl">{{ item.icon }}</span>
                            <span class="font-semibold text-gray-700 text-sm">{{ item.label }}</span>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-[4/3]">
                        <img src="/images/familia.jpg" alt="Famílias AAMAVASF"
                             class="w-full h-full object-cover"
                             onerror="this.style.display='none'; this.parentElement.classList.add('bg-[#1B2A6B]/10', 'flex', 'items-center', 'justify-center'); this.insertAdjacentHTML('afterend', '<div class=\'text-center p-8\'><div class=\'text-6xl mb-4\'>🤝</div><p class=\'text-[#1B2A6B] font-bold\'>AAMAVASF</p></div>')" />
                    </div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 rounded-2xl bg-[#1B2A6B]/10 -z-10" />
                    <div class="absolute -top-6 -right-6 w-48 h-48 rounded-full bg-yellow-400/20 -z-10" />
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const pillars = [
    { icon: '🤝', label: 'Apoio às famílias' },
    { icon: '📚', label: 'Informação e orientação' },
    { icon: '🏥', label: 'Acesso a tratamentos' },
    { icon: '🎓', label: 'Inclusão escolar' },
]
</script>
