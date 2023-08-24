<script setup>
import {StripeCheckout} from '@vue-stripe/vue-stripe';
import {ref} from "vue";

const publishableKey = "pk_test_51NhGHHCvg7q7caUQjeX45BB1j78nCQMWYNzEUzWrmwmclUYmgK40Zk6dVS5iPlPVUlOKiZKYdAvd9vpoVCIz9jch00lEtKdP0s"
const lineItems = [
    {
        price: 'price_1NiiMZCvg7q7caUQXTYzL4hd', // The id of the one-time price you created in your Stripe dashboard
        quantity: 1,
    },
]

const checkoutRef = ref(null)

function submit () {
    // You will be redirected to Stripe's secure checkout page
    checkoutRef.value.redirectToCheckout();
}

let loading = false;

const successURL = 'http://localhost/success';
const cancelURL = 'http://localhost/cancel';


</script>

<template>
    <stripe-checkout
        ref="checkoutRef"
        mode="payment"
        :pk="publishableKey"
        :line-items="lineItems"
        :success-url="successURL"
        :cancel-url="cancelURL"
        @loading="v => loading = v"
    />
    <button @click="submit">Pay now!</button>
</template>

<style scoped>

</style>
