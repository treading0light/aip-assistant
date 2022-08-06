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

            foreach ($request['ingredients'] as $i) {
                $ingredient = Ingredient::find($i['id']);
                // define relationship of each ingredient by adding them to their pivot table
                // $recipe->ingredients()->attach($ingredient, ['qty' => $i->qty, 'unit' => $i->unit]);
                $recipe->ingredients()->attach($ingredient, ['qty' => 5, 'unit' => 'cups']);
            };

            $message = 'success';

            return json_encode($recipe->id);

        } catch (Throwable $e) {

            $message = $e->getMessage();

            return json_encode($message);
        }
    }

    public function createImage(Request $request) {
        try {

            $file = $request->file('image');
            $recipe = Recipe::find($request['id']);

            $response['message'] = $recipe->name;

            return json_encode($response);

            $imageName = time() . '.' . $recipe->name;

            $path = $file->storeAs(public_path('images'), $imageName);

            $recipe->image = $path;
            $recipe->save();

            $response['message'] = 'createImage success';

            return json_encode($response);

        } catch (Exception $e) {
            $response['message'] = $e->getMessage();

            return json_encode($response);
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

    function saveRecipeImage(Request $request, $id) {

        try {
            $imageName = time().'.'.$request->image->file('image')->getClientOriginalName();

            $image = $request->image->file('image')->move(public_path('images'), $imageName);

            // return json_encode($image->name);

            $recipe->image = public_path('images').$imageName;
            $recipe->save();
        } catch (Exception $e) {
            $message = 'saveRecipeImage Error: '.$e->getMessage();

            return json_encode($message);
        }

       




    }
}
