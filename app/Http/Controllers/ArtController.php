<?php

namespace App\Http\Controllers;

use App\Config\IntSystemConfigEnum;
use App\Http\Requests\StoreArtRequest;
use App\Http\Requests\UpdateArtRequest;
use App\Http\Resources\ArtResource;
use App\Models\Art;
use App\Services\StripeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

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
     * @return JsonResponse
     */
    public function getArtsForHomePage(): JsonResponse
    {
        $arts = Art::query()->paginate(self::HOME_PAGE_GALLERY_LIMIT);
        return new JsonResponse(ArtResource::collection($arts));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Admin/CreateArt');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArtRequest $request
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     */
    public function store(StoreArtRequest $request): JsonResponse
    {


        try {
            $this->saveExecute(new Art(), $request);
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_GATEWAY);
        } catch (ApiErrorException $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        return new JsonResponse("Success!");
    }

    /**
     * Display the specified resource.
     *
     * @param Art $art
     * @return \Inertia\Response
     */
    public function show(Art $art): \Inertia\Response
    {
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
     * @param \App\Http\Requests\UpdateArtRequest $request
     * @param Art $art
     * @return JsonResponse
     */
    public function update(UpdateArtRequest $request, Art $art): JsonResponse
    {
        $this->saveExecute($art, $request);
        return new JsonResponse("Success!");
    }

    /**
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
//       return $stripe->prices->all(['limit' => 3]);
        return $stripe->products->all(['limit' => 3]);
    }
}
