<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import {onMounted, ref} from "vue";
import axios from "axios";

defineProps({
    terms: String,
});

let
    gallery = [
        [
            {
                name: "Train pencil carving",
                image: '/storage/projects/1.jpg',
                duration: 48,
                date: '2022-03-15',
                price: 750
            },
            {
                name: "Train pencil carving",
                image: '/storage/projects/2.jpg',
                duration: 48,
                date: '2022-03-15',
                price: 750
            },
            {
                name: "Train pencil carving",
                image: '/storage/projects/3.jpg',
                duration: 48,
                date: '2022-03-15',
                price: 750
            }
        ],
        [
            {
                name: "Train pencil carving",
                image: '/storage/projects/4.jpg',
                duration: 48,
                date: '2022-03-15',
                price: 750
            },
            {
                name: "Train pencil carving",
                image: '/storage/projects/5.jpg',
                duration: 48,
                date: '2022-03-15',
                price: 750
            },
            {
                name: "Train pencil carving",
                image: '/storage/projects/6.jpg',
                duration: 48,
                date: '2022-03-15',
                price: 750
            }
        ],
        [
            {
                name: "Train pencil carving",
                image: '/storage/projects/7.jpg',
                duration: 48,
                date: '2022-03-15',
                price: 750
            },
            {
                name: "Train pencil carving",
                image: '/storage/projects/5.jpg',
                duration: 48,
                date: '2022-03-15',
                price: 750
            },
            {
                name: "Train pencil carving",
                image: '/storage/projects/8.jpg',
                duration: 48,
                date: '2022-03-15',
                price: 750
            }
        ],
    ];

let categories = ref([]);

function getCategories() {
    axios.get('/categories').then((r) => {
        categories.value = r.data;
    })
}

onMounted(() => {
    getCategories();
});

</script>

<template>
    <Head title="Daya micro art"/>

    <div class="font-sans text-gray-700 antialiased">
        <div class="min-h-screen flex flex-col">
            <div class="absolute top-0 border-b w-full flex p-1 border-gray-900 shadow-xl bg-gray-900 opacity-95">
                <div class="max-w-6xl w-full mx-auto py-1">
                    <a href="/">
                        <img src="/images/logo.png" class="h-12" alt="Daya Micro Art">
                    </a>
                </div>
            </div>
            <div class="bg-black items-center">
                <div class="background-image w-full py-72"></div>
            </div>
            <div class="w-full mx-auto items-center text-center py-16 px-10">
                <h3 class="text-2xl mb-5">The selected of</h3>
                <h2 class="text-7xl font-bold mb-12">PORTFOLIO</h2>


                <div class="flex mx-4 mb-5 border-l flex-grow">
                    <div class="p-6 border-r border-b border-t text-xl">All</div>
                    <div class="p-6 border-r border-b border-t text-xl" v-for="category in categories">{{ category.name }}</div>
                </div>


                <div class="pb-8">
                    <div class="gallery mt-4 ml-4">
                        <template v-for="chunk in gallery">
                            <div class="gallery__column">
                                <a href="" target="_blank" class="gallery__link mb-4 mr-4" v-for="item in chunk">
                                    <figure class="gallery__thumb">
                                        <img :src="item.image" :alt="item.name" class="gallery__image">
                                        <figcaption class="gallery__caption">{{ item.name }}</figcaption>
                                    </figure>
                                </a>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <div class="bg-gray-800">
                <div class="max-w-4xl text-center w-full mx-auto">
                    <div class="py-36">
                        <h3 class="text-2xl text-orange-300 mb-5 tracking-widest">Something</h3>
                        <h2 class="text-7xl text-gray-50 font-bold mb-12">ABOUT ME</h2>
                        <p class="text-2xl text-gray-400">
                            One of the world’s most talented micro carving artist which takes the <br> <b><i>“live micro carving art”</i></b> to next level
                            who making micro arts in rice grains, pencils and many other miro level objects.
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50">
                <div class="max-w-7xl items-center w-full mx-auto py-24 text-center">
                    <h3 class="text-2xl text-gray-600 mb-5 tracking-widest">Some of my</h3>
                    <h2 class="text-7xl text-gray-700 font-bold mb-12">COLLABORATIVES</h2>
                </div>
            </div>
            <div class="bg-gray-800">
                <div class="max-w-7xl w-full mx-auto flex p-32">
                    <div class="mx-auto">
                        <img src="/images/logo.png" class="max-w-2xl" alt="Daya micro art">
                        <div class="text-center pt-8 text-gray-300">&copy; Daya micro art - 2022</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.gallery {
    display: flex;
    transition: 0.3s;
}

.gallery:hover .gallery__image {
    filter: grayscale(1);
}

.gallery__column {
    display: flex;
    flex-direction: column;
    width: 33.33%;
}

.gallery__link {
    overflow: hidden;
}

.gallery__link:hover .gallery__image {
    filter: grayscale(0);
}

.gallery__link:hover .gallery__caption {
    opacity: 1;
}

.gallery__thumb {
    position: relative;
}

.gallery__image {
    display: block;
    width: 100%;
    transition: 0.3s;
}

.gallery__image:hover {
    transform: scale(1.1);
}

.gallery__caption {
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 25px 15px 15px;
    width: 100%;
    font-family: "Raleway", sans-serif;
    font-size: 16px;
    color: white;
    opacity: 0;
    background: linear-gradient(0deg, rgba(0, 0, 0, 0.5) 0%, rgba(255, 255, 255, 0) 100%);
    transition: 0.3s;
}

.background-image {
    background: url("/storage/backgrounds/dayananda.jpg") top no-repeat;
    background-position-y: center;
    background-size: cover;
}

</style>
