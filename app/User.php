<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function recipes() {
        return $this->belongsToMany(
            'App\Recipe',    // instances of model to be linked to
            'users_recipes', // table that links this user model to the recipe model
            'user_id',       // foreign key of the users_recipes table representing the user model
            'recipe_id'      // related key of users_recipes table representing the model to be linked to
        );
    }

    public function allergies() {
        return $this->belongsToMany('App\Allergen', 'users_allergens', 'user_id', 'allergen_id');
    }

    public function roles() {
        return $this->belongsToMany('App\Role', 'users_roles', 'user_id', 'role_id');
    }
    public function isAuthorOfRecipe($recipe){
        return !is_null($this->recipes()->where('recipes.id', $recipe->id)->first());
    }

    public function isAdmin() {
        return !is_null($this->roles()->where('technical_name', 'admin')->first());
    }

    public function unharmful_allergies() {
        $allergen_ids = $this->allergies()->pluck('allergen_id');

        return Allergen::whereNotIn("id", $allergen_ids);
    }

}
