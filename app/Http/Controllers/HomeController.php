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
        if (auth()->check()) {

            return view('home');
        } else {
            return redirect(route('welcome'));
        }
    }

}
