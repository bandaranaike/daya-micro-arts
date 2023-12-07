<?php

namespace App\Http\Controllers;

use App\Config\StringCurrencyEnum;
use App\Http\Requests\StoreArtRequest;
use App\Http\Requests\UpdateArtRequest;
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
    /**
     * @param $art
     * @param UpdateArtRequest|StoreArtRequest $request
     * @return string
     * @throws ApiErrorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function saveExecute($art, UpdateArtRequest|StoreArtRequest $request): string
    {
        $name = $request->get('title');
        $price = $request->get('price');


        $product = $this->createProductInStripe($name, $price);
        dd(Carbon::parse(Str::remove(" (India Standard Time)", $request->get('date'))));
        dd($request->get('date'));
dd(date("Y-m-d",strtotime()));
        $art->title = $name;
        $art->duration = $request->get('duration');
        $art->date = Carbon::createFromDate($request->get('date'));
        $art->price = $price;
        $art->uuid = $product->id;

        if ($request->hasFile('image')) {
            $art->image = $request->file('image')->move(Storage::path('projects'));
        }
        return $art->save();
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
}
