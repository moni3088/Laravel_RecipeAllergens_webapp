<?php

namespace App\Http\Controllers;

use App\Allergen;
use App\Ingredient;
use Exception;
use Illuminate\Http\Request;
use Session;

class IngredientsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $ingredients = Ingredient::all();
        $ingredients = $ingredients->reverse();

        return view('ingredients.ingredients', ['ingredients' => $ingredients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $ingredient = new Ingredient();
        $ingredient->name = $request->ingredient_name;

        try {
            $ingredient->save();
        } catch (Exception $e) {
            // Ingredient already exists
            $ingredient = Ingredient::where('name', $request->ingredient_name)->first();
        }

        $allergen = new Allergen();
        $allergen->name = $request->allergen_name;

        try{
            $allergen->save();
        } catch(Exception $e){
            // Allergen already exists
            $allergen = Allergen::where('name', $request->allergen_name)->first();
        }

        $existingAllergen = $ingredient->allergens()->where('name', $request->allergen_name)->first();

        // If link doesn't exist yet for ingredient with this allergen.
        if (is_null($existingAllergen)) {
            $ingredient->allergens()->attach($allergen->id);
        }

        return $ingredient->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view('ingredients.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
