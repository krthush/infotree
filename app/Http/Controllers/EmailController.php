<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','active']);
    }

	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    function show() {
	 	$user = auth()->user();
        $userID = $user->getAuthIdentifier();

        if ($userID === 1) {
        	return view('emails');
        } else {
        	return redirect(route('welcome'))->withErrors(['This page is not for you!']);
        }

    }

    function alpha(Request $request) {

        $this->validate(request(), [
                'email' => 'required',
        ]);

     	$user = auth()->user();
        $userID = $user->getAuthIdentifier();

        if ($userID === 1) {

        	DB::table('emails')->insert([

        		'email' => request('email'),

        	]);

        	return back()->with('success','Alpha email success');

        } else {
        	return redirect(route('welcome'))->withErrors(['This page is not for you!']);
        }

    }

    function add(Request $request) {

        $this->validate(request(), [
                'email' => 'required|exists:users,email',
        ]);

     	$user = auth()->user();
        $userID = $user->getAuthIdentifier();

        if ($userID === 1) {

        	$newAdmin = User::where('email', request('email'))->first();

        	$newAdmin->assignRole('admin');


        	return back()->with('success','Add Admin email success');

        } else {
        	return redirect(route('welcome'))->withErrors(['This page is not for you!']);
        }

    }

    function remove(Request $request) {

        $this->validate(request(), [
                'email' => 'required|exists:users,email',
        ]);

     	$user = auth()->user();
        $userID = $user->getAuthIdentifier();

        if ($userID === 1) {

        	$oldAdmin = User::where('email', request('email'))->first();

        	$oldAdmin->removeRole('admin');

        	return back()->with('success','Remove Admin email success');

        } else {
        	return redirect(route('welcome'))->withErrors(['This page is not for you!']);
        }

    }

    function ban(Request $request) {

        $this->validate(request(), [
                'email' => 'required|exists:users,email',
        ]);

     	$user = auth()->user();
        $userID = $user->getAuthIdentifier();

        if ($userID === 1) {

        	$banUser = User::where('email', request('email'))->first();

        	$banUser->ban();

        	return back()->with('success','Ban email success');

        } else {
        	return redirect(route('welcome'))->withErrors(['This page is not for you!']);
        }

    }

    function unban(Request $request) {

        $this->validate(request(), [
                'email' => 'required|exists:users,email',
        ]);

     	$user = auth()->user();
        $userID = $user->getAuthIdentifier();

        if ($userID === 1) {

        	$unbanUser = User::where('email', request('email'))->first();

        	$unbanUser->unban();

        	return back()->with('success','Unban email success');

        } else {
        	return redirect(route('welcome'))->withErrors(['This page is not for you!']);
        }

    }

}
