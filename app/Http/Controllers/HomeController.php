<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        //We get the user logged in with Auth to get all the petitions that user had created and pass it to the view
        $user = auth()->user();
        $petitions = DB::table('petitions')
                        ->where('users_id', $user->id)->get();
        return view('home', [
            'petitions' => $petitions,
        ]);
    }
}
