<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $name
 * @property mixed|string $slug
 * @property integer $id
 */
class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function arts(): HasMany
    {
        return $this->hasMany(Art::class);
    }
}
