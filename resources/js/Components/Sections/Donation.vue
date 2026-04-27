<template>
    <section id="doacao" class="py-20 bg-[#1B2A6B]">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center max-w-5xl mx-auto">
                <div class="text-white">
                    <span class="text-yellow-400 font-bold text-sm uppercase tracking-widest">Apoie</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold mt-2 mb-6">
                        Sua doação faz a diferença na vida de uma criança
                    </h2>
                    <p class="text-white/80 text-lg leading-relaxed mb-6">
                        Com o seu apoio, promovemos eventos, distribuímos material informativo,
                        auxiliamos famílias em vulnerabilidade e lutamos por políticas públicas
                        para o autismo no Vale do São Francisco.
                    </p>
                    <p class="text-white/80 text-lg leading-relaxed mb-8">
                        Qualquer valor é bem-vindo. Use o QR code ao lado para fazer sua doação
                        via PIX de forma rápida e segura.
                    </p>

                    <div class="space-y-3">
                        <div v-for="item in benefits" :key="item" class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-yellow-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-white/90">{{ item }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <div class="bg-white rounded-3xl p-8 shadow-2xl text-center w-full max-w-sm">
                        <p class="text-gray-500 text-sm font-semibold uppercase tracking-widest mb-4">Doe via PIX</p>

                        <!-- Substitua /images/qrcode-pix.png pelo QR Code real -->
                        <div class="w-56 h-56 mx-auto rounded-2xl overflow-hidden mb-4 border border-gray-100 flex items-center justify-center bg-gray-50">
                            <img src="/images/qrcode-pix.png" alt="QR Code PIX AAMAVASF"
                                 class="w-full h-full object-contain"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'" />
                            <div class="hidden flex-col items-center text-gray-400 p-4">
                                <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                </svg>
                                <p class="text-xs text-center">Adicione o QR Code em<br><code>public/images/qrcode-pix.png</code></p>
                            </div>
                        </div>

                        <p class="text-gray-700 font-bold text-lg">Chave PIX</p>
                        <p class="text-gray-500 text-sm mt-1 font-mono select-all">contato@aamavasf.com.br</p>
                        <p class="text-gray-400 text-xs mt-3">Ou escaneie o QR Code acima no seu banco</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const benefits = [
    'Sem burocracia — PIX instantâneo',
    '100% dos recursos vão para a causa',
    'Associação sem fins lucrativos',
    'Recibo disponível mediante solicitação',
]
</script>
