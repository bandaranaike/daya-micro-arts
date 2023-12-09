<script setup>
import {Head} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";

defineProps({
    art: Object
})
</script>

<template>
    <Head>
        <title>{{art.title}} - Daya micro art</title>
    </Head>
    <site-layout>
        <h1 class="text-4xl mt-8"> {{ art.title }}</h1>
        <div class="mt-4">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2"><img :src="'/storage/projects/' + art.image" alt=""></div>
                <div class="">
                    <p class="mt-4">{{ art.description }}</p> {{ art }}

                    <div>Category : {{ art.category.name }}</div>
                    <div>Duration : {{ art.duration }}</div>
                    <div>Duration : {{ art.duration }}</div>
                    <div>Duration : {{ art.duration }}</div>
                </div>
            </div>

        </div>
    </site-layout>
</template>

<style scoped>

</style>
