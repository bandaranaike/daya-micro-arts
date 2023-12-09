<?php

namespace App\Services;

use Stripe\StripeClient;

class StripeService
{
    public static function make(): StripeClient
    {
        return new StripeClient(config('services.stripe.secret'));
    }
}
