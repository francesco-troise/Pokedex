<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index (Request $request){

        $query = Pokemon::with('pokemonDetails', 'types', 'generation');
        //Query initialization

        $query->when($request->name, function($q, $name){
            $q->where('name', 'LIKE', '%' . $name . '%'  );
        });
        //Filtering by name

        $query->when($request->type_id, function ($q, $type_id){
            $q->whereHas('types', function ($SubQuery) use($type_id) {
                $SubQuery->where('types.id', $type_id);
            });
        });
        //Filterign by type

        $query->when($request->region, function ($q, $region) {
            $q->whereHas('generation', function ($SubQuery) use($region) {
                $SubQuery->where('region', $region);
            });
        });
        //Filtering by region

        $query->when($request->generation_id, function($q, $generation_id){
            $q->whereHas('generation', function($SubQuery) use($generation_id){
                $SubQuery->where('generation_id', $generation_id);
            });
        });
        //Filtering by generation

        $pokemon = $query->get();

        return response()->json([
            'status' => 'success',
            'data'   => $pokemon
        ], 200);


    }

    public function show(string $id)
    {

        $pokemon = Pokemon::with(['pokemonDetails', 'types', 'generation'])
                    ->find($id);

        if (!$pokemon) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pokemon non trovato'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $pokemon
        ], 200);
    }
}
