<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetitionController extends Controller
{
    public function viewPetition($petition){

        $authenticated = auth()->user()->id;
        $signed = false;
        $sign = DB::table('petitionuser')->where('petition_id', $petition)->get();
        foreach($sign as $s){
            if($s->users_id == $authenticated){
                $signed = true;
            }
        }

        $count = DB::table('petitionuser')->where('petition_id', $petition)->count();
        $petitionView = DB::table('petitions')->where('id', $petition)->first();
        $user = DB::table('users')->where('id', $petitionView->users_id)->first();

        return view('petition', [
            'petition' => $petitionView,
            'user' => $user,
            'count' => $count,
            'signed' => $signed
        ]);

    }

    public function deletePetition($petition){
        DB::table('petitionuser')->where('petition_id', $petition)->delete();
        DB::table('petitions')->where('id', $petition)->delete();

        $petitions = DB::table('petitions')->get();
        return view('welcome', [
            'petitions' => $petitions,
        ]);

    }
}
