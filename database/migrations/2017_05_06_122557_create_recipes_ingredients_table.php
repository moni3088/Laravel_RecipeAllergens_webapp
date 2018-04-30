<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesIngredientsTable extends Migration {
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('recipes_ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recipe_id');
            $table->integer('ingredient_id');
            $table->string('ingredient_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('recipes_ingredients');
    }
    
}
