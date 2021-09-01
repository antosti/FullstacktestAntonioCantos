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

    //If the user is authenticated, it sends to home view. If not, it returns the welcome page
    if(auth()->user())
        return view('home', [
            'petitions' => $petitions,
        ]);
    else {

        return view('welcome', [
            'petitions' => $petitions,
        ]);
    }

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
