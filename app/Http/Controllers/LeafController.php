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

        // the tree which this leaf's branch belongs to, i.e. the leaf's tree
        $tree = Tree::where('id',$branch->tree_id)->first();
        // the user's favourite tree
        $myTree = Tree::where('user_id',$userID)->where('favourite',true)->first();

        if ($myTree) {
            // find all parents of myTree
            $arrayOfTreeIDs = $myTree->parents->pluck('id')->toArray();
        }

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

        } elseif (in_array($tree->id, $arrayOfTreeIDs)) {
            // check if tree is a parent of myTree    
            // if user's favourite tree belongs (is in hierachy) to current tree, make leaf inside favourite tree

            Leaf::create([

                'title' => request('title'),

                'link' => request('link'),

                'user_id' => auth()->user()->getAuthIdentifier(),

                'parent_id' => $branch->id,

                'tree_id' => $myTree->id,

                'type' => request('type')

            ]);

            return back()->with('success', 'New content added successfully.');
                
        } else {

            return back()->withErrors([
                'You cannot edit this branch.',
                'Please create a new linked tree and favourite it to add personal edits!'
            ]);

        }

    }

    public function destroy(Branch $branch) {

        $this->validate(request(), [
                'id' => 'required',
        ]);

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        // leaf that is being deleted
        $leaf = Leaf::findOrFail(request('id'));

        if ($leaf->user_id === $userID || $user->hasRole('admin') || $tree->global === 1) {

            Leaf::where('id',request('id'))->delete();

            return back()->with('success', 'Content deleted successfully.');
                   
        } else {

            return back()->withErrors([
                'You can only delete your own leaves.',
                'Please create a separate tree to "unlink" branches.'
            ]);

        }

    }

    public function rename(Branch $branch) {

        $this->validate(request(), [
                'title' => 'required',
                'id' => 'required'
        ]);

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        // leaf that is being renamed
        $leaf = Leaf::findOrFail(request('id'));

        if ($leaf->user_id === $userID || $user->hasRole('admin') || $tree->global === 1) {

            Leaf::where('id', request()->id)->update([

                'title' => request('title'),

            ]);

            return back()->with('success', 'Name edited successfully.');

        } else {

            return back()->withErrors([
                'You can only rename your own leaves.',
                'Please create a separate tree to "unlink" branches.'
            ]);
        }

    }



    // Branch related methods
    public function show(Branch $branch) {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        $id = $branch->id;

        // the tree which this leaf's branch belongs to, i.e. the leaf's tree
        $tree = Tree::where('id',$branch->tree_id)->first();
        // the user's favourite tree
        $myTree = Tree::where('user_id',$userID)->where('favourite',true)->first();


        if ($myTree) {
            // find all parents of myTree
            $arrayOfTreeIDs = $myTree->parents->pluck('id')->toArray();
            // check if tree is a parent of myTree
            if (in_array($tree->id, $arrayOfTreeIDs)) {
                // if user's favourite tree belongs (is in hierachy) to current tree, make that tree to now follow from
                $tree=$myTree;
            }
        }

        // array including current tree and all its parents, SEE getParentsAttribute() TREE MODEL
        $arrayOfTreeIDs = $tree->parents->pluck('id')->toArray();
        array_push($arrayOfTreeIDs, $tree->id);
        // branches to contain all branches of all trees - main tree then its heirachy upwards
        $branches = Branch::whereIn('tree_id', $arrayOfTreeIDs)->where('parent_id',0)->get();

        $childBranches = Branch::whereIn('tree_id', $arrayOfTreeIDs)->where('parent_id', $branch->id)->get();

        // Note $infoContents is used with isset() for leftSidebar to identify a 'leaf' page
        $infoContents = Leaf::where('parent_id',$id)->whereIn('tree_id', $arrayOfTreeIDs)->where('type','edu')->get();
        $infoTutorials = Leaf::where('parent_id',$id)->whereIn('tree_id', $arrayOfTreeIDs)->where('type','tut')->get();
        $infoVideos = Leaf::where('parent_id',$id)->whereIn('tree_id', $arrayOfTreeIDs)->where('type','vid')->get();
        $infoContentAdds = Leaf::where('parent_id',$id)->whereIn('tree_id', $arrayOfTreeIDs)->where('type','add')->get();

        $allInfoContents = Leaf::where('parent_id',$id)->whereIn('tree_id', $arrayOfTreeIDs)->where('type','edu')->pluck('title','id')->all();
        $allInfoTutorials = Leaf::where('parent_id',$id)->whereIn('tree_id', $arrayOfTreeIDs)->where('type','tut')->pluck('title','id')->all();
        $allInfoVideos = Leaf::where('parent_id',$id)->whereIn('tree_id', $arrayOfTreeIDs)->where('type','vid')->pluck('title','id')->all();
        $allInfoContentAdds = Leaf::where('parent_id',$id)->whereIn('tree_id', $arrayOfTreeIDs)->where('type','add')->pluck('title','id')->all();

        if ($branch->facts == '' ) {
            $empty = 1;
        } else {
            $empty = 0;
        }

        if ($branch->user_id === $userID || $user->hasRole('admin') || $tree->global === 1 || $branch->shared === 1) {

            return view(
                'tree.leaves',
                compact(
                    'tree',
                    'branch',
                    'arrayOfTreeIDs',
                    'branches',
                    'childBranches',
                    'infoContents',
                    'infoTutorials',
                    'infoVideos',
                    'infoContentAdds',
                    'allInfoContents',
                    'allInfoTutorials',
                    'allInfoVideos',
                    'allInfoContentAdds',
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

            return back()->withErrors([
                'You can only edit facts for your own branches.',
                'Please create a separate tree to "unlink" branches.'
            ]);

        }

    }

    public function search(Request $request) {

        if($request->ajax()) {

            $leaves=Leaf::where('tree_id',$request->treeId)->where('title', 'like', '%' . $request->search . '%')->limit(50)->get();

            return $leaves;
        }

    }

}
