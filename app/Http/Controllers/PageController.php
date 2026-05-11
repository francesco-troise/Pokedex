<?php

namespace App\Http\Controllers;

use App\Models\Generation;
use App\Models\Pokemon;
use App\Models\Type;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome(){
        $welcome_data['total_pokemon'] = Pokemon::count();
        $welcome_data['total_generations'] = Generation::count();
        $welcome_data['total_types'] = Type::count();

        return view('welcome', compact('welcome_data'));
    }

    public function dashboard(){
        return view('dashboard');
    }
}
