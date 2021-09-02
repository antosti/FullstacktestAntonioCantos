<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SignController extends Controller
{
    //Function to sign a petition by a user
    public function newSign($user, $petition){
        //Insert the values of the user and the petition that is signin on petitionUser table
        DB::table('petitionuser')->insert(array(
           'users_id' => $user,
            'petition_id' => $petition,
        ));

        //Get all the petitions and show the home of the webpage
        $petitions = DB::table('petitions')->get();
        return view('welcome', [
            'petitions' => $petitions,
        ]);
    }
}
