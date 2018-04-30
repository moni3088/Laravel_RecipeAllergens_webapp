<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller {

    public function index() {

        $user = Auth::user();

        $recipes = $user->recipes()->get();
        
        $allergies = $user->allergies()->get();
        
        $unharmful_allergies = $user->unharmful_allergies()->get(['id', 'name']);
        
        $allergies_to_pick = array();
        
        foreach($unharmful_allergies as $allergy) {
            // ['2' => 'Gluten', '1' => 'Lactose']
            $allergies_to_pick[$allergy['id']] = $allergy['name'];
        }

        return view('users.dashboard', compact('recipes', 'allergies', 'allergies_to_pick'));
    }
    
    public function addAllergy(Request $request) {
        
        Auth::user()->allergies()->attach($request->allergy_id);
        
        return route('user.dashboard');
    }
    
    public function removeAllergy(Request $request) {

        Auth::user()->allergies()->detach($request->allergy_id);

        return route('user.dashboard');
    }

}
