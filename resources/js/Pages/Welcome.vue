<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';

let currency = "$"
let projects = [
    {
        name: "Train pencil carving",
        image: '/storage/projects/1.jpg',
        duration: 48,
        date: '2022-03-15',
        price: 750
    }, {
        name: "Train pencil carving",
        image: '/storage/projects/2.jpg',
        duration: 48,
        date: '2022-03-15',
        price: 750
    }, {
        name: "Train pencil carving",
        image: '/storage/projects/3.jpg',
        duration: 48,
        date: '2022-03-15',
        price: 750
    }, {
        name: "Train pencil carving",
        image: '/storage/projects/4.jpg',
        duration: 48,
        date: '2022-03-15',
        price: 750
    }, {
        name: "Train pencil carving",
        image: '/storage/projects/5.jpg',
        duration: 48,
        date: '2022-03-15',
        price: 750
    }, {
        name: "Train pencil carving",
        image: '/storage/projects/6.jpg',
        duration: 48,
        date: '2022-03-15',
        price: 750
    }, {
        name: "Train pencil carving",
        image: '/storage/projects/7.jpg',
        duration: 48,
        date: '2022-03-15',
        price: 750
    }, {
        name: "Train pencil carving",
        image: '/storage/projects/8.jpg',
        duration: 48,
        date: '2022-03-15',
        price: 750
    },
]
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Daya Micro Art"/>


    <div class="relative flex items-top justify-center min-h-screen max-w-6xl mx-auto sm:items-center sm:pt-0">
        <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-8 flex-wrap mx-auto md:p-6 sm:p-4">
            <div class="rounded shadow" v-for="project in projects">
                <img :src="project.image" class="rounded object-cover max-h-64 w-full" :alt="project.name">
                <div class="p-4 pb-2">
                    <div class="text-gray-700 text-2xl mb-2 font-bold">{{ project.name }}</div>
                    <div class="flex mb-2">
                        <div class="rounded-full w-3 h-3 bg-green-700 mt-2 mr-2" title="In stock"></div>
                        <div class="text-lg">{{ currency }}{{ project.price }}</div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-400">
                        <div class="font-bold">{{ project.duration }} {{ project.duration == 1 ? 'hour' : 'hours' }}</div>
                        <div class="">{{ project.date }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-2 border-t">
                    <button class="bg-orange-50 rounded-bl py-2 px-3">Buy now</button>
                    <button class="bg-gray-50 border-l py-2 px-3 rounded-br">Details</button>
                </div>
            </div>
        </div>
    </div>
</template>
