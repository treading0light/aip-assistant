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
        // validate the request

        // create the recipe and ingredient relationship

        // include pivot table

        try {
            $attributes = $request->validate([
                'title' => ['required', 'max:25', 'unique:recipes'],
                'description' => ['nullable', 'max:255'],
                'directions' => ['required']
            ]);

            $recipe = Recipe::create($attributes);

            if ($request->file('image')) {
                $this->saveRecipeImage($request, $recipe);
            };

            foreach ($request['ingredients'] as $i) {
                $ingredient = Ingredient::find($i['id']);
                // define relationship of each ingredient by adding them to their pivot table
                // $recipe->ingredients()->attach($ingredient, ['qty' => $i->qty, 'unit' => $i->unit]);
                $recipe->ingredients()->attach($ingredient, ['qty' => 5, 'unit' => 'cups']);
            };

            // dd($recipe);

            $message = 'success';

            return json_encode($message);

            // print_r('success');

        } catch (Throwable $e) {

            $message = $e->getMessage();

            return json_encode($message);
            // print_r($message->toJson());
        }

        



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

    public function populate() {

        $recipe = new Recipe;

        $ingredientArray = [
            '1 lb' => 'ground beef',
            '1' => 'onion',
            '1 piece' => 'lettuce'
        ];

        

        $recipe->name = 'hamburger';

        $recipe->directions = 'smash it up and cook it.';

        $recipe->save();

        foreach ($ingredientArray as $qty => $ingredient) {
            $newIngredient = Ingredient::create([

                'name' => $ingredient
            ]);

            $recipe->ingredients()->attach($newIngredient, ['qty' => $qty]);
        };

        print_r($recipe);

    }

    function saveRecipeImage(Request $request, $recipe) {

        $imageName = time().'.'.$request->file('image')->getClientOriginalName();

        $image = $request->file('image')->move('images/', $imageName);




    }
}
