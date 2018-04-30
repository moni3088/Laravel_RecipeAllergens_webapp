<?php

namespace App\Http\Controllers;

use App\Recipe;

class AdminDashboardController extends Controller {
   
    public function index() {

        //To do: show only if recipe_id is not linked to this user_id who needs to verify.
        $recipes = Recipe::findPending();

        return view('admin.dashboard', compact('recipes'));
    }
    
    public function approveRecipe($recipe_id) {

        Recipe::markAsApproved($recipe_id);

        return redirect()->route('admin.dashboard');
    }
    
    public function rejectRecipe($recipe_id) {
        
        Recipe::markAsRejected($recipe_id);

        return redirect()->route('admin.dashboard');
    }

}
