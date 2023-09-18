<?php

namespace App\Http\Controllers;

use App\Models\Art;
use App\Services\StripeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Stripe\Collection as StripeCollection;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeProductController extends Controller
{
    private StripeClient $stripeService;
    private StripeCollection $stripePrices;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService->make();

        $this->stripePrices = $this->getAllPricesFromStripe();
    }

    public function saveInDatabaseAllProductsFromStripe(): JsonResponse
    {
        try {
            $stripeProducts = $this->getAllProductsFromStripe();

            $arts = $this->prepareUpsertDataSet($stripeProducts);
            Art::query()->upsert($arts, ['product_id', 'price_id']);

            return new JsonResponse("The price list was successfully updated");
        } catch (ApiErrorException $e) {
            return new JsonResponse($e->getMessage(), 500);
        }
    }

    private function getAllProductsFromStripe(): StripeCollection
    {
        return $this->stripeService->products->all();
    }


    private function getAllPricesFromStripe(): StripeCollection
    {
        Log::info("Calling api for price");
        return $this->stripeService->prices->all();
    }

    private function getProductPrice($priceHash)
    {
        Log::info(" for $priceHash");
        return (new Collection($this->getAllPricesFromStripe()->data))->where('id',$priceHash)->first();
    }

    private function prepareUpsertDataSet(StripeCollection $stripeProducts): array
    {
        $arts = [];

        foreach ($stripeProducts as $stripProduct) {
//            dd($stripProduct);


//            dd($this->getProductPrice($stripProduct->default_price));
            $arts[] = [
                'uuid' => Str::uuid()->toString(),
                'title' => $stripProduct->name,
                'description' => $stripProduct->description,
                'product_id' => $stripProduct->id,
                'price_id' => $stripProduct->default_price,
                'price' => $this->getProductPrice($stripProduct->default_price)
            ];
        }
        return $arts;
    }
}
