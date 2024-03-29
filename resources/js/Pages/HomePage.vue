<script setup>
import {Head} from '@inertiajs/vue3';
import {onMounted, ref, watch} from "vue";
import axios from "axios";
import CartSvg from "../Icons/CartSvg.vue";
import StarSvg from "../Icons/StarSvg.vue";
import helpers from "../helpers";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
    terms: String,
});


let categories = ref([]);
let gallery = ref([]);
let selectedCategories = ref([0]);

function getCategories() {
    axios.get('/categories').then((r) => {
        categories.value = r.data;
    })
}

function getGalleries() {
    axios.get('/galleries', {params: {categories: selectedCategories.value}}).then((r) => {
        gallery.value = r.data;
    })
}

function toggleCategory(categoryId) {
    let allCategoryId = 0;

    if (categoryId === allCategoryId) {
        selectedCategories.value = [allCategoryId]
    } else {
        helpers.arrayRemoveItem(selectedCategories.value, allCategoryId)
        if (selectedCategories.value.includes(categoryId)) {
            helpers.arrayRemoveItem(selectedCategories.value, categoryId)
        } else {
            selectedCategories.value.push(categoryId)
        }
    }
}


onMounted(() => {
    getCategories();
    getGalleries();
});

watch(() => [...selectedCategories.value], () => {
    console.log("CAme")
    getGalleries();
})

</script>

<template>
    <Head>
        <title>Welcome </title>
    </Head>

    <AppLayout :full-width="true">
        <div class="bg-black items-center">
            <div class="background-image w-full py-72"></div>
        </div>
        <div class="w-full mx-auto items-center text-center py-16 px-10 bg-white">
            <h3 class="text-2xl mb-5">The selected of</h3>
            <h2 class="md:text-7xl text-5xl font-bold mb-12">PORTFOLIO</h2>
            <div class="mx-48">
                <div class="mb-2 mt-6 font-bold"> Pencil Carving:</div>
                <p class="text-gray-500">
                    Pencil carving is a delicate art form that allows me to transform ordinary graphite pencils
                    into
                    stunning sculptures. With meticulous attention to detail
                    and a
                    steady hand, I carve intricate patterns, designs, and even miniature figures directly onto
                    the
                    graphite. Each piece reflects hours of dedication and a deep
                    appreciation for the fusion of art and craftsmanship.
                </p>
                <div class="mb-2 mt-6 font-bold"> Micro Arts in Rice Grains:</div>

                <p class="text-gray-500">
                    One of my unique specialties is creating micro artworks on rice grains. This challenging
                    medium
                    demands exceptional precision and patience. By using the
                    natural
                    texture and size of rice grains as my canvas, I craft breathtaking scenes, symbols, and
                    portraits that capture the essence of life in a miniature form. Each
                    grain becomes a testament to the beauty that can be found in the smallest of spaces.
                </p>
            </div>

            <div
                class="flex mt-20 mb-5 border-l flex-grow flex-wrap text-sm rounded-l [&>*:last-child]:rounded-r">
                <div class="px-3 py-1 border-r border-b border-t -mb-1px cursor-pointer"
                     :class="{'bg-gray-200': selectedCategories.includes(0)}"
                     @click="toggleCategory(0)">All
                </div>
                <div class="px-3 py-1 border-r border-b border-t -mb-1px cursor-pointer"
                     :class="{'bg-gray-200 border-x-gray-300': selectedCategories.includes(category.id)}"
                     @click="toggleCategory(category.id)" v-for="category in categories">{{
                        category.name
                    }}
                </div>
            </div>


            <div class="pb-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8"
                     v-if="gallery.length">
                    <template v-for="art in gallery">
                        <div class="shadow rounded text-left">
                            <a :href="`/art/${art.uuid}`">
                                <img :src="`/storage/projects/${art.image}`" :alt="art.title"
                                     class="object-cover bg-top h-64 w-full rounded-t">
                                <div class="p-6">
                                    <div class="pt-4 pb-3 text-2xl text-gray-700 font-bold">{{ art.title }}</div>
                                    <div class="pb-3 text-xl font-bold text-orange-700">
                                        {{ art.price.toFixed(2) }}
                                        {{ art.currency.toUpperCase() }}
                                    </div>
                                    <div class="pb-5 text-gray-500 text-sm">{{ art.description }}</div>
                                    <div class="inline-flex space-x-4">
                                        <div class="flex text-green-700 border border-green-200 rounded bg-green-50 py-1 px-2 text-xs">
                                            {{ art.duration }} hours
                                        </div>
                                        <div class="flex text-gay-600 rounded bg-gray-100 py-1 px-2 text-xs">
                                             <span class="text-yellow-500">
                                                 <star-svg></star-svg>
                                             </span> 4.6<span class="text-gray-400">(23)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </template>
                </div>
                <div class="text-center w-full p-6 text-xl text-gray-400" v-else>
                    No pieces of art found
                </div>
            </div>
        </div>
        <div class="bg-gray-800">
            <div class="max-w-4xl text-center w-full mx-auto">
                <div class="py-36">
                    <h3 class="text-2xl text-orange-300 mb-5 tracking-widest">Something</h3>
                    <h2 class="md:text-7xl text-5xl text-gray-50 font-bold mb-12">ABOUT ME</h2>
                    <p class="text-2xl text-gray-400">
                        Hello, I'm Dayananda, a passionate artist based in Sri Lanka. I've developed a deep love
                        for
                        the intricate world of pencil carving and micro arts using
                        rice
                        grains. Through my creations, I aim to bring together the precision of technology and
                        the
                        elegance of art.
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-gray-50">
            <div class="max-w-7xl items-center w-full mx-auto py-24 text-center">
                <h3 class="text-2xl text-gray-600 mb-5 tracking-widest">Some of my</h3>
                <h2 class="md:text-7xl text-4xl text-gray-700 font-bold mb-12">COLLABORATIVES</h2>
                <p class="text-xl px-20 text-gray-600">In the world of art, creativity knows no bounds. Pencil
                    carving and rice grain art are two fascinating forms of artistic expression that captivate
                    the
                    imagination through intricate detailing and meticulous craftsmanship. This website aims to
                    bring
                    together enthusiasts, artists, and admirers of these unique
                    art forms in a collaborative section that fosters sharing, learning, and mutual
                    appreciation.</p>
            </div>
        </div>
        <div class="bg-gray-800">
            <div class="max-w-xl w-full mx-auto flex py-32 px-10">
                <div class="mx-auto">
                    <img src="/images/logo.png" class="w-auto max-w-full" alt="Daya micro art">
                    <div class="text-center pt-8 text-gray-300">&copy; Daya micro art - 2022</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style>
.background-image {
    background: url("/storage/backgrounds/dayananda.jpg") top no-repeat;
    background-position-y: center;
    background-size: cover;
}

.-mb-1px {
    margin-bottom: -1px;
}

</style>
