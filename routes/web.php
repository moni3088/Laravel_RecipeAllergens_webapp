<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'LandingController@index')->name('landing');

Auth::routes();

// User Dashboard
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {

    Route::get('', 'UserDashboardController@index')->name('user.dashboard');
    Route::post('/add_allergy', 'UserDashboardController@addAllergy')->name('user.add_allergy');
    Route::post('/remove_allergy', 'UserDashboardController@removeAllergy')->name('user.remove_allergy');
    
});

// Recipes
Route::group(['middleware' => 'auth'], function () {
    Route::resource('recipes', 'RecipesController', ['except' => ['show']]);
});

Route::resource('recipes', 'RecipesController', ['only' => ['show']]);

// Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    
    Route::get('/dashboard', 'AdminDashboardController@index')->name('admin.dashboard');
    Route::put('/dashboard/pending_recipe/{recipe_id}/approve', 'AdminDashboardController@approveRecipe')->name('admin.dashboard.pending_recipes.approve');
    Route::put('/dashboard/pending_recipe/{recipe_id}/reject', 'AdminDashboardController@rejectRecipe')->name('admin.dashboard.pending_recipes.reject');
    Route::resource('ingredients', 'IngredientsController');
    
});