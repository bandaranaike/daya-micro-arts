<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";

let artList = ref([]);

function deleteArt(art) {
}

function editArt(art) {

}

function loadArtList() {
    axios.get(route('art.get-list')).then(response => {
        artList.value = response.data;
    })
}

onMounted(() => {
    loadArtList()
})

</script>

<template>
    <authenticated-layout>
        <Head title="Art List"></Head>
        <div class="w-full mt-8">
            <div class="relative max-w-7xl mx-auto">
                <div class="flex">
                    <h1 class="w-full text-4xl mb-6">Art list</h1>
                    <div class="w-full text-right">
                        <a class="border rounded dark:border-gray-600 bg-gray-200 dark:bg-gray-500 px-2 py-1 mr-1" href="/art/create">Create art</a>
                    </div>
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 shadow-md sm:rounded-lg">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Duration
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="art in artList" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ art.title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ art.category?.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ art.price }}
                        </td>
                        <td class="px-6 py-4">
                            {{ art.duration }}
                        </td>
                        <td class="px-6 py-4">
                            {{ art.date }}
                        </td>
                        <td class="px-6 py-4">
                            <a @click="editArt(art)"
                               class="border rounded px-2 dark:bg-gray-800 dark:border-gray-600 mr-1 bg-gray-100 cursor-pointer font-medium text-blue-600 dark:text-blue-500"
                               :href="`/art/edit/${art.uuid}`">Edit</a>
                            <a @click="deleteArt(art)"
                               class="border rounded px-2 dark:bg-gray-800 dark:border-gray-600 mr-1 bg-gray-100 cursor-pointer font-medium text-red-600 dark:text-red-500">Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </authenticated-layout>
</template>
