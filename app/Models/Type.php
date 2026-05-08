<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function pokemon(){
        return $this->belongsToMany(Pokemon::class);
    }

    public function getPokemonAssociated(){
        $pkm_collection = $this->pokemon;

        $pokemon_data = [];
        foreach ($pkm_collection as $pkm) {
            $pokemon_data[] = [
                'id' => $pkm->id,
                'image' => $pkm->image
            ];
        }

        return $pokemon_data;
    }

    public function getTypeColor() {
    return match($this->name) {
        'Erba'    => '#7AC74C',
        'Fuoco'   => '#EE8130',
        'Acqua'   => '#6390F0',
        'Elettro' => '#F7D02C',
        'Lotta'   => '#C22E28',
        'Veleno'  => '#A33EA1',
        'Terra'   => '#E2BF65',
        'Volante' => '#A98FF3',
        'Psico'   => '#F95587',
        'Roccia'  => '#B6A136',
        'Acciaio' => '#B7B7CE',
        'Drago'   => '#6F35FC',
        'Buio'    => '#705746',
        'Folletto'=> '#D685AD',
        default   => '#A8A77A', // Normale o sconosciuto
    };
}
}
