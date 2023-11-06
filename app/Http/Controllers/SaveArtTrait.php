<?php

namespace App\Http\Controllers;

use App\Config\StringCurrencyEnum;
use App\Http\Requests\StoreArtRequest;
use App\Http\Requests\UpdateArtRequest;
use App\Services\StripeService;
use Exception;
use Illuminate\Support\Facades\Storage;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Stripe\Exception\ApiErrorException;
use Stripe\Product;

trait SaveArtTrait
{
    /**
     * @param $art
     * @param UpdateArtRequest|StoreArtRequest $request
     * @return string
     * @throws ContainerExceptionInterface
     */
    public function saveExecute($art, UpdateArtRequest|StoreArtRequest $request): string
    {
        $name = $request->get('title');

        try {
            $product = $this->createProductInStripe($name);
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return $e->getMessage();
        } catch (ApiErrorException $e) {
            return $e->getMessage();
        }

        $art->title = $name;
        $art->duration = $request->get('duration');
        $art->date = $request->get('date');
        $art->price = $request->get('price');
        $art->uuid = $product->id;

        if ($request->hasFile('image')) {
            $art->image = $request->file('image')->move(Storage::path('projects'));
        }

        return $art->save();
    }

    /**
     * @param $name
     * @return Product
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ApiErrorException
     */
    private function createProductInStripe($name): Product
    {
        $stripeService = StripeService::make();
        return $stripeService->products->create([
            'name' => $name,
            'default_price_data' => [
                'currency' => request()->get('currency'),
                'currency_options' => [StringCurrencyEnum::EUR->value, StringCurrencyEnum::LKR->value, StringCurrencyEnum::USD->value]
            ]
        ]);

    }
}
