<?php

namespace App\Http\Controllers;

use App\Config\IntSystemConfigEnum;
use App\Http\Requests\StoreArtRequest;
use App\Http\Requests\UpdateArtRequest;
use App\Http\Resources\ArtResource;
use App\Models\Art;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ArtController extends Controller
{
    use SaveArtTrait;

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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArtRequest $request
     * @return JsonResponse
     */
    public function store(StoreArtRequest $request): JsonResponse
    {
        $this->saveExecute(new Art(), $request);
        return new JsonResponse("Success!");
    }

    /**
     * Display the specified resource.
     *
     * @param Art $art
     * @return Response
     */
    public function show(Art $art)
    {
        //
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
}
