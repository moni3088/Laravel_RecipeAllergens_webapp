<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;
use App\Ingredient;


class RecipesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('recipes.recipes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store() {
        $addedIngredients = json_decode(Input::get("addedIngredients"), true);
        $recipeImage = Input::file("image");
        $recipeName = Input::get("name");
        $recipeDirections = Input::get("directions");

        if (($addedIngredients) && ($recipeName) && ($recipeDirections)) {

            $recipe = new Recipe();
            $recipe->name = $recipeName;
            $recipe->direction = $recipeDirections;

            if ($recipeImage != null) {
                
                $file_name = uniqid() . '.' . $recipeImage->getClientOriginalExtension();
                $location = public_path('images/' . $file_name);
                Image::make($recipeImage)->resize(400, 400)->save($location);
                $recipe->image = $file_name;
                
            }

            $recipe->save();

            Auth::user()->recipes()->attach($recipe->id);

            foreach ($addedIngredients as $ingredient) {
                $this->addIngredientToRecipe($recipe, $ingredient['name'], $ingredient['quantity']);
            }

            return route('recipes.show', $recipe->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $recipe = Recipe::find($id);

        $ingredients = $recipe->ingredients()->get();

        return view('recipes.show', compact('recipe', 'ingredients', 'quantities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $recipe = Recipe::find($id);

        $ingredients = $recipe->ingredients()->get();

        return view('recipes.edit', compact('recipe', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $recipeName = Input::get("name");
        $recipeImage = Input::file('image');
        $recipeDirections = Input::get("directions");
        $addedIngredients = json_decode(Input::get("addedIngredients"), true);
        $removedIngredientIds = json_decode(Input::get("removedIngredientIds"));

        $recipe = Recipe::find($id);

        if ($recipeName != null) {
            $recipe->name = $recipeName;
        }

        if ($recipeDirections != null) {
            $recipe->direction = $recipeDirections;
        }

        if ($recipeImage != null && $recipeImage != $recipe->image) {

            $file_name = uniqid() . '.' . $recipeImage->getClientOriginalExtension();
            $location = public_path('images/' . $file_name);
            Image::make($recipeImage)->resize(400, 400)->save($location);
            $recipe->image = $file_name;

        }

        foreach ($addedIngredients as $ingredient) {
            $this->addIngredientToRecipe($recipe, $ingredient['name'], $ingredient['quantity']);
        }
        
        foreach ($removedIngredientIds as $ingredientId) {
            $recipe->ingredients()->detach($ingredientId);
        }

        $recipe->save();

        return route('recipes.show', $recipe->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Recipe::destroy($id);

        return route('landing');
    }

    /**
     * @param $recipe
     * @param $name
     * @param $quantity
     */
    public function addIngredientToRecipe($recipe, $name, $quantity) {
        $ingredientsWithName = Ingredient::where('name', '=', $name)->get();

        $ingredientToSave = null;

        if ($ingredientsWithName->isEmpty()) {

            $ingredientToSave = new Ingredient();
            $ingredientToSave->name = $name;
            $ingredientToSave->save();

        } else {
            $ingredientToSave = $ingredientsWithName->get(0);
        }

        $recipe->ingredients()->attach($ingredientToSave->id, ['ingredient_quantity' => $quantity]);
    }

}
