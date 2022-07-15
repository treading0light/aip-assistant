<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function getIngredients() {
        $ingredients = Ingredient::all();

        $json = json_encode($ingredients);

        return $json;
    }
}
