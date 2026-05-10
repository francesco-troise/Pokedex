<?php

namespace App\Http\Controllers;

use App\Models\Generation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $random_pkm = $generation->rand_related_pkm();
        return view('generation.show_generation', compact(['generation', 'random_pkm']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Generation $generation)
    {
        $aviable_regions = Generation::orderBy('region', 'asc')->pluck('region');
        $aviable_numbers = Generation::orderBy('number', 'asc')->pluck('number');
        return view('generation.forms.edit_generation', compact('generation', 'aviable_regions', 'aviable_numbers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Generation $generation)
    {

        $generation->number = $request['gen_num'];
        $generation->region = $request['gen_region'];
        $generation->description = $request['gen_desc'];

        if($request->hasFile('gen_image')){

        if($generation->region_image) Storage::disk('public')->delete($generation->region_image);

        $path = Storage::disk('public')->putFile('generation_img', $request['gen_image']);

        $generation->region_image = $path;

        }

        $generation->save();

        return redirect()->route('generation.show', $generation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
