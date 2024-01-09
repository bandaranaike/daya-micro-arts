<script setup>
import {Head} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import {capitalize} from "@vue/shared";
import CartIcon from "@/Components/CartIcon.vue";

import {StripeCheckout} from '@vue-stripe/vue-stripe';
import {ref} from "vue";

const publishableKey = import.meta.env.VITE_STRIPE_KEY;

const successURL = import.meta.env.VITE_STRIPE_SUCCESS_URL
const cancelURL = import.meta.env.VITE_STRIPE_CANCEL_URL

let loading = ref(false)
let checkoutRef = ref(null)

function submit() {
    // You will be redirected to Stripe's secure checkout page
    checkoutRef.value.redirectToCheckout();
}

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
            <div class="grid grid-cols-5 gap-4">
                <div class="col-span-3 mt-4">
                    <img class="object-cover w-full" :src="'/storage/projects/' + (art.image ?? 'default.png')" :alt="art.title">
                </div>
                <div class="p-8 col-span-2">
                    <h1 class="text-4xl text-gray-700 font-light leading-8"> {{ art.title }}</h1>
                    <div class="text-2xl text-orange-600 mt-2"> {{ art.category?.name }}</div>
                    <div class="font-bold text-xl mt-6 text-gray-600">About the art</div>
                    <p class="mt-1 text-gray-700">{{ art.description }}</p>
                    <div
                        class="text-gray-500 text-sm bg-gray-100 border border-gray-200 font-bold mt-2 rounded px-2 py-1 inline-block">
                        Duration : {{ art.duration }}
                    </div>
                    <div class="text-2xl text-gray-700 mt-8 font-bold tracking-tight">
                        {{ art.price.toFixed(2) }} {{ art.currency.toUpperCase() }}
                    </div>
                    <div class="rounded bg-gray-600 text-white cursor-pointer px-4 py-2 mt-2 inline-block">
                        <cart-icon></cart-icon>
                        <stripe-checkout
                            ref="checkoutRef"
                            mode="payment"
                            :pk="publishableKey"
                            :success-url="successURL"
                            :cancel-url="`${cancelURL}/${art.uuid}`"
                            :line-items="[{quantity:1, price:art.stripe_price_id}]"
                            @loading="v => loading = v"
                        >
                        </stripe-checkout>
                        <span @click="submit">Buy now </span>
                    </div>
                </div>
            </div>
        </div>
    </site-layout>
</template>
