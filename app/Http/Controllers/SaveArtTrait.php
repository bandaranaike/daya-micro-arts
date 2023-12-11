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
    /**
     * @param $art
     * @param UpdateArtRequest|StoreArtRequest $request
     * @return Art
     * @throws ApiErrorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function saveExecute($art, UpdateArtRequest|StoreArtRequest $request): Art
    {
        $name = $request->get('title');
        $price = $request->get('price');


        $product = $this->createProductInStripe($name, $price);
        $art->title = $name;
        $art->duration = $request->get('duration');
        $art->description = $request->get('description');
        $art->date = Carbon::parse(Str::remove(" (India Standard Time)", $request->get('date')));
        $art->currency = $request->get('currency');
        $art->price = $price;
        $art->stripe_id = $product->id;
        $art->uuid = Str::uuid()->toString();

        dd($request->files('image'));
        if ($request->hasFile('image')) {
            dd("came");
            $art->image = $request->file('image')->move(Storage::path('projects'));
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
}
