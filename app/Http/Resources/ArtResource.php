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
 * @property mixed $description
 * @property mixed $uuid
 * @property mixed $currency
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
            "title" => $this->title,
            "uuid" => $this->uuid,
            "image" => $this->image,
            "duration" => $this->duration,
            "category" => $this->category,
            "date" => $this->date,
            "price" => $this->price,
            "description" => $this->description,
            "currency" => $this->currency,
        ];
    }
}
