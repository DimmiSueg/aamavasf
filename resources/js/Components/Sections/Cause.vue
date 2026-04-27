<template>
    <section id="causa" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-14">
                <span class="text-[#1B2A6B] font-bold text-sm uppercase tracking-widest">Nossa Causa</span>
                <h2 class="section-title mt-2">Por que o autismo precisa de atenção?</h2>
                <p class="section-subtitle mx-auto mt-3">
                    O espectro autista afeta cerca de 1% da população mundial. No Brasil, são mais de
                    2 milhões de pessoas — e cada uma delas merece suporte, cuidado e inclusão.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                <div v-for="item in items" :key="item.title" class="card p-6">
                    <div :class="['w-3 h-3 rounded-full mb-4', item.color]" />
                    <h3 class="font-extrabold text-gray-800 text-lg mb-3">{{ item.title }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ item.text }}</p>
                </div>
            </div>

            <div class="bg-[#1B2A6B] rounded-3xl p-8 md:p-12 text-center text-white max-w-4xl mx-auto">
                <div class="text-6xl font-thin mb-4 leading-none">∞</div>
                <h3 class="text-2xl md:text-3xl font-extrabold mb-4">
                    O símbolo do infinito representa as possibilidades ilimitadas de cada pessoa autista
                </h3>
                <p class="text-white/80 text-lg max-w-2xl mx-auto">
                    Não existe um jeito único de ser autista. O espectro é diverso, único e cheio de
                    potencial. Nossa missão é garantir que cada pessoa encontre seu caminho.
                </p>
            </div>
        </div>
    </section>
</template>

<script setup>
const items = [
    {
        color: 'bg-red-500',
        title: 'Diagnóstico precoce',
        text: 'O diagnóstico antes dos 3 anos multiplica os resultados do tratamento. Lutamos pelo acesso de todas as famílias a essa possibilidade.',
    },
    {
        color: 'bg-blue-500',
        title: 'Terapias especializadas',
        text: 'ABA, fonoaudiologia, terapia ocupacional — direitos garantidos em lei que ainda são negados a muitas famílias.',
    },
    {
        color: 'bg-yellow-500',
        title: 'Inclusão escolar',
        text: 'Toda criança autista tem direito à educação inclusiva com professores preparados e suporte adequado.',
    },
    {
        color: 'bg-green-500',
        title: 'Rede de apoio',
        text: 'Nenhuma família deve enfrentar essa jornada sozinha. Conectamos famílias, profissionais e recursos.',
    },
]
</script>
