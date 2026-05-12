<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    public function pokemonDetails(){
        return $this->hasOne(PokemonDetail::class);
    }

    public function generation(){
        return $this->belongsTo(Generation::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class);
    }
    //Definition of relationships


    public function getHeight(){
        return $this->pokemonDetails->height;
    }

    public function getweight(){
        return $this->pokemonDetails->weight;
    }

    public function getDescription(){
        return $this->pokemonDetails->description;
    }
    //Retrieve info from PokemonDetail


    public function getGenerationNumber(){
        return $this->generation->number;
    }

    public function getRegion(){
        return $this->generation->region;
    }
    //Retrieve info from Generation

    public function putPkmDetails(string $field, $value){
        if(!$this->pokemonDetails){
            $this->setRelation('pokemonDetails', new PokemonDetail());
            $this->pokemonDetails->pokemon_id = $this->id;
        };
        $this->pokemonDetails->$field = $value;
    }
}
