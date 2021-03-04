<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Character
 * @package App\Models
 *
 * @mixin Builder
 */
class Character extends Model
{
    use HasFactory;

    protected $casts = [
        'attributes'=>'object'
    ];
    protected $guarded = [];
    public function characterPosition():HasOne
    {
        return $this->hasOne(CharacterPosition::class);
    }
}
