<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $title
 * @property mixed $image
 * @property mixed $duration
 * @property mixed $date
 * @property mixed $price
 */
class Art extends Model
{
    use HasFactory;
}
