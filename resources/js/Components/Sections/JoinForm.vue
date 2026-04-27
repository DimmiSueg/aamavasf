<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '', email: '', phone: '', city: '', role: '', message: '',
})

function submit() {
    form.post(route('member.store'), { preserveScroll: true })
}
</script>

<template>
    <section id="faca-parte" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-3xl">
            <div class="text-center mb-12">
                <span class="text-[#1B2A6B] font-bold text-sm uppercase tracking-widest">Associe-se</span>
                <h2 class="section-title mt-2">Faça Parte da AAMAVASF</h2>
                <p class="section-subtitle mx-auto mt-3">
                    Familiar, voluntário, profissional ou parceiro — sua participação fortalece a nossa causa.
                </p>
            </div>

            <div v-if="$page.props.flash?.success" class="bg-green-50 border border-green-200 rounded-3xl p-12 text-center">
                <div class="text-5xl mb-4">🎉</div>
                <h3 class="text-2xl font-extrabold text-green-800 mb-3">Cadastro recebido!</h3>
                <p class="text-green-700 text-lg">{{ $page.props.flash.success }}</p>
            </div>

            <form v-else @submit.prevent="submit" class="bg-white rounded-3xl shadow-lg p-8 md:p-10 space-y-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nome completo *</label>
                        <input v-model="form.name" type="text" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#1B2A6B]/30 focus:border-[#1B2A6B] transition"
                               placeholder="Seu nome completo" />
                        <p v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">E-mail *</label>
                        <input v-model="form.email" type="email" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#1B2A6B]/30 focus:border-[#1B2A6B] transition"
                               placeholder="seu@email.com" />
                        <p v-if="form.errors.email" class="text-red-500 text-xs mt-1">{{ form.errors.email }}</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">WhatsApp *</label>
                        <input v-model="form.phone" type="tel" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#1B2A6B]/30 focus:border-[#1B2A6B] transition"
                               placeholder="(87) 99999-9999" />
                        <p v-if="form.errors.phone" class="text-red-500 text-xs mt-1">{{ form.errors.phone }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Cidade</label>
                        <input v-model="form.city" type="text"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#1B2A6B]/30 focus:border-[#1B2A6B] transition"
                               placeholder="Sua cidade" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Como quer contribuir? *</label>
                    <select v-model="form.role" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#1B2A6B]/30 focus:border-[#1B2A6B] transition bg-white">
                        <option value="">Selecione...</option>
                        <option value="family">Pai / Mãe / Familiar de pessoa autista</option>
                        <option value="volunteer">Voluntário(a)</option>
                        <option value="health_pro">Profissional da saúde</option>
                        <option value="educator">Educador(a)</option>
                        <option value="partner">Parceiro(a) / Empresa</option>
                        <option value="donor">Doador(a)</option>
                        <option value="other">Outro</option>
                    </select>
                    <p v-if="form.errors.role" class="text-red-500 text-xs mt-1">{{ form.errors.role }}</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Mensagem (opcional)</label>
                    <textarea v-model="form.message" rows="4"
                              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#1B2A6B]/30 focus:border-[#1B2A6B] transition resize-none"
                              placeholder="Conte como deseja ajudar..." />
                </div>

                <button type="submit" :disabled="form.processing"
                        class="btn-primary w-full text-lg py-4 disabled:opacity-60 disabled:cursor-not-allowed">
                    {{ form.processing ? 'Enviando...' : 'Quero Fazer Parte da AAMAVASF' }}
                </button>

                <p class="text-center text-xs text-gray-400">
                    Seus dados são tratados com segurança e não compartilhados com terceiros.
                </p>
            </form>
        </div>
    </section>
</template>
