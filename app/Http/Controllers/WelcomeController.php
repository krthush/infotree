<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tree;
use App\User;

class WelcomeController extends Controller
{
    public function welcome()
    {
        if (auth()->check()) {

            return redirect(route('home'));

        } else {

            return view('welcome');
            
        }
    }
}
