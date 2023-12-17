<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {Head} from "@inertiajs/vue3";
</script>

<template>
    <Head>
        <title>Payment canceled</title>
    </Head>

    <AppLayout :full-width="true">
        <div class="w-full text-center">
            <div class="text-xl text-red-600 inline-block mt-6 border bg-red-50 rounded px-6 py-3">
                Order canceled
            </div>
        </div>
    </AppLayout>
</template>

