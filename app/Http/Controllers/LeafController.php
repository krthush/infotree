<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Branch;
use App\Leaf;
use App\Tree;
use App\User;

class LeafController extends Controller
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

    public function store(Branch $branch) {
        
        $this->validate(request(), [
                'title' => 'required',
                'link' => 'required'
        ]);

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();
        $tree = Tree::where('id',$branch->tree_id)->first();

        if ($branch->user_id === $userID || $user->hasRole('admin') || $tree->global === 1) {

            Leaf::create([

                'title' => request('title'),

                'link' => request('link'),

                'user_id' => auth()->user()->getAuthIdentifier(),

                'parent_id' => $branch->id,

                'tree_id' => $branch->tree_id,

                'type' => request('type')

            ]);

            return back()->with('success', 'New content added successfully.');

        } else {

            return redirect(route('home'))->withErrors(['This branch is not yours to edit!']);

        }

    }

    public function destroy(Branch $branch) {

        $this->validate(request(), [
                'id' => 'required',
        ]);

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();
        $tree = Tree::where('id',$branch->tree_id)->first();

        if ($branch->user_id === $userID || $user->hasRole('admin') || $tree->global === 1) {

            Leaf::where('id',request('id'))->delete();

            return back()->with('success', 'Content deleted successfully.');
            
        } else {

            return redirect(route('home'))->withErrors(['This branch is not yours to edit!']);

        }

    }

    public function rename(Branch $branch) {

        $this->validate(request(), [
                'title' => 'required',
                'id' => 'required'
        ]);

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();
        $tree = Tree::where('id',$branch->tree_id)->first();

        if ($branch->user_id === $userID || $user->hasRole('admin') || $tree->global === 1) {

            Leaf::where('id', request()->id)->update([

                'title' => request('title'),

            ]);

            return back()->with('success', 'Name edited successfully.');

        } else {
            return back()->withErrors([
                'You can only edit your own branches.',
                'Please create a new clone tree and do your edits there!'
            ]);
        }

    }



    // Branch related methods
    public function show(Branch $branch) {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();
        $tree = Tree::where('id',$branch->tree_id)->first();
        $branches = Branch::where('tree_id',$tree->id)->where('parent_id',0)->get();
        $id = $branch->id;
        $parent_id = $branch->parent_id;

        // Note $infoContents is used with isset() for leftSidebar to identify a 'leaf' page
        $infoContents = Leaf::where('parent_id',$id)->where('type','edu')->get();
        $infoTutorials = Leaf::where('parent_id',$id)->where('type','tut')->get();
        $infoVideos = Leaf::where('parent_id',$id)->where('type','vid')->get();
        $infoContentAdds = Leaf::where('parent_id',$id)->where('type','add')->get();

        $allInfoContents = Leaf::where('parent_id',$id)->where('type','edu')->pluck('title','id')->all();
        $allInfoTutorials = Leaf::where('parent_id',$id)->where('type','tut')->pluck('title','id')->all();
        $allInfoVideos = Leaf::where('parent_id',$id)->where('type','vid')->pluck('title','id')->all();
        $allInfoContentAdds = Leaf::where('parent_id',$id)->where('type','add')->pluck('title','id')->all();

        if ($branch->facts == '' ) {
            $empty = 1;
        } else {
            $empty = 0;
        }

        if ($branch->user_id === $userID || $user->hasRole('admin') || $tree->global === 1) {

            $edit = 'edit';

            return view(
                'tree.leaves',
                compact(
                    'tree',
                    'branch',
                    'branches',
                    'infoContents',
                    'infoTutorials',
                    'infoVideos',
                    'infoContentAdds',
                    'allInfoContents',
                    'allInfoTutorials',
                    'allInfoVideos',
                    'allInfoContentAdds',
                    'edit',
                    'empty'
                )
            );

        } elseif ($branch->shared === 1) {

            $edit = '';

            return view(
                'tree.leaves',
                compact(
                    'tree',
                    'branch',
                    'branches',
                    'infoContents',
                    'infoTutorials',
                    'infoVideos',
                    'infoContentAdds',
                    'allInfoContents',
                    'allInfoTutorials',
                    'allInfoVideos',
                    'allInfoContentAdds',
                    'edit',
                    'empty'
                )
            );
            
        } else {

            return redirect(route('home'))->withErrors(['This branch is not yours to view!']);
            
        }
    }

    public function fact(Branch $branch) {

        $this->validate(request(), [
                'body' => 'max:65535',
        ]);

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();
        $tree = Tree::where('id',$branch->tree_id)->first();

        if ($branch->user_id === $userID || $user->hasRole('admin') || $tree->global === 1) {
            
            Branch::where('id',$branch->id)->update([

                'facts' => request('body'),

            ]);

            return back()->with('success', 'Facts edited successfully.');
            
        } else {

            return redirect(route('home'))->withErrors(['This branch is not yours to edit!']);

        }

    }     	
}
