<?php

use App\Allergen;
use App\Ingredient;
use App\Recipe;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run() {
        $users = $this->seedAdmins();

        $this->seedRecipes($users[0]);
    }

    public function seedAdmins() {
        $users = array();

        $adminRole = $this->createAdminRole();
        $adminRole->save();

        $seed_admins_file_path = storage_path() . "/seed/admins_seed.json";
        $jsonAdmins = json_decode(file_get_contents($seed_admins_file_path), true);

        foreach($jsonAdmins as $jsonAdmin){

            $user = $this->createUserFromJson($jsonAdmin);

            try {
                $user->save();
                $user->roles()->attach($adminRole->id);
            } catch (Exception $e) {
                // User already exists
                continue;
            }

            array_push($users, $user);
        }

        return $users;
    }

    public function createUserFromJson($jsonAdmin) {
        $user = new User();
        $user->name = $jsonAdmin['name'];
        $user->email = $jsonAdmin['email'];
        $user->password = bcrypt($jsonAdmin['password']);

        return $user;
    }

    public function createAdminRole() {
        $adminRole = new Role();
        $adminRole->name = "Admin";
        $adminRole->technical_name = "admin";

        return $adminRole;
    }

    public function seedRecipes(User $user) {

        $seed_file_path = storage_path() . "/seed/recipes_seed.json";

        $jsonRecipes = json_decode(file_get_contents($seed_file_path), true);

        foreach ($jsonRecipes as $jsonRecipe) {

            $recipe = new Recipe();

            $recipe->name = $jsonRecipe['name'];
            $recipe->direction = $jsonRecipe['direction'];
            $recipe->status = $jsonRecipe['status'];

            $recipe->save();

            $jsonIngredients = $jsonRecipe['ingredients'];

            foreach ($jsonIngredients as $jsonIngredient) {

                $ingredient = new Ingredient();

                $ingredient->name = $jsonIngredient['name'];

                try {
                    $ingredient->save();
                } catch (Exception $e) {
                    // Ingredient already exists
                    $ingredient = Ingredient::where('name', '=', $ingredient->name)->first();
                }

                if (array_key_exists('allergens', $jsonIngredient)) {

                    $jsonAllergens = $jsonIngredient['allergens'];

                    foreach ($jsonAllergens as $jsonAllergen) {

                        $name = $jsonAllergen['name'];

                        $allergen = $ingredient->allergens()->where('name', $name)->first();

                        if (is_null($allergen)) {

                            $allergen = new Allergen();

                            $allergen->name = $name;

                            try {
                                $allergen->save();
                            } catch (Exception $e) {
                                // Allergen already exists
                                $allergen = Allergen::where('name', '=', $name)->first();
                            }

                            $ingredient->allergens()->attach($allergen->id);
                        }
                    }

                }

                $recipe->ingredients()->attach($ingredient->id, ['ingredient_quantity' => $jsonIngredient['quantity']]);
            }

            $user->recipes()->attach($user->id);
        }

    }

}
