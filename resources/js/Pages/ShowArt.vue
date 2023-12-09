<script setup>
import {Head} from "@inertiajs/vue3";

defineProps({
    art: Object
})
</script>

<template>
    <Head>
        <title>{{art.title}} - Daya micro art</title>
    </Head>
<div>
    {{art.title}}
</div>
</template>

<style scoped>

</style>
