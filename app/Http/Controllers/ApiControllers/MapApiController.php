<?php


namespace App\Http\Controllers\ApiControllers;


use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\CharacterPosition;
use App\Models\Map;
use Illuminate\Http\Request;

class MapApiController extends Controller
{
    public function getPlayers(Request $request)
    {
        $map = Map::where('route', '=', $request->get('map'))->first();
        $user = $request->user();
        $authCharacter=$user->selectedCharacter()->where('map_id', $map->id)->with('characterPosition')->first();
        $otherCharacters = $map->characters()
            ->where('selected', '=', 1)
            ->where('id','!=',$authCharacter->id)
            ->with('characterPosition')->get();
        return response()->json([
            'player'=>$authCharacter,
            'otherPlayers'=>$otherCharacters]);
    }
}
