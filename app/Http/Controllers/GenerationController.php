<?php

namespace App\Http\Controllers;

use App\Models\Generation;
use Illuminate\Http\Request;

class GenerationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generations = Generation::with('pokemons')->get();
        return view('generation.all_generations', compact('generations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Generation $generation)
    {
        $gen_data = $generation->load('pokemons');
        return view('generation.show_generation', compact('gen_data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
