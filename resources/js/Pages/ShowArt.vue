<script setup>
import {Head} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import CartIcon from "@/Components/CartIcon.vue";

import {StripeCheckout} from '@vue-stripe/vue-stripe';
import {ref} from "vue";
import Loader from "@/Components/Loader.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

const publishableKey = import.meta.env.VITE_STRIPE_KEY;

const successURL = import.meta.env.VITE_STRIPE_SUCCESS_URL
const cancelURL = import.meta.env.VITE_STRIPE_CANCEL_URL

let loading = ref(false)
let checkoutRef = ref(null)

async function submit(a) {
    // You will be redirected to Stripe's secure checkout page
    checkoutRef.value.redirectToCheckout();
}

const stripeLoaded = ref(false)
const card = ref()
const elms = ref()

const pay = () => {
    // Get stripe element
    const cardElement = card.value.stripeElement

    // Access instance methods, e.g. createToken()
    elms.value.instance.createToken(cardElement).then((result) => {
        // Handle result.error or result.token
        console.log(result)
    })
}

defineProps({
    art: Object
})
</script>

<template>
    <div>
        <AppLayout :title="art.title">
            <div class="max-w-6xl mx-auto w-full">
                <div class="mt-4 mb-8">
                    <div class="grid grid-cols-5 gap-4 flex">
                        <div class="col-span-3 mt-8">
                            <img class="object-cover w-full" :src="'/storage/projects/' + (art.image ?? 'default.png')" :alt="art.title">
                        </div>
                        <div class="p-8 col-span-2">
                            <h1 class="text-4xl text-slate-700 font-light leading-10"> {{ art.title }}</h1>
                            <div class="text-2xl text-slate-600 mt-2"> {{ art.category?.name }}</div>
                            <div class="mt-8 text-slate-500">About the art</div>
                            <p class="mt-2 text-slate-700">{{ art.description }}</p>
                            <div
                                class="text-slate-500 text-xs bg-slate-100 border border-slate-200 mt-4 rounded px-1 inline-block">
                                Duration : {{ art.duration }}
                            </div>
                            <div class="text-xl text-slate-700 mt-8 tracking-tight">
                                {{ art.price.toFixed(2) }} {{ art.currency.toUpperCase() }}
                            </div>
                            <div class="rounded bg-slate-700 text-white cursor-pointer px-6 py-2 mt-4 inline-block">
                                <cart-icon></cart-icon>
                                <stripe-checkout
                                    ref="checkoutRef"
                                    mode="payment"
                                    :pk="publishableKey"
                                    :success-url="successURL"
                                    :cancel-url="`${cancelURL}/${art.uuid}`"
                                    :line-items="[{quantity:1, price:art.stripe_price_id}]"
                                    client-reference-id="777"
                                    locale="en"
                                    :disable-advanced-fraud-detection="false"
                                    @loading="v => loading = v"
                                />
                                <span @click="submit"> Buy now </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    </div>
</template>
