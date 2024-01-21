<?php

namespace App\Http\Controllers;

use App\Config\StringCurrencyEnum;
use App\Http\Requests\StoreArtRequest;
use App\Http\Requests\UpdateArtRequest;
use App\Models\Art;
use App\Services\StripeService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Stripe\Exception\ApiErrorException;
use Stripe\Product;

trait SaveArtTrait
{

    const IMAGE_STORE_PATH = 'public/projects';

    public function __construct()
    {
        $this->stripeService = StripeService::make();
    }

    /**
     * @param $art
     * @param UpdateArtRequest|StoreArtRequest $request
     * @param bool $isNew
     * @return Art
     * @throws ApiErrorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function saveExecute($art, UpdateArtRequest|StoreArtRequest $request, $isNew = true): Art
    {
        $name = $request->get('title');
        $price = $request->get('price');

        $product = $isNew ? $this->createProductInStripe($name, $price)
            : $this->updateProductInStripe($art, $name, $price);

        $art->title = $name;
        $art->duration = $request->get('duration');
        $art->description = $request->get('description');
        $art->category_id = $request->get('category_id');
        $art->date = Carbon::parse(Str::remove(" (India Standard Time)", $request->get('date')));
        $art->currency = $request->get('currency');
        $art->price = $price;
        $art->stripe_price_id = $product->default_price;
        $art->stripe_id = $product->id;

        if ($isNew)
            $art->uuid = Str::uuid()->toString();

        if ($request->file('image')) {
            $art->image = Str::remove(self::IMAGE_STORE_PATH, $request->file('image')->store(self::IMAGE_STORE_PATH));
        }

        $art->save();
        return $art;
    }

    /**
     * @param $name
     * @param $price
     * @return Product
     * @throws ApiErrorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function createProductInStripe($name, $price): Product
    {
        $stripeService = StripeService::make();
        return $stripeService->products->create([
            'name' => $name,
            'default_price_data' => [
                'currency' => request()->get('currency'),
                'unit_amount' => $price * 100
            ]
        ]);
    }

    /**
     * @param $productStripeId
     * @param $name
     * @param $price
     * @return Product
     * @throws ApiErrorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function updateProductInStripe($art, $name, $price): Product
    {

        return $stripeService->products->update($art->stripe_id, [
            'metadata' => [
                'name' => $name,
                'default_price_data' => [
                    'currency' => request()->get('currency'),
                    'unit_amount' => $price * 100
                ]
            ]
        ]);
    }

    private function makeOldPriceInactive($art)
    {

    }

    private function createNewPrice()
    {

    }
}
