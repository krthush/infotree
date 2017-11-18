<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Tree;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','active','forbid-banned-user']);
    }

	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */



    public function likeTree(Tree $tree)
    {
        // here you can check if product exists or is valid or whatever
    	if($tree) {

    		if ($tree->shared === 1) {

		        $this->handleLike('App\Tree', $tree->id);

		        $tree->update([

		        	'likes' => $tree->likes()->count()

		        ]);

		        return redirect()->back()->with('success', 'Your opinion was registered!');

    		} else {
    			return back()->withErrors(['You can only like shared trees!']);
    		}

    	} else {
			return back()->withErrors(['Tree does not exist!']);
        }
    }

    public function handleLike($type, $id)
    {
        $existing_like = Like::withTrashed()->whereLikeableType($type)->whereLikeableId($id)->whereUserId(Auth::id())->first();

        if (is_null($existing_like)) {
            Like::create([
                'user_id'       => Auth::id(),
                'likeable_id'   => $id,
                'likeable_type' => $type,
            ]);
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
            } else {
                $existing_like->restore();
            }
        }
    }
}