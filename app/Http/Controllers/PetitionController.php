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

        //We get the user to check if it has already sign the petition
        $authenticated = auth()->user()->id;
        $signed = false;
        $sign = DB::table('petitionuser')->where('petition_id', $petition)->get();

        //Checking all the cases to see if the user had signed the petition
        foreach($sign as $s){
            if($s->users_id == $authenticated){
                $signed = true;
            }
        }

        //Count of all of the signatures that the petition has
        $count = DB::table('petitionuser')->where('petition_id', $petition)->count();

        //Fetching the petition that we asked to see
        $petitionView = DB::table('petitions')->where('id', $petition)->first();

        //Fetching the user that created that petition. In normal cases, I would use the eloquent relation for this
        //but the case of BelongsTo isn't working properly in laravel, so I had to use this way.
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
        //First we delete all the child in petitionUser table so it won't crash
        DB::table('petitionuser')->where('petition_id', $petition)->delete();
        DB::table('petitions')->where('id', $petition)->delete();

        $petitions = DB::table('petitions')->get();
        return view('welcome', [
            'petitions' => $petitions,
        ]);

    }

    //Edit petition function
    public function editPetition($petition, EditPetitionRequest $request){
        //Check that our data is good with Request and saving it on the function in request.
        $request->editPetition($petition);

        //To show Home view, we fetch the petitions of the user and pass it to the view
        $user = auth()->user();
        $petitions = DB::table('petitions')
            ->where('users_id', $user->id)->get();
        return view('home', [
            'petitions' => $petitions,
        ]);

    }

    //Function to show the edit petition form
    public function showEditPetition($petition){
        $petitions = DB::table('petitions')->where('id', $petition)->first();
        return view('editPetition',[
            'petition' => $petitions,
        ]);
    }

    //Function to show the new petition form
    public function showNewPetition(){
        return view('newPetition');
    }

    //Function to create a new petition and save it in the database
    public function newPetition(CreatePetitionRequest $request){

        //We check all the data in the request class and save it in that function
        $request->createPetition();

        $user = auth()->user();
        $petitions = DB::table('petitions')
            ->where('users_id', $user->id)->get();
        return view('home', [
            'petitions' => $petitions,
        ]);

    }
}
