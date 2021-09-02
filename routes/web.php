<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    //Get all the petitions
    $petitions = DB::table('petitions')->get();
        return view('welcome', [
            'petitions' => $petitions,
        ]);


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{id}', [App\Http\Controllers\PetitionController::class, 'viewPetition'])->name('viewPetition');
Route::get('/sign/{user_id}/{petition_id}', [App\Http\Controllers\SignController::class, 'newSign'])->name('newSign');

Route::post('/delete/{id}', [App\Http\Controllers\PetitionController::class, 'deletePetition'])->name('deletePetition');
