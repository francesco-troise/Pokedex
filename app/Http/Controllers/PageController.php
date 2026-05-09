<?php

namespace App\Http\Controllers;

use App\Models\Generation;
use App\Models\Pokemon;
use App\Models\Type;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome(){
        $total_pokemon = Pokemon::count();
        $total_generations = Generation::count();
        $total_types = Type::count();

        $welcome_data['total_pokemon']= $total_pokemon;
        $welcome_data['total_generations']= $total_generations;
        $welcome_data['total_types']= $total_types;
        return view('welcome', compact('welcome_data'));
    }

    public function dashboard(){
        return view('dashboard');
    }
}
