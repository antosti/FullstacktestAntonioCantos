<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePetitionRequest;
use App\Http\Requests\EditPetitionRequest;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetitionController extends Controller
{
    //View petition function
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

    //Delete petition function
    public function deletePetition($petition){
        DB::table('petitionuser')->where('petition_id', $petition)->delete();
        DB::table('petitions')->where('id', $petition)->delete();

        $petitions = DB::table('petitions')->get();
        return view('welcome', [
            'petitions' => $petitions,
        ]);

    }

    //Edit petition function
    public function editPetition($petition, EditPetitionRequest $request){
        $request->editPetition($petition);
        $user = auth()->user();
        $petitions = DB::table('petitions')
            ->where('users_id', $user->id)->get();
        return view('home', [
            'petitions' => $petitions,
        ]);

    }

    public function showEditPetition($petition){
        $petitions = DB::table('petitions')->where('id', $petition)->first();
        return view('editPetition',[
            'petition' => $petitions,
        ]);
    }

    public function showNewPetition(){
        return view('newPetition');
    }

    public function newPetition(CreatePetitionRequest $request){

        $request->createPetition();
        $user = auth()->user();
        $petitions = DB::table('petitions')
            ->where('users_id', $user->id)->get();
        return view('home', [
            'petitions' => $petitions,
        ]);

    }
}
