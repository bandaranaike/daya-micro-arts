<?php

namespace App\Http\Controllers;

use App\Config\IntSystemConfigEnum;
use App\Http\Requests\StoreArtRequest;
use App\Http\Requests\UpdateArtRequest;
use App\Http\Resources\ArtResource;
use App\Models\Art;
use App\Services\StripeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Stripe\Exception\ApiErrorException;

class ArtController extends Controller
{
    use SaveArtTrait;

    const HOME_PAGE_GALLERY_LIMIT = 12;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $arts = Art::query()->paginate(IntSystemConfigEnum::DEFAULT_PAGINATION_PER_PAGE);
        return new JsonResponse(ArtResource::collection($arts));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getArtsForHomePage(Request $request): JsonResponse
    {
        $arts = Art::query()->when($request->get('categories'), function (Builder $builder, $categories) {
            if ($categories[0] != Art::ALL_CATEGORY_ID) {
                $builder->whereIn('category_id', $categories);
            }
        })->paginate(self::HOME_PAGE_GALLERY_LIMIT);
        return new JsonResponse(ArtResource::collection($arts));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('CreateArt');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArtRequest $request
     * @return JsonResponse
     */
    public function store(StoreArtRequest $request): JsonResponse
    {
        try {
            $art = $this->saveExecute(new Art(), $request);
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_GATEWAY);
        } catch (ApiErrorException $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return new JsonResponse($art);
    }

    /**
     * Display the specified resource.
     *
     * @param $artId
     * @return \Inertia\Response
     */
    public function show($artId): \Inertia\Response
    {
        $art = Art::query()->with('category:id,name')->select([
            'id', 'title', 'price', 'image', 'duration', 'currency', 'uuid',
            'category_id', 'currency', 'stripe_id', 'stripe_price_id', 'description'
        ])->where('uuid', $artId)->firstOrFail();
        return Inertia::render('ShowArt', compact('art'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Art $art
     * @return Response
     */
    public function edit(Art $art)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArtRequest $request
     * @param Art $art
     * @return JsonResponse
     * @throws ApiErrorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function update(UpdateArtRequest $request, Art $art): JsonResponse
    {
        $this->saveExecute($art, $request);
        return new JsonResponse("Success!");
    }

    /**paymentCanceled
     * paymentSuccess
     * Remove the specified resource from storage.
     *
     * @param Art $art
     * @return JsonResponse
     */
    public function destroy(Art $art): JsonResponse
    {
        return new JsonResponse($art->delete());
    }

    public function getPricesFromStripe()
    {
        $stripe = StripeService::make();
        return $stripe->products->all(['limit' => 3]);
    }

    public function paymentCanceled(): \Inertia\Response
    {
        return Inertia::render('PaymentCanceled');
    }

    public function paymentSuccess(): \Inertia\Response
    {
        return Inertia::render('PaymentSuccess');
    }
}
