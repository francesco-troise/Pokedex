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
        $data = $request->all();

        $new_type = new Type();

        $new_type->name = $data['name'];
        $new_type->description = $data['description'];

        if($request->hasFile('image')){

        $path = Storage::disk('public')->putFile('types_img', $data['image'] );

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
        $data = $request->all();

        $type->name = $data['name'];
        $type->description = $data['description'];

        if($request->hasFile('image')){

            if($type->image) Storage::disk('public')->delete($type->image);

            $path = Storage::disk('public')->putFile('types_img', $data['image']);

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
