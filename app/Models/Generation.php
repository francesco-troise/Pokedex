<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    public function pokemons(){
        return $this->hasMany(Pokemon::class);
    }

    public function rand_related_pkm(){
        return $this->pokemons()->inRandomOrder()->first();
    }
}
