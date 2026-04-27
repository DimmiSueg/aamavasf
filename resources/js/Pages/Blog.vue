<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
    posts: Object, // paginated
})

const categoryLabel = (cat) => ({
    noticias: 'Notícias', eventos: 'Eventos', dicas: 'Dicas',
    conquistas: 'Conquistas', parceiros: 'Parceiros',
}[cat] ?? cat)
</script>

<template>
    <Head title="Blog" />
    <AppLayout>
        <div class="min-h-screen bg-gray-50 pt-24">
            <div class="container mx-auto px-4 py-12">
                <div class="text-center mb-12">
                    <span class="text-[#1B2A6B] font-bold text-sm uppercase tracking-widest">Blog</span>
                    <h1 class="section-title mt-2">Notícias e Informações</h1>
                    <p class="section-subtitle mx-auto mt-3">
                        Informações, conquistas e histórias que inspiram.
                    </p>
                </div>

                <div v-if="posts.data.length" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <Link v-for="post in posts.data" :key="post.id"
                          :href="route('blog.post', post.slug)"
                          class="card group">
                        <div v-if="post.featured_image" class="relative h-48 overflow-hidden">
                            <img :src="`/storage/${post.featured_image}`" :alt="post.title"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        </div>
                        <div class="p-6">
                            <span v-if="post.category"
                                  class="text-[#1B2A6B] text-xs font-bold uppercase tracking-widest">
                                {{ categoryLabel(post.category) }}
                            </span>
                            <h2 class="font-extrabold text-gray-800 text-lg mt-2 mb-3 line-clamp-2 group-hover:text-[#1B2A6B] transition-colors">
                                {{ post.title }}
                            </h2>
                            <p class="text-gray-500 text-sm line-clamp-3">{{ post.excerpt }}</p>
                            <p v-if="post.published_at" class="text-gray-400 text-xs mt-4">
                                {{ new Date(post.published_at).toLocaleDateString('pt-BR', { day: '2-digit', month: 'long', year: 'numeric' }) }}
                            </p>
                        </div>
                    </Link>
                </div>

                <div v-else class="text-center text-gray-400 py-20">
                    <div class="text-5xl mb-4">📝</div>
                    <p class="text-lg">Nenhuma publicação ainda.</p>
                </div>

                <!-- Paginação -->
                <div v-if="posts.last_page > 1" class="flex justify-center gap-2 mt-12">
                    <Link v-for="page in posts.last_page" :key="page"
                          :href="`/blog?page=${page}`"
                          :class="['px-4 py-2 rounded-full font-semibold text-sm transition-colors',
                                   page === posts.current_page
                                     ? 'bg-[#1B2A6B] text-white'
                                     : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200']">
                        {{ page }}
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
