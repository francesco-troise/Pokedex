<?php

namespace App\Http\Controllers;

use App\Models\Generation;
use App\Models\Pokemon;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      if($request->name||$request->type||$request->number||$request->region){
        $filters= $request->validate([
            'name' => "nullable|alpha|min:1|max:100",
            'type' => "nullable|numeric|integer|min:1",
            'number' => "nullable|numeric|integer|min:1",
            "region" => "nullable|numeric|min:1|max:100"
        ],
        [
            'name.alpha' => "Sono ammessi solo lettere",
            'name.min' => "Mini 1 carattere",
            'name.max' => "Massimo caratteri consentiti: 100",
            //Rules validation for name

            'type.numeric' => "Inserire solo numeri",
            'type.integer' => "inserire solo numeri interi",
            'type.min' => "Non esiste tipo con id associato minore di 1",
            //Rules validation for type

            'number.numeric' => "Inserire solo numeri",
            'number.integer' => "inserire solo numeri interi",
            'number.min' => "Non esiste generazione con id associato minore di 1",
            //Rules validation for number

            'region.numeric' => "Inserie solo numeri",
            'region.min' => "Minimo 1 carattere richiesto",
            'region.max' => "Massmio caratteri consentiti: 100"
            //rules validation for region

        ]);

        $query= Pokemon::with('pokemonDetails','types', 'generation');

        if($request->filled('name')) $query->where('name', 'like', "%" . $filters['name'] . "%");
        //Filtro per Nome

        if($request->filled('type')){
            $type_id = $filters['type'];
            $query->whereHas('types', function($q) use($type_id){
                $q->where('types.id', $type_id);
            });
        }
        //Filtro per Tipo


        if ($request->filled('number')) {
            $query->whereHas('generation', function ($q) use ($filters) {
                $q->where('generations.id', $filters['number']);
            });
        }
        // Filtro per ID Generazione

        if ($request->filled('region')) {
            $query->whereHas('generation', function ($q) use ($filters) {
                $q->where('generations.id', $filters['region']);
            });
        }
        // Filtro per Nome Regione

        $all_pokemon = $query->get();
      }else{
        $all_pokemon = Pokemon::with('generation', 'types')->get();
        //Se filtri assenti
      }


        $all_gen = Generation::all();
        $all_types = Type::all();
        //Generazioni e tipi per popolare select

       return view('pokemon.all_pokemon', compact('all_pokemon','all_types', 'all_gen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aviable_types = Type::all();
        $aviable_gen = Generation::all();
        return view('pokemon.forms.create_pokemon', compact('aviable_types','aviable_gen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate_data = $request->validate([
            'pokemon.name' => "required|string|unique:pokemon|min:1|max:100|",
            'pokemon.height' => "nullable|numeric|min:0.1|max:99999.99",
            'pokemon.weight' => "nullable|numeric|min:0.1|max:99999.99|",
            'pokemon.description' => "nullable|string|max:5000",
            'pokemon.image' => "required|image|max:2048",
             //Rules validate for Pokemon Info

            'pokemon.types' => "required|array|min:1",
            'pokemon.types.*' => "integer|exists:types,id",
            //Rules validate for Pokemon types

            'pokemon.generation_id' => "required|integer|min:1|max:100|exists:generations,id"
            //Rules validate for Pokemon generation

         ],
         [
            'pokemon.name.required' => "Il nome del pokemon è obbligatorio",
            'pokemon.name.string' => "Il nome del pokemon ammette solo lettere",
            'pokemon.name.min' => "Lunghezza minima del nome: 1 carattere",
            'pokemon.name.max' => "lunghezza eccessiva: massimo 100 caratteri",
            'pokemon.name.unique' => "Non ci possono essere due pokemon con nome uguale",
            //Error messages for name

            'pokemon.height.numeric' => "Inserire solo numeri",
            'pokemon.height.min' => "Altezza minimo 0.1",
            'pokemon.height.max' => "Altezza eccessiva, massimo 19.999,99 ",
            'pokemon.weight.min' => "Peso minimo 0.1",
            'pokemon.weight.max' => "Peso eccessivo, massimo 19.999,99 ",
            //Error messages for height/weight

            'pokemon.description.string' => "Sono ammessi solo caratteri alfa-numerici",
            'pokemon.description.max' => "Lunghezza eccessiva: massimo 5.000 caratteri",
            //Error messages for description

            'pokemon.image.image' => "Caricare un immagine, altri tipi di file non sono supportati",
            'pokemon.image.max' => "Immagine troppo pesante, massimo 2MB",
            'pokemon.image.required' => "Immagine obbligatoria per Pokemon",
            //Error messages for image

            'pokemon.types.required' => "Inserire almeno un tipo",
            'pokemon.types.min' => "inserire almeno un tipo",
            'pokemon.types.*.integer' => "Errore, tipologia selezionata ha ID non intero",
            'pokemon.types.*.exists' => "Errore, la tipologia selezionata non è presente tra i tipi disponibili"
            //Error messages for types
        ]);

        $pokemon_data = $validate_data['pokemon'];

        $new_pkm = new Pokemon();

        $new_pkm->name = $pokemon_data['name'];
        $new_pkm->generation_id = $pokemon_data['generation_id'];
        $path = Storage::disk('public')->putFile('pokemon_img', $pokemon_data['image']);
        $new_pkm->image = $path;


        $new_pkm->save();


        $new_pkm->putPkmDetails('height', $pokemon_data['height']);
        $new_pkm->putPkmDetails('weight', $pokemon_data['weight']);
        $new_pkm->putPkmDetails('description', $pokemon_data['description']);

        $new_pkm->pokemonDetails->save();

        $new_pkm->types()->sync($pokemon_data['types']);

        return redirect()->route('pokemon.show', $new_pkm);
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
        $aviable_types = Type::all();
        $types_selected = $pokemon->types;
        $aviable_types = $aviable_types->diff($types_selected);

        $aviable_gen = Generation::all();

        $pokemon->load('pokemonDetails', 'generation', 'types');

        return view('pokemon.forms.edit_pokemon', compact('pokemon', 'aviable_types', 'aviable_gen', 'types_selected'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pokemon $pokemon)
    {
        $validate_data = $request->validate([
            'pokemon.name' => "required|alpha|unique:pokemon,name,{$pokemon->id}|min:1|max:100",
            'pokemon.height' => "nullable|numeric|min:0.1|max:99999.99|",
            'pokemon.weight' => "nullable|numeric|min:0.1|max:99999.99|",
            'pokemon.description' => "nullable|string|max:5000",
            'pokemon.image' => "nullable|image|max:2048",
            //Rules validate for Pokemon Info

            'pokemon.types' => "required|array|min:1",
            'pokemon.types.*' => "integer|exists:types,id",
            //Rules validate for Pokemon types

            'pokemon.generation_id' => "required|integer|min:1|max:100|exists:generations,id"
            //Rules validate for Pokemon generation
        ],
        [
            'pokemon.name.required' => "Il nome del pokemon è obbligatorio",
            'pokemon.name.alpha' => "Il nome del pokemon ammette solo lettere",
            'pokemon.name.min' => "Lunghezza minima del nome: 1 carattere",
            'pokemon.name.max' => "lunghezza eccessiva: massimo 100 caratteri",
            'pokemon.name.unique' => "Non ci possono essere due pokemon con nome uguale",
            //Error messages for name

            'pokemon.height.numeric' => "Inserire solo numeri",
            'pokemon.height.min' => "Altezza minimo 0.1",
            'pokemon.height.max' => "Altezza eccessiva, massimo 19.999,99 ",
            'pokemon.weight.min' => "Peso minimo 0.1",
            'pokemon.weight.max' => "Peso eccessivo, massimo 19.999,99 ",
            //Error messages for height/weight

            'pokemon.description.string' => "Sono ammessi solo caratteri alfa-numerici",
            'pokemon.descrition.max' => "lunghezza eccessiva: massimo 5.000 caratteri",
            //Error messages for description

            'pokemon.image.image' => "Caricare un immagine, altri tipi di file non sono supportati",
            'pokemon.image.max' => "Immagine troppo pesante, massimo 2MB",
            //Error messages for image

            'pokemon.types.required' => "Inserire almeno un tipo",
            'pokemon.types.min' => "inserire almeno un tipo",
            'pokemon.types.*.integer' => "Errore, tipologia selezionata ha ID non intero",
            'pokemon.types.*.exists' => "Errore, la tipologia selezionata non è presente tra i tipi disponibili"
            //Error messages for types
        ]);

        if (!$pokemon->image && !$request->hasFile('image')) {

            return redirect()->route('pokemon.edit', $pokemon)
                ->withErrors(['image' => 'Nessuna immagine precaricata per questo pokemon, inserire immagine'])
                ->withInput();
        };
        //Extra ceck for img error

        $pokemon->name = $validate_data['pokemon']['name'];

        $pokemon->generation_id = $validate_data['pokemon']['generation_id'];

        if($request->hasFile('image')){

            if($pokemon->image) Storage::disk('public')->delete('$pokemon->image');

            $path = Storage::disk('public')->putFile('pokemon_img', $request['image']);

            $pokemon->image = $path;

        }
        $pokemon->save();
        //Update pokemon info

        $pokemon->pokemonDetails->height = $validate_data['pokemon']['height'];
        $pokemon->pokemonDetails->weight = $validate_data['pokemon']['weight'];
        $pokemon->pokemonDetails->description = $validate_data['pokemon']['description'];
        //update details pokemon

        $pokemon->types()->sync($validate_data['pokemon']['types']);
        //update pivot pokemon-types

        return redirect()->route('pokemon.show', $pokemon);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokemon $pokemon)
    {
        if($pokemon->image) Storage::disk('public')->delete($pokemon->image);

        $pokemon->delete();

        return redirect()->route('pokemon.index');
    }
}