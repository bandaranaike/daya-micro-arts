<template>
    <div class="w-full">
        <form class="w-full mx-auto max-w-lg">
            <h1 class="text-xl py-6">Create new art</h1>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Title
                    </label>
                    <input
                        v-model="form.title"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="grid-first-name" type="text" placeholder="Add a proper title">
                    <p v-if="errors.title" class="text-red-500 text-xs italic">Please fill out the title field.</p>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                        Date
                    </label>
                    <vue-date-picker
                        :format="'Y-m-d'"
                        input-class-name="border-red-500"
                        :enable-time-picker="false"
                        preview-format="yyyy-MM-dd"
                        v-model="form.date"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded leading-tight focus:outline-none
                         focus:bg-white focus:border-gray-500"
                        placeholder="Date"/>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        Description
                    </label>
                    <textarea
                        v-model="form.description"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                    <p class="text-gray-600 text-xs italic">What is the art and how did you do it</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block mb-2 text-xs font-bold text-gray-700 mb-3 leading-tight" for="user_avatar">Upload file</label>
                    <input
                        ref="artFile"
                        v-on:change="setFileToForm"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded px-4 mb-3 leading-tight cursor-pointer bg-gray-50 focus:outline-none"
                        aria-describedby="user_avatar_help" id="user_avatar" type="file">
                </div>
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block mb-2 text-xs font-bold text-gray-700 mb-3 leading-tight" for="user_avatar">Duration</label>
                    <input
                        v-model="form.duration"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-last-name" type="text" placeholder="36 hours">
                    <p v-if="errors.duration" class="text-red-500 text-xs italic">Please fill out the duration field.</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">

                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Price
                    </label>
                    <input
                        v-model="form.price"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-last-name" type="text" placeholder="$57.30">
                    <p v-if="errors.price" class="text-red-500 text-xs italic">Please fill out the price field.</p>

                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
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
                        type="button"
                        @click="saveProduct"
                        class="appearance-none block w-full bg-blue-600 text-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    >Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import {ref} from "vue";
import axios from "axios";

import VueDatePicker from '@vuepic/vue-datepicker'

import '@vuepic/vue-datepicker/dist/main.css'

let errors = ref({
    title: null,
    price: null,
});

const currencies = ['eur', 'lkr', 'usd']

let currency = ref('lkr')
let artFile = ref(null)

let form = ref({
    title: null,
    price: 0,
    image: null,
    currency,
    description: null,
    date: null,
    duration: null
})


function setFileToForm(item) {
    artFile = item.target?.files[0];
    // console.log('item', item)
    console.log('artFile', artFile)
}

function saveProduct(event) {
    const formData = new FormData();
    Object.keys(form.value).forEach(key => formData.append(key, form.value[key]));

    if (artFile) {
        formData.append('file', artFile);
        console.log("artFile", artFile)
    }
    axios.post('/art/create', formData, {
        headers: {
            'Content-type': 'multipart/form-data'
        }
    })
}

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
