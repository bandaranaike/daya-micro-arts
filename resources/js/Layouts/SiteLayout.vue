<script setup>

defineProps({
    fullWidth: false
})

</script>

<template>
    <div class="font-sans text-gray-700 antialiased">
        <div class="min-h-screen flex flex-col">
            <div class="absolute top-0 border-b w-full flex p-1 border-gray-900 shadow-xl bg-gray-900 opacity-95">
                <div class="max-w-6xl w-full mx-auto py-1">
                    <a href="/">
                        <img src="/images/logo.png" class="h-12" alt="Daya Micro Art">
                    </a>
                </div>
            </div>
            <div class="pt-16" :class="{'w-full':fullWidth, 'max-w-6xl mx-auto w-full': !fullWidth}">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
