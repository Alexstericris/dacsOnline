<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Map
 * @package App\Model
 *
 * @mixin Builder
 */
class Map extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
