<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CharacterPosition
 * @package App\Models
 *
 * @mixin Builder
 */
class CharacterPosition extends Model
{
    protected $table = 'character_position';
    protected $guarded = [];

    public function character(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Character::class);
    }
}
