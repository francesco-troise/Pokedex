<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PokemonDetail extends Model
{
    public function pokemon(){
        return $this->belongsTo(Pokemon::class);
    }
}
