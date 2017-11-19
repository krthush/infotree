<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use App\Notifications\SendActivationEmail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Tree;
use App\Branch;

class ActivationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function activate($token)
    {
        // find token based on id
        $user = User::where('activation_token', $token)->first();

        if ($user) {

            if (auth()->user()->getAuthIdentifier() === $user->id) {

                // update activation account details
                $user->activation_token = null;
                $user->activated_at = Carbon::now()->format('Y-m-d H:i:s');
                $user->save();

                // login using id
                auth()->loginUsingId($user->id);

                // create first "My Tree" for user
                // if ($user->hasRole('student')) {

                //     $user = auth()->user();
                //     $userID = $user->getAuthIdentifier();
                //     $tree = Tree::where('university',true)->where('shared',true)->where('favourite',true)->first();

                //     $newTree = Tree::create([

                //         'title' => 'My Tree',

                //         'user_id' => auth()->user()->getAuthIdentifier(),

                //         'favourite' => true

                //     ]);

                //     $treeBranches = Branch::where('tree_id',$tree->id)->get();

                //     foreach ($treeBranches as $branch) {
                //         $newBranch = $branch->replicate();
                //         $newBranch->user_id = $userID;
                //         $newBranch->tree_id = $newTree->id;
                //         $newBranch->parent_id = $branch->id;
                //         $newBranch->parent_orig_id = $branch->parent_id;
                //         $newBranch->save();
                //     }            

                //     $newBranches = Branch::where('tree_id',$newTree->id)->orderBy('id','desc')->get();

                //     foreach ($newBranches as $newBranch) {
                //         $parent = Branch::where('tree_id',$newTree->id)->where('parent_id','=',$newBranch->parent_orig_id)->first();
                //         if ($parent) {
                //             $newBranch->parent_id = $parent->id;
                //             $newBranch->save();
                //         }
                //     }

                //     Branch::where('tree_id',$newTree->id)->where('parent_orig_id','=',0)->update([

                //         'parent_id' => 0

                //     ]);

                //     Branch::where('tree_id',$newTree->id)->update([

                //         'parent_orig_id' => null

                //     ]);
                    
                // }

                // redirect to home
                return redirect('/home');

            }

        } elseif (auth()->user()->activation_token==null) {

            return redirect(route('welcome'))->withErrors([

                'You have already activated your account.'

            ]);

        } else {

            return redirect(route('welcome'))->withErrors('Invalid token provided.');

        }
    }

    public function request()
    {
        if (auth()->user()->activation_token==null) {

            return redirect(route('welcome'))->withErrors([

                'You have already activated your account.'

            ]);

        } else {

            return view('auth.activation');

        }
    }

    public function resend()
    {

        $this->validate(request(), [
            'email' => 'required',
        ]);

        $user = User::where('email', request('email'))->first();

        if ($user) {

            if (auth()->user()->getAuthIdentifier() === $user->id) {

                if (auth()->user()->activation_token==null) {

                    return redirect(route('welcome'))->withErrors([

                        'You have already activated your account.'

                    ]);

                } else {

                    $token = str_random(64);
                    $user->activation_token = $token;
                    $user->save();

                    // send notification
                    $user->notify(
                        new SendActivationEmail($token)
                    );

                    return redirect()->route('account.activation.request')->with('success', 'Please check your email for activation link.');

                }

            } else {

                return back()->withErrors([
                    'Invalid email provided.'
                ]);

            } 

        } else {

            return back()->withErrors([
                'Invalid email provided.'
            ]);

        }

    }    
}