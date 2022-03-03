<?php


namespace App\Http\Controllers\ApiControllers;

use App\Events\PlayerMoved;
use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\CharacterPosition;
use App\Models\Map;
use Illuminate\Http\Request;

class CharacterPositionApiController
{
    public function update(Request $request)
    {
        $characterId = $request->get('characterId');
        $xAxis = $request->get('xAxis');
        $yAxis = $request->get('yAxis');
        $character = Character::find($characterId);
        $characterPosition = $character->characterPosition()->first();
        $characterPosition->update(['x_axis' => $xAxis, 'y_axis' => $yAxis]);
//        $otherCharacters = $map->characters()
//            ->where('selected', '=', 1)
//            ->where('id','!=',$authCharacter->id)
//            ->with('characterPosition')->get();

        event(new PlayerMoved($character->map_id,$characterPosition));
    }
}
