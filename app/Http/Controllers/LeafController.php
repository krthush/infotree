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

        $userID = auth()->user()->getAuthIdentifier();

        if ($branch->user_id === $userID) {

            Leaf::create([

                'title' => request('title'),

                'link' => request('link'),

                'user_id' => auth()->user()->getAuthIdentifier(),

                'parent_id' => $branch->id,

                'tree_id' => $branch->tree_id,

                'type' => request('type')

            ]);

            return back()->with('success', 'New content added successfully.');

        } elseif ($user->hasRole('admin')) {

            Leaf::create([

                'title' => request('title'),

                'link' => request('link'),

                'user_id' => auth()->user()->getAuthIdentifier(),

                'parent_id' => $branch->id,

                'tree_id' => $branch->tree_id,

                'type' => request('type')

            ]);

            return redirect(route('home'))->with('success', 'New content added successfully.');

        } else {

            return redirect(route('home'))->withErrors(['This branch is not yours to edit!']);

        }

    }

    public function destroy(Branch $branch) {

        $this->validate(request(), [
                'id' => 'required',
        ]);

        $userID = auth()->user()->getAuthIdentifier();

        if ($branch->user_id === $userID) {

            Leaf::where('id',request('id'))->delete();

            return back()->with('success', 'Content deleted successfully.');

        } elseif ($user->hasRole('admin')) {

            Leaf::where('id',request('id'))->delete();

            return redirect(route('home'))->with('success', 'Content deleted successfully.');
            
        } else {

            return redirect(route('home'))->withErrors(['This branch is not yours to edit!']);

        }

    }

    // Branch related methods
    public function show(Branch $branch) {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();
        $id = $branch->id;
        $parent_id = $branch->parent_id;

        $infoContents = Leaf::where('parent_id',$id)->where('type','edu')->get();
        $infoTutorials = Leaf::where('parent_id',$id)->where('type','tut')->get();
        $infoVideos = Leaf::where('parent_id',$id)->where('type','vid')->get();
        $infoContentAdds = Leaf::where('parent_id',$id)->where('type','add')->get();

        $allInfoContents = Leaf::where('parent_id',$id)->where('type','edu')->pluck('title','id')->all();
        $allInfoTutorials = Leaf::where('parent_id',$id)->where('type','tut')->pluck('title','id')->all();
        $allInfoVideos = Leaf::where('parent_id',$id)->where('type','vid')->pluck('title','id')->all();
        $allInfoContentAdds = Leaf::where('parent_id',$id)->where('type','add')->pluck('title','id')->all();

        $parents = Branch::where('id',$parent_id)->get();
        $children = Branch::where('parent_id',$id)->get();



        if ($branch->facts == '' ) {
            $empty = 1;
        } else {
            $empty = 0;
        }       


        if ($branch->user_id === $userID) {

            $edit = 'edit';
            $stack = 'stack';

            return view(
                'tree.leaves',
                compact(
                    'branch',
                    'infoContents',
                    'infoTutorials',
                    'infoVideos',
                    'infoContentAdds',
                    'allInfoContents',
                    'allInfoTutorials',
                    'allInfoVideos',
                    'allInfoContentAdds',
                    'parents',
                    'children',
                    'edit',
                    'stack',
                    'empty'
                )
            );

        } elseif ($user->hasRole('admin')) {

            $edit = 'edit';
            $stack = 'stack';

            return view(
                'tree.leaves',
                compact(
                    'branch',
                    'infoContents',
                    'infoTutorials',
                    'infoVideos',
                    'infoContentAdds',
                    'allInfoContents',
                    'allInfoTutorials',
                    'allInfoVideos',
                    'allInfoContentAdds',
                    'parents',
                    'children',
                    'edit',
                    'stack',
                    'empty'
                )
            );

        } elseif ($branch->shared === 1) {

            if (is_null($branch->facts)) {
                $stack = '';
            } else {
                $stack = 'stack';
            }

            $edit = '';

            return view(
                'tree.leaves',
                compact(
                    'branch',
                    'infoContents',
                    'infoTutorials',
                    'infoVideos',
                    'infoContentAdds',
                    'allInfoContents',
                    'allInfoTutorials',
                    'allInfoVideos',
                    'allInfoContentAdds',
                    'parents',
                    'children',
                    'edit',
                    'stack',
                    'empty'
                )
            );
            
        } else {

            return redirect(route('home'))->withErrors(['This branch is not yours to view!']);
            
        }
    }

    public function update(Branch $branch) {

        $this->validate(request(), [
                'body' => 'max:65535',
        ]);

        $userID = auth()->user()->getAuthIdentifier();

        if ($branch->user_id === $userID) {
            
            Branch::where('id',$branch->id)->update([

                'facts' => request('body'),

            ]);

            return back()->with('success', 'Facts edited successfully.');

        } elseif ($user->hasRole('admin')) {

            Branch::where('id',$branch->id)->update([

                'facts' => request('body'),

            ]);

            return back()->with('success', 'Facts edited successfully.');
            
        } else {

            return redirect(route('home'))->withErrors(['This branch is not yours to edit!']);

        }

    }     	
}
