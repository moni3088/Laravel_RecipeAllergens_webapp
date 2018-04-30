<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LandingController extends Controller {

    public function index() {
        $query = Request::get('q');

        $recipes = Recipe::where([
            ['name', 'like', '%' . $query . '%'],
            ['status', '=', 'approved']
        ])
            ->orderBy('name')
            ->get();

        return view('landing.landing', compact('query', 'recipes'));
    }

}
