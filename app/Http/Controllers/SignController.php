<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SignController extends Controller
{
    public function newSign($user, $petition){
        DB::table('petitionuser')->insert(array(
           'users_id' => $user,
            'petition_id' => $petition,
        ));
        $petitions = DB::table('petitions')->get();
        return view('welcome', [
            'petitions' => $petitions,
        ]);
    }
}
