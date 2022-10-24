<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtRequest;
use App\Http\Requests\UpdateArtRequest;
use Illuminate\Support\Facades\Storage;

trait SaveArtTrait
{
    /**
     * @param $art
     * @param $request
     * @return void
     */
    public function saveExecute($art, UpdateArtRequest|StoreArtRequest $request): void
    {
        $art->title = $request->get('title');
        $art->duration = $request->get('duration');
        $art->date = $request->get('date');
        $art->price = $request->get('price');

        if ($request->hasFile('image')) {
            $art->image = $request->file('image')->move(Storage::path('projects'));
        }

        $art->save();
    }
}
