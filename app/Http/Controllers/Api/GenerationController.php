<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Generation;
use Illuminate\Http\Request;

class GenerationController extends Controller
{
    public function index()
    {
        $generations = Generation::all();

        return response()->json([
            'status' => 'success',
            'data'   => $generations
        ]);
    }

    public function show($id)
    {
        $generation = Generation::with('pokemons.types')->find($id);

        if (!$generation) {
            return response()->json([
                'status' => 'error',
                'message' => 'Generazione non trovata'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $generation
        ]);
    }
}