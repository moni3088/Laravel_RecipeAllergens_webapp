<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model {

    public $fillable = ['name', 'direction'];
    public $timestamps = false;

    public function ingredients() {
        return $this
            ->belongsToMany('App\Ingredient', 'recipes_ingredients', 'recipe_id', 'ingredient_id')
            ->withPivot('ingredient_quantity');
    }

    public static function findPending() {
        return Recipe::where('status', 'pending')->get();
    }

    public static function markAsApproved($recipe_id) {
        return Recipe::where('id', $recipe_id)->update(['status' => 'approved']);
    }

    public static function markAsRejected($recipe_id) {
        return Recipe::where('id', $recipe_id)->update(['status' => 'rejected']);
    }

    public function getStatusCSSClass() {
        $statusClasses = array(
            'pending' => 'text-warning',
            'approved' => 'text-success',
            'rejected' => 'text-danger',
        );

        return $statusClasses[$this->status];
    }

}
