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
    public function index(Request $request)
    {

        $filters = $request->validate([
            'region' => "nullable|alpha|min:1|max:100|",
            'number' => "nullable|numeric|integer|min:1|max:100"
        ],
        [
            'region.alpha' => "Sono ammesse solo lettere",
            'region.min' => "Minimo un carattere richiesto",
            'region.max' => "Massimo caratteri consentiti: 100",
            //Rules validation for region

            'number.numeric' => "Inserire un numero",
            'number.integer' => "inserire un numero intero",
            'number.min' => "Valore minimo accettao: 1",
            'number.max' => "Valore massimo accettato: 100"
            //Reluse validation for number
        ]);

        $query = Generation::with('pokemons');

        if($request->anyFilled('region')){
            $query->where('region', 'like', "%" . $filters['region'] . "%");
        }

        if($request->anyFilled('number')){
            $query->where('number', $filters['number']);
        }

        $generations = $query->get();

        return view('generation.all_generations', compact('generations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('generation.forms.create_generation');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate_data = $request->validate([
            'number' => ['required', 'unique:generations', 'numeric', 'integer', 'min:1', 'max:100'],
            'region' => ['required', 'unique:generations', 'alpha', 'min:1', 'max:255'],
            'description' => 'nullable|string|max:5000',
            'region_image' => 'nullable|image|max:2048'
        ],
        [
            'number.required' => "Inserire un numero di rifeirmento per la generazione",
            'number.unique' => "Non ci possono essere generazioni con un numero uguale",
            'number.numeric' => "Il numero di riferimento della generazione deve essere un -numero",
            'number.integer' => "il numero della generazione deve essere un intero",
            'number.min' => "Il numero della generazione non può essere minore di 1",
            'number.max' => "Il numero della generazione non può essere maggiore di 100",
            //Rules validation fot -number

            'region.required' => "E' necessario associare una regione alla generazione",
            'region.unique' => "Non ci possono essere generazioni che condividono la regione",
            'region.alpha' => "Sono ammessi solo lettere",
            'region.min' => "Caratteri insufficienti, mino 1 carattere",
            'region.max' => "Troppi caratteri, massimo 255 caratteri",
            //Rules validation fot -gen_reion

            'description.string' => "Sono accettati solo caratteri alfa-numerici",
            'description.max' => "Descrizione eccessiva, massimo caratteri consentiti: 5.000",
            //Rules validation fot -description

            'region_image.image' => "Caricare un'immagine, altre tipologie di file non sono supportate",
            'region_image.max' => "Immagine troppo pesante, massimo consentito: 2MB"
            //Rules validation fot -region_image
        ]);

        $new_gen = new Generation();

        $new_gen->number = $validate_data['number'];
        $new_gen->region = $validate_data['region'];
        $new_gen->description = $validate_data['description'];

        if($request->hasFile('region_image')){
            $path = Storage::disk('public')->putFile('generation_img', $request['region_image']);

            $new_gen->region_image = $path;
        }

        $new_gen->save();


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
        $validate_data = $request->validate([
            'number' => "required|unique:generations,number,{$generation->id}|numeric|integer|min:1|max:100",
            'region' => "required|unique:generations,region,{$generation->id}|alpha|min:1|max:255",
            'description' => 'nullable|string|max:5000',
            'region_image' => 'nullable|image|max:2048'
        ],
        [
            'number.required' => "Inserire un numero di rifeirmento per la generazione",
            'number.unique' => "Non ci possono essere generazioni con un numero uguale",
            'number.numeric' => "Il numero di riferimento della generazione deve essere un -numero",
            'number.integer' => "il numero della generazione deve essere un intero",
            'number.min' => "Il numero della generazione non può essere minore di 1",
            'number.max' => "Il numero della generazione non può essere maggiore di 100",
            //Rules validation fot -number

            'region.required' => "E' necessario associare una regione alla generazione",
            'region.unique' => "Non ci possono essere generazioni che condividono la regione",
            'region.alpha' => "Sono ammessi solo lettere",
            'region.min' => "Caratteri insufficienti, mino 1 carattere",
            'region.max' => "Troppi caratteri, massimo 255 caratteri",
            //Rules validation fot -gen_reion

            'description.string' => "Sono accettati solo caratteri alfa-numerici",
            'description.max' => "Descrizione eccessiva, massimo caratteri consentiti: 5.000",
            //Rules validation fot -description

            'region_image.image' => "Caricare un'immagine, altre tipologie di file non sono supportate",
            'region_image.max' => "Immagine troppo pesante, massimo consentito: 2MB"
            //Rules validation fot -region_image
        ]);

        $generation->number = $validate_data['number'];
        $generation->region = $validate_data['region'];
        $generation->description = $validate_data['description'];

        if($request->hasFile('region_image')){

        if($generation->region_image) Storage::disk('public')->delete($generation->region_image);

        $path = Storage::disk('public')->putFile('generation_img', $request['region_image']);

        $generation->region_image = $path;

        }

        $generation->save();

        return redirect()->route('generation.show', $generation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Generation $generation)
    {
        if($generation->region_image) Storage::disk('public')->delete($generation->region_image);

        $generation->delete();

        return redirect()->route('generation.index');
    }
}
