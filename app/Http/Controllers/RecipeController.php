<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recipe;
use App\Models\Step;
use App\Models\Ingredient;
use App\Models\Category;

class RecipeController extends Controller
{
    public function create(Request $request) {

        $recipe = new Recipe;

        $category = Category::create([

            'name' => 'dinner'
        ]);

        $ingredientArray = [
            '1 lb' => 'ground beef',
            '1' => 'onion',
            '1 piece' => 'lettuce'
        ];

        

        $recipe->name = 'hamburger';

        $recipe->directions = 'smash it up and cook it.';

        $recipe->category_id = $category->id;

        $recipe->save();

        foreach ($ingredientArray as $qty => $ingredient) {
            $newIngredient = Ingredient::create([

                'name' => $ingredient
            ]);

            $recipe->ingredients()->attach($newIngredient, ['qty' => $qty]);
        };

        print_r($recipe);



    }

    public function getRecipe(Request $request, $id=null) {

        if (!$id) {
            $recipe = Recipe::all();
        } else {
            $recipe = Recipe::find($id);
        }

        // $recipe = Recipe::find($request->id);
        

        // $jsonRecipe = $recipe->toJson();

        // dd($jsonRecipe);

        return response()->json($recipe);
    }
}
