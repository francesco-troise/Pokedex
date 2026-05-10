<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_pokemon = Pokemon::with('pokemonDetails','types', 'generation')->get();
       return view('pokemon.all_pokemon', compact('all_pokemon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "SEI NELLA -CREATE DI POKEMON";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "SEI NELLA -STORE DI POKEMON";
    }

    /**
     * Display the specified resource.
     */
    public function show(Pokemon $pokemon)
    {

        $pokemon->load(['pokemonDetails', 'generation', 'types']);
        return view('pokemon.show_pokemon', compact('pokemon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokemon $pokemon)
    {
        dd($pokemon);
        return "SEI NELLA -EDIT DI POKEMON";

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "SEI NELLA -UPDATE DI POKEMON";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "SEI NELLA -DESTROY DI POKEMON";
    }
}
