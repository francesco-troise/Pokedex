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
        return $this->color ?? "#828179";
    }

    public function rand_related_pkm(){
        return $this->pokemon()->inRandomOrder()->first();
    }
}
