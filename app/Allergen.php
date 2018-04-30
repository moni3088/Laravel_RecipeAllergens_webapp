<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergen extends Model {

    public function ingredients() {
        return $this->belongsToMany('App\Ingredient', 'ingredients_allergens', 'allergen_id', 'ingredient_id');
    }

}