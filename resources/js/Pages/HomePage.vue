<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import JetAuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';

defineProps({
    terms: String,
});
</script>

<template>
    <Head title="Daya micro art"/>

    <div class="font-sans text-gray-700 antialiased">
        <div class="min-h-screen flex flex-col">
            <div class="bg-black items-center">
                <div class="background-image w-full py-64"></div>
            </div>
            <div class="max-w-6xl w-full mx-auto items-center text-center py-16">
                <h3 class="text-2xl mb-5">The selected of</h3>
                <h2 class="text-7xl font-bold mb-12">PORTFOLIO</h2>
                <div class="">
                    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">

                    <div class="gallery">
                        <div class="gallery__column">
                            <a href="https://unsplash.com/@jeka_fe" target="_blank" class="gallery__link">
                                <figure class="gallery__thumb">
                                    <img src="https://source.unsplash.com/_cvwXhGqG-o/300x300" alt="Portrait by Jessica Felicio" class="gallery__image">
                                    <figcaption class="gallery__caption">Portrait by Jessica Felicio</figcaption>
                                </figure>
                            </a>

                            <a href="https://unsplash.com/@oladimeg" target="_blank" class="gallery__link">
                                <figure class="gallery__thumb">
                                    <img src="https://source.unsplash.com/AHBvAIVqk64/300x500" alt="Portrait by Oladimeji Odunsi" class="gallery__image">
                                    <figcaption class="gallery__caption">Portrait by Oladimeji Odunsi</figcaption>
                                </figure>
                            </a>

                            <a href="https://unsplash.com/@a2eorigins" target="_blank" class="gallery__link">
                                <figure class="gallery__thumb">
                                    <img src="https://source.unsplash.com/VLPLo-GtrIE/300x300" alt="Portrait by Alex Perez" class="gallery__image">
                                    <figcaption class="gallery__caption">Portrait by Alex Perez</figcaption>
                                </figure>
                            </a>
                        </div>

                        <div class="gallery__column">
                            <a href="https://unsplash.com/@noahbuscher" target="_blank" class="gallery__link">
                                <figure class="gallery__thumb">
                                    <img src="https://source.unsplash.com/AR7aumwKr2s/300x300" alt="Portrait by Noah Buscher" class="gallery__image">
                                    <figcaption class="gallery__caption">Portrait by Noah Buscher</figcaption>
                                </figure>
                            </a>

                            <a href="https://unsplash.com/@von_co" target="_blank" class="gallery__link">
                                <figure class="gallery__thumb">
                                    <img src="https://source.unsplash.com/dnL6ZIpht2s/300x300" alt="Portrait by Ivana Cajina" class="gallery__image">
                                    <figcaption class="gallery__caption">Portrait by Ivana Cajina</figcaption>
                                </figure>
                            </a>

                            <a href="https://unsplash.com/@samburriss" target="_blank" class="gallery__link">
                                <figure class="gallery__thumb">
                                    <img src="https://source.unsplash.com/tV_1sC603zA/300x500" alt="Portrait by Sam Burriss" class="gallery__image">
                                    <figcaption class="gallery__caption">Portrait by Sam Burriss</figcaption>
                                </figure>
                            </a>
                        </div>

                        <div class="gallery__column">
                            <a href="https://unsplash.com/@marilezhava" target="_blank" class="gallery__link">
                                <figure class="gallery__thumb">
                                    <img src="https://source.unsplash.com/Xm9-vA_bhm0/300x500" alt="Portrait by Mari Lezhava" class="gallery__image">
                                    <figcaption class="gallery__caption">Portrait by Mari Lezhava</figcaption>
                                </figure>
                            </a>

                            <a href="https://unsplash.com/@ethanhaddox" target="_blank" class="gallery__link">
                                <figure class="gallery__thumb">
                                    <img src="https://source.unsplash.com/NTjSR3zYpsY/300x300" alt="Portrait by Ethan Haddox" class="gallery__image">
                                    <figcaption class="gallery__caption">Portrait by Ethan Haddox</figcaption>
                                </figure>
                            </a>

                            <a href="https://unsplash.com/@mr_geshani" target="_blank" class="gallery__link">
                                <figure class="gallery__thumb">
                                    <img src="https://source.unsplash.com/2JH8d3ChNec/300x300" alt="Portrait by Amir Geshani" class="gallery__image">
                                    <figcaption class="gallery__caption">Portrait by Amir Geshani</figcaption>
                                </figure>
                            </a>
                        </div>

                        <div class="gallery__column">
                            <a href="https://unsplash.com/@frxgui" target="_blank" class="gallery__link">
                                <figure class="gallery__thumb">
                                    <img src="https://source.unsplash.com/FQhLLehm4dk/300x300" alt="Portrait by Guilian Fremaux" class="gallery__image">
                                    <figcaption class="gallery__caption">Portrait by Guilian Fremaux</figcaption>
                                </figure>
                            </a>

                            <a href="https://unsplash.com/@majestical_jasmin" target="_blank" class="gallery__link">
                                <figure class="gallery__thumb">
                                    <img src="https://source.unsplash.com/OQd9zONSx7s/300x300" alt="Portrait by Jasmin Chew" class="gallery__image">
                                    <figcaption class="gallery__caption">Portrait by Jasmin Chew</figcaption>
                                </figure>
                            </a>

                            <a href="https://unsplash.com/@dimadallacqua" target="_blank" class="gallery__link">
                                <figure class="gallery__thumb">
                                    <img src="https://source.unsplash.com/XZkEhowjx8k/300x500" alt="Portrait by Dima DallAcqua" class="gallery__image">
                                    <figcaption class="gallery__caption">Portrait by Dima DallAcqua</figcaption>
                                </figure>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-800">
                <div class="max-w-4xl text-center w-full mx-auto">
                    <div class="py-36">
                        <h3 class="text-2xl text-orange-300 mb-5 tracking-widest">Something</h3>
                        <h2 class="text-7xl text-gray-50 font-bold mb-12">ABOUT ME</h2>
                        <p class="text-2xl text-gray-400">
                            The world’s most talented pencil micro carving artist which takes the <b><i>“live pencil carving art”</i></b> to next level. Massive Dynamic is created
                            by a team of 12 experienced
                            professional developers and designers. The team has focused on user experience and ease of use in every aspect of the project.
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-200">
                <div class="border max-w-7xl items-center w-full mx-auto" style="height: 580px">

                </div>
            </div>
            <div class="bg-brown-200">
                <div class="border max-w-7xl w-full mx-auto" style="height: 250px"></div>
            </div>
        </div>
    </div>
</template>
<style>
.gallery {
    display: flex;
    padding: 2px;
    transition: 0.3s;
}

.gallery:hover .gallery__image {
    filter: grayscale(1);
}

.gallery__column {
    display: flex;
    flex-direction: column;
    width: 25%;
}

.gallery__link {
    margin: 2px;
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
    background: url("/storage/backgrounds/dayananda.png") top no-repeat;
    background-size: contain;
}

</style>
