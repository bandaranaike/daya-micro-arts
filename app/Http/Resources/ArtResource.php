<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $title
 * @property mixed $image
 * @property mixed $duration
 * @property mixed $date
 * @property mixed $price
 */
class ArtResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "name" => $this->title,
            "image" => $this->image,
            "duration" => $this->duration,
            "date" => $this->date,
            "price" => $this->price
        ];
    }
}
