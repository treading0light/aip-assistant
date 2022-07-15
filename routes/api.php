<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/recipe/create', [RecipeController::class, 'create'])->name('recipe.create');

Route::get('/recipe/{id?}', [RecipeController::class, 'getRecipe'])->name('recipe.getRecipe');

Route::get('/ingredients', [IngredientController::class, 'getIngredients'])->name('ingredient.getIngredients');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
