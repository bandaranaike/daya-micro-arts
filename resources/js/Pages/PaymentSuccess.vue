<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {Head} from "@inertiajs/vue3";
</script>

<template>
    <Head>
        <title>Payment was success!</title>
    </Head>

    <AppLayout :full-width="true">
        <div class="w-full text-center">
            <div class="text-xl text-green-800 inline-block mt-6 border bg-green-50 rounded px-6 py-3">
                Payment was success
            </div>
        </div>
    </AppLayout>
</template>
