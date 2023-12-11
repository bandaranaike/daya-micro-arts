<script setup>
import {Head} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import {capitalize} from "@vue/shared";
import CartIcon from "@/Components/CartIcon.vue";

defineProps({
    art: Object
})
</script>

<template>
    <Head>
        <title>{{art.title}} - Daya micro art</title>
    </Head>
    <site-layout>

        <div class="mt-4">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2 mt-4"><img :src="'/storage/projects/' + art.image" alt=""></div>
                <div class="p-8">
                    <h1 class="text-4xl text-gray-700 font-light leading-8"> {{ art.title }}</h1>
                    <div class="text-2xl text-orange-600 mt-2"> {{ art.category?.name }}</div>
                    <div class="font-bold text-xl mt-6 text-gray-600">About the art</div>
                    <p class="mt-1 text-gray-700">{{ art.description }}</p>
                    <div class="text-gray-500 text-sm bg-gray-100 border border-gray-200 font-bold mt-2 rounded px-2 py-1 inline-block">
                        Duration : {{ art.duration }}
                    </div>
                    <div class="text-2xl text-gray-700 mt-8 font-bold tracking-tight">
                        {{ art.price.toFixed(2) }} {{ art.currency.toUpperCase() }}
                    </div>
                    <div class="rounded-lg bg-orange-700 text-white  px-4 py-3 mt-2 inline-block">
                        <cart-icon></cart-icon>
                        Add to cart
                    </div>
                </div>
            </div>
        </div>
    </site-layout>
</template>

<style scoped>

</style>
