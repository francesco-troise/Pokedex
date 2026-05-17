<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    <?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();

        return response()->json([
            'status' => 'success',
            'data'   => $types
        ]);
    }

    public function show($id)
    {
        $type = Type::with(['pokemon.types', 'pokemon.generation'])->find($id);

        if (!$type) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tipo non trovato'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $type
        ]);
    }
}
}
