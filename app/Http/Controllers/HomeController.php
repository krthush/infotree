<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tree;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','active','forbid-banned-user']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view('index');
    }

    public function home() 
    {

        if (auth()->user()) {

            $user = auth()->user();
            $userID = $user->getAuthIdentifier();

            $myTree = Tree::where('user_id',$userID)->where('favourite',true)->first();

            return redirect(route('tree', $myTree->id));

        }

        $topTree = Tree::where('shared',true)->where('university','!=',true)->orderBy('likes','desc')->first();
        return redirect(route('tree', $topTree->id));
    }
}
