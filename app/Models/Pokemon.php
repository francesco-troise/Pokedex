<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    public function pokemonDetail(){
        return $this->hasOne(PokemonDetail::class);
    }

    public function generation(){
        return $this->belongsTo(Generation::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class);
    }
}
