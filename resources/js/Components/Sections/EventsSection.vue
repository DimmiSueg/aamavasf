<script setup>
defineProps({ events: Array })

function formatDate(dateStr) {
    const d = new Date(dateStr)
    return {
        day: d.toLocaleDateString('pt-BR', { day: '2-digit' }),
        month: d.toLocaleDateString('pt-BR', { month: 'short' }).replace('.', ''),
        time: d.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' }),
    }
}
</script>

<template>
    <section id="eventos" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-14">
                <span class="text-[#1B2A6B] font-bold text-sm uppercase tracking-widest">Agenda</span>
                <h2 class="section-title mt-2">Próximos Eventos</h2>
                <p class="section-subtitle mx-auto mt-3">Participe dos nossos encontros, palestras e atividades.</p>
            </div>

            <div v-if="events?.length" class="grid md:grid-cols-2 gap-6 max-w-5xl mx-auto">
                <div v-for="event in events" :key="event.id" class="card flex gap-5 p-6">
                    <div class="flex-shrink-0 w-16 text-center">
                        <div class="bg-[#1B2A6B] rounded-t-xl py-1">
                            <span class="text-white text-xs font-bold uppercase">{{ formatDate(event.date).month }}</span>
                        </div>
                        <div class="bg-gray-50 rounded-b-xl py-2 border border-t-0 border-gray-100">
                            <span class="text-2xl font-extrabold text-gray-800">{{ formatDate(event.date).day }}</span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-extrabold text-gray-800 text-lg leading-tight mb-1">{{ event.title }}</h3>
                        <p class="text-gray-500 text-sm mb-2 line-clamp-2">{{ event.description }}</p>
                        <div class="flex items-center gap-4 text-xs text-gray-400">
                            <span>{{ formatDate(event.date).time }}</span>
                            <span>{{ event.location }}</span>
                            <span v-if="event.is_free" class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-bold">Gratuito</span>
                        </div>
                        <a v-if="event.registration_link" :href="event.registration_link" target="_blank"
                           class="inline-block mt-3 text-[#1B2A6B] font-bold text-sm hover:underline">
                            Inscrever-se →
                        </a>
                    </div>
                </div>
            </div>

            <div v-else class="text-center text-gray-400 py-12">
                <div class="text-5xl mb-4">📅</div>
                <p class="text-lg">Nenhum evento agendado no momento.</p>
            </div>
        </div>
    </section>
</template>
