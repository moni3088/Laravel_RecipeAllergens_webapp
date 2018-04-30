<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model {

    public function recipes() {
        return $this->belongsToMany('App\Recipe', 'recipes_ingredients', 'ingredient_id', 'recipe_id');
    }

    public function allergens() {
        return $this->belongsToMany('App\Allergen', 'ingredients_allergens', 'ingredient_id', 'allergen_id');
    }

    public function getAllergenNamesText() {
        $allergenNames = "";

        $allergens = $this->allergens()->get();

        for ($i = 0; $i < $allergens->count(); $i++) {

            if ($i > 0) {
                $allergenNames .= ", ";
            }

            $allergenNames .= $allergens->get($i)->name;
        }
        
        return $allergenNames;
    }

}
