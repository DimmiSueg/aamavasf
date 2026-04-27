<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({ posts: Array })
</script>

<template>
    <section id="blog" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-14">
                <span class="text-[#1B2A6B] font-bold text-sm uppercase tracking-widest">Blog</span>
                <h2 class="section-title mt-2">Notícias e Informações</h2>
                <p class="section-subtitle mx-auto mt-3">Fique por dentro das novidades e conquistas.</p>
            </div>

            <div v-if="posts?.length" class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <Link v-for="post in posts" :key="post.id" :href="`/blog/${post.slug}`" class="card group">
                    <div v-if="post.featured_image" class="relative h-48 overflow-hidden">
                        <img :src="`/storage/${post.featured_image}`" :alt="post.title"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                    </div>
                    <div class="p-6">
                        <span v-if="post.category" class="text-[#1B2A6B] text-xs font-bold uppercase tracking-widest">
                            {{ post.category }}
                        </span>
                        <h3 class="font-extrabold text-gray-800 text-lg mt-2 mb-3 line-clamp-2 group-hover:text-[#1B2A6B] transition-colors">
                            {{ post.title }}
                        </h3>
                        <p class="text-gray-500 text-sm line-clamp-3">{{ post.excerpt }}</p>
                    </div>
                </Link>
            </div>

            <div v-else class="text-center text-gray-400 py-12">
                <div class="text-5xl mb-4">📝</div>
                <p class="text-lg">Nenhuma publicação ainda.</p>
            </div>

            <div v-if="posts?.length" class="text-center mt-10">
                <Link href="/blog" class="btn-primary">Ver todas as publicações</Link>
            </div>
        </div>
    </section>
</template>
