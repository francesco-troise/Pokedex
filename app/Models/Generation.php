<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    public function pokemons(){
        return $this->hasMany(Pokemon::class);
    }
}
