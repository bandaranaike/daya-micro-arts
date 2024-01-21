<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $title
 * @property mixed $image
 * @property mixed $duration
 * @property mixed $date
 * @property mixed $price
 * @property mixed $stripe_id
 * @property mixed $stripe_price_id
 */
class Art extends Model
{
    use HasFactory;

    CONST ALL_CATEGORY_ID = 0;



    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
