<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
    post: Object,
})

const categoryLabel = (cat) => ({
    noticias: 'Notícias', eventos: 'Eventos', dicas: 'Dicas',
    conquistas: 'Conquistas', parceiros: 'Parceiros',
}[cat] ?? cat)
</script>

<template>
    <Head :title="post.title" />
    <AppLayout>
        <div class="min-h-screen bg-white pt-24">
            <article class="container mx-auto px-4 py-12 max-w-3xl">
                <Link href="/blog"
                      class="inline-flex items-center gap-2 text-[#1B2A6B] font-semibold text-sm hover:underline mb-8">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Voltar ao Blog
                </Link>

                <span v-if="post.category"
                      class="text-[#1B2A6B] text-xs font-bold uppercase tracking-widest">
                    {{ categoryLabel(post.category) }}
                </span>

                <h1 class="text-4xl font-extrabold text-gray-900 mt-3 mb-4 leading-tight">
                    {{ post.title }}
                </h1>

                <p v-if="post.published_at" class="text-gray-400 text-sm mb-8">
                    {{ new Date(post.published_at).toLocaleDateString('pt-BR', { day: '2-digit', month: 'long', year: 'numeric' }) }}
                </p>

                <div v-if="post.featured_image"
                     class="relative w-full h-72 md:h-96 rounded-2xl overflow-hidden mb-10">
                    <img :src="`/storage/${post.featured_image}`" :alt="post.title"
                         class="w-full h-full object-cover" />
                </div>

                <div class="prose prose-lg max-w-none prose-headings:text-[#1B2A6B] prose-a:text-[#1B2A6B]"
                     v-html="post.content" />

                <div class="mt-16 pt-8 border-t border-gray-100 text-center">
                    <p class="text-gray-500 mb-4">Gostou? Compartilhe com quem precisa saber.</p>
                    <Link href="/blog" class="btn-primary">Ver mais publicações</Link>
                </div>
            </article>
        </div>
    </AppLayout>
</template>
