<template>
    <authenticated-layout>
        <Head title="Create new art"></Head>
        <div class="w-full">
            <form class="w-full mx-auto max-w-3xl">
                <h1 class="text-xl py-6">Create new art ss</h1>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                               for="grid-first-name">
                            Title
                        </label>
                        <input
                            v-model="form.title"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="grid-first-name" type="text" placeholder="Add a proper title">
                        <p v-if="errors.title" class="text-red-500 text-xs italic">Please fill out the title field.</p>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                               for="grid-state">
                            Category
                        </label>
                        <div class="relative">
                            <select
                                v-model="form.category"
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-state">
                                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                               for="grid-password">
                            Description
                        </label>
                        <textarea
                            v-model="form.description"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                        <p class="text-gray-600 text-xs italic">What is the art and how did you do it</p>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="full-width px-3 mb-6 md:mb-0">
                        <label class="block mb-2 text-xs font-bold text-gray-700 mb-3 leading-tight" for="user_avatar">Upload
                            file</label>
                        <input
                            ref="artFile"
                            @change="setFileToForm"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded px-4 mb-3 leading-tight cursor-pointer bg-gray-50 focus:outline-none"
                            aria-describedby="user_avatar_help" id="user_avatar" type="file">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">

                    <div class="full-width md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block mb-2 text-xs font-bold text-gray-700 mb-3 leading-tight" for="user_avatar">Duration</label>
                        <input
                            v-model="form.duration"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" type="text" placeholder="36 hours">
                        <p v-if="errors.duration" class="text-red-500 text-xs italic">Please fill out the duration
                            field.</p>
                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                               for="grid-city">
                            Date
                        </label>
                        <vue-date-picker
                            format="yyyy-MM-dd"
                            input-class-name="border-red-500"
                            :enable-time-picker="false"
                            preview-format="Y-MM-dd"
                            v-model="form.date"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded leading-tight focus:outline-none
                         focus:bg-white focus:border-gray-500"
                            placeholder="Date"/>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">

                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                               for="grid-last-name">
                            Price
                        </label>
                        <input
                            v-model="form.price"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" type="text" placeholder="57.30">
                        <p v-if="errors.price" class="text-red-500 text-xs italic">Please fill out the price field.</p>

                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                               for="grid-state">
                            Currency
                        </label>
                        <div class="relative">
                            <select
                                v-model="form.currency"
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-state">
                                <option v-for="currency in currencies">{{ currency }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full px-3 my-6 md:mb-0">
                        <button
                            v-if="!isArtSaving"
                            type="button"
                            @click="saveArt"
                            class="appearance-none block w-full bg-blue-600 text-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight"
                        >Save
                        </button>
                        <div v-else
                             class="w-full bg-blue-600 text-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight text-center"
                        >
                            <loader class="mr-3"></loader>
                            Saving art...
                        </div>
                    </div>
                </div>
                <div v-if="showSuccess"
                     class="p-4 mb-4 mt-4 text-green-800 border border-green-600 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                     role="alert">
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"></path>
                        </svg>
                        <span class="sr-only">Info</span>
                        <h3 class="text-lg font-medium">Art created successfully!</h3>
                    </div>
                    <div class="mt-2 mb-4 text-sm">
                        The art titled '{{ createdArt.title }}' has been created and synced with Stripe. It is now ready
                        for online selling.
                    </div>
                    <div class="flex">
                        <a :href="`/art/${createdArt.uuid}`"
                           class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <svg class="me-2 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="currentColor" viewBox="0 0 20 14">
                                <path
                                    d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"></path>
                            </svg>
                            View art
                        </a>
                        <button @click="showSuccess = false" type="button"
                                class="text-green-800 bg-transparent border border-green-800 hover:bg-green-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded text-xs px-3 py-1.5 text-center dark:hover:bg-green-600 dark:border-green-600 dark:text-green-400 dark:hover:text-white dark:focus:ring-green-800"
                                data-dismiss-target="#alert-additional-content-3" aria-label="Close">
                            Dismiss
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </authenticated-layout>
</template>

<script setup>
import {onMounted, reactive, ref} from "vue";
import axios from "axios";

import VueDatePicker from '@vuepic/vue-datepicker'

import '@vuepic/vue-datepicker/dist/main.css'
import Loader from "@/Components/Loader.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from '@inertiajs/vue3';

let errors = ref({
    title: null,
    price: null,
});

const props = defineProps({
    initArtFile: Object
})

const currencies = ['eur', 'lkr', 'usd']

let artFile = ref(null)
let categories = ref([])
let createdArt = ref({})
let currency = ref('lkr')
let isArtSaving = ref(false)
let isEditing = ref(false)
let showSuccess = ref(false)

let form = reactive({
    title: null,
    category: 2,
    description: null,
    duration: null,
    date: new Date(),
    price: null,
    currency,
})

onMounted(() => {
    if (props.initArtFile) {
        isEditing.value = true;
        artFile.value = props.initArtFile;
    }
})

function setFileToForm(item) {
    artFile.value = item.target?.files[0];
}

function saveArt() {
    isArtSaving.value = true;
    const formData = new FormData();
    Object.keys(form).forEach(key => formData.append(key, form[key]));

    if (artFile.value) {
        formData.append('image', artFile.value);
    }

    const savingUrl = isEditing ? '/art/update' : '/art/create'

    axios.post(savingUrl, formData, {
        headers: {
            'Content-type': 'multipart/form-data'
        }
    }).then(response => {
        form = {}
        artFile.value = null
        createdArt.value = response.data
        showSuccess.value = true
    }).finally(() => {
        isArtSaving.value = false
    })
}

function getCategories() {
    axios.get('/categories').then(response => {
        categories.value = response.data;
    })
}

onMounted(() => {
    getCategories();
})

</script>

<script>
export default {
    name: "CreateArt"
}
</script>

<style>
input[type="file"]::file-selector-button {
    -webkit-margin-start: -1rem;
    -webkit-margin-end: 1rem;
    background: #1f2937;
    border: 1px solid #1f2937;
    color: #fff;
    cursor: pointer;
    font-size: .875rem;
    font-weight: 500;
    margin-inline-end: 1rem;
    margin-inline-start: -1rem;
    padding: .625rem 1rem .625rem 2rem;
}
</style>
