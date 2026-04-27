<script setup>
import { Head } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import Hero from '@/Components/Sections/Hero.vue'
import About from '@/Components/Sections/About.vue'
import Cause from '@/Components/Sections/Cause.vue'
import EventsSection from '@/Components/Sections/EventsSection.vue'
import BlogSection from '@/Components/Sections/BlogSection.vue'
import JoinForm from '@/Components/Sections/JoinForm.vue'
import Donation from '@/Components/Sections/Donation.vue'

defineProps({
    events: Array,
    posts: Array,
})
</script>

<template>
    <Head title="Início" />
    <AppLayout>
        <Hero />
        <About />
        <Cause />
        <EventsSection :events="events" />
        <BlogSection :posts="posts" />
        <JoinForm />
        <Donation />
    </AppLayout>
</template>
