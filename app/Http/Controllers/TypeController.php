<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_types = Type::with('pokemon')->get();
        return view('type.all_types', compact('all_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('type.forms.create_type');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation_data = $request->validate([
           'name' => 'required|alpha|max:255|unique:types',
           'description' => 'nullable|string|max:5000',
           'image' => 'nullable|image|max:2048'
        ],
        [
            'name.required' => "Il nome del tipo è obligatorio",
            'name.alpha' => "Il nome del tipo puo contenere solo lettere",
            'name.max' => "Lunghezza eccessiva, massimo 255 lettere",
            'name.unique' => "Non possono esserci piu tipi con lo stesso nome",
             //rules validation for name

             'description.max' =>"Descrizone troppa lunga massimo 500 caratteri",
             //rules validation for description

            'image.image' => "Il file deve essere un'immagine",
            'image.max' => "Immagine troppo pesante, massimo 2MB consentiti"
            //rules validation for image
        ]);


        $new_type = new Type();

        $new_type->name = $validation_data['name'];
        $new_type->description = $validation_data['description'];

        if($request->hasFile('image')){

        $path = Storage::disk('public')->putFile('types_img', $validation_data['image'] );

        $new_type->image = $path;
        }

        $new_type->save();

        return redirect()->route('type.show', $new_type);

    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {

        return view('type.show_type', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('type.forms.edit_type', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $validate_data = $request->validate([
            'name' =>"required|alpha|max:255|unique:types,name,{$type->id}",
            'description' =>'nullable|string|max:5000',
            'image' => 'nullable|image|max:2048'

        ],
        [
            'name.required' => "Il nome del tipo è obligatorio",
            'name.alpha' => "Il nome del tipo puo contenere solo lettere",
            'name.max' => "Lunghezza eccessiva, massimo 255 lettere",
            'name.unique' => "Non possono esserci piu tipi con lo stesso nome",
            //rules validation for name

            'description.max' => "Descrizone troppa lunga massimo 500 caratteri",
            //rules validation for description

            'image.image' => "Il file deve essere un'immagine",
            'image.max' => "Immagine troppo pesante, massimo 2MB consentiti"
            //rules validation for imge


        ]);

        $type->name = $validate_data['name'];
        $type->description = $validate_data['description'];

        if($request->hasFile('image')){

            if($type->image) Storage::disk('public')->delete($type->image);

            $path = Storage::disk('public')->putFile('types_img', $validate_data['image']);

            $type->image = $path;

        }

        $type->save();

       return redirect()->route('type.show', $type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        if($type->image) Storage::disk('public')->delete($type->image);

        $type->delete();

        return redirect()->route('type.index');
    }
}
