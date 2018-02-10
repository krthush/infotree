<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Branch;
use App\Tree;
use App\User;
use App\Leaf;

class TreeController extends Controller
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


    public function mytree() {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        $myTree = Tree::where('user_id',$userID)->where('favourite',true)->first();
        $uniTree = Tree::where('university',true)->where('shared',true)->where('favourite',true)->first();

        if ($myTree) {
            return redirect(route('tree', $myTree));
        } else {
            $topTree = \App\Tree::where('shared',true)->where('university','!=',true)->orderBy('likes','desc')->first();
            return redirect(route('tree', $topTree->id))->withErrors(['You have no favourite tree, please create or select one!']);
        }

    }

    public function all() {

        $allSharedTrees = Tree::where('shared',true)->orderBy('likes','desc')->get();

        return view(
            'trees',
            compact(
                'tree',
                'allSharedTrees'
            )
        );

    }

    public function show(Tree $tree) {     

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        //include current tree and all its parents, SEE getParentsAttribute() TREE MODEL
        $arrayOfTreeIDs = $tree->parents->pluck('id')->toArray();
        array_push($arrayOfTreeIDs, $tree->id);
        // branches to contain all branches of all trees - main tree then its heirachy upwards
        $branches = Branch::whereIn('tree_id', $arrayOfTreeIDs)->where('parent_id',0)->get();

        $global = $tree->global;
        $shared = $tree->shared;

        if ($tree->description == '' ) {
            $empty = 1;
        } else {
            $empty = 0;
        }

        $selectUserTrees=Tree::where('user_id',$userID)->pluck('title','id')->all();

        $favourite=Tree::where('user_id',$userID)->where('favourite', 1)->first();

        if ($favourite) {
            $favouriteID = $favourite->id;
        } else {
            $favouriteID = 0;
        }

    	if ($tree->user_id === $userID || $user->hasRole('admin')) {

    		$edit = 1;

    		return view(
	            'tree.branches',
	            compact(
	                'tree',
                    'arrayOfTreeIDs',
                    'selectUserTrees',
	                'branches',
                    'empty',
	            	'edit',
	            	'shared',
                    'favouriteID',
                    'global'
	            )
	        );

        } elseif ($shared === 1) {

        	$edit = 0;

        	return view(
	            'tree.branches',
	            compact(
	                'tree',
                    'arrayOfTreeIDs',
                    'selectUserTrees',
	                'branches',
                    'empty',
	            	'edit',
	            	'shared',
                    'favouriteID',
                    'global'
	            )
	        );
            
        } else {

            return back()->withErrors(['This tree is not yours to view!']);

        }
    }

	public function store(Request $request) {

        $this->validate(request(), [
                'title' => 'required',
        ]);

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        if ($userID === 1) {

	        $tree = Tree::create([

	            'title' => request('title'),

	            'user_id' => auth()->user()->getAuthIdentifier(),

                'university' => true

	        ]);

	        $insertedId = $tree->id;

	        return redirect(route('tree', $insertedId))->with('success', 'New Uni Tree added successfully.');
            
        } else {

	        $tree = Tree::create([

	            'title' => request('title'),

	            'user_id' => auth()->user()->getAuthIdentifier()

	        ]);

	        $insertedId = $tree->id;

	        return redirect(route('tree', $insertedId))->with('success', 'New Tree added successfully.');

        }

    }

    public function destroy(Request $request) {

        $customMessages = [
            'required' => 'Please select a tree to delete.'
        ];

        $this->validate(request(), [
            'id' => 'required',
        ],$customMessages);

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        $tree = Tree::findOrFail(request()->id);
        $tree_id = request()->id;

        // Getting all children ids of Tree being deleted
        $array_of_ids = $this->getChildren($tree);
        // Appending the parent category id
        array_push($array_of_ids, request()->id);


        if ($tree->user_id === $userID || $user->hasRole('admin')) {

            Branch::whereIn('tree_id',$array_of_ids)->delete();
            Leaf::whereIn('tree_id',$array_of_ids)->delete();
            Tree::whereIn('id',$array_of_ids)->delete();

            return redirect(route('home'))->with('success', 'Tree has been deleted');

        } else {

            return back()->withErrors([
                'You can only delete your own trees.'
            ]);

        }

    }

    // for destroy function
    private function getChildren($tree) {
        $ids = [];
        foreach ($tree->childs as $tre) {
            $ids[] = $tre->id;
            $ids = array_merge($ids, $this->getChildren($tre));
        }
        return $ids;
    }

    public function link(Tree $tree) {

        $this->validate(request(), [
                'title' => 'required',
        ]);

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        if ($userID === 1) {
            $university = true;
        } else {
            $university = false;
        }

        $newTree = Tree::create([

            'title' => request('title'),

            'user_id' => $userID,

            'university' => $university,

            'parent_id' => $tree->id

        ]);

        $insertedId = $newTree->id;

        if ($university === true) {
            return redirect(route('tree', $insertedId))->with('success', 'New linked uni tree added successfully.');
        } else {
            return redirect(route('tree', $insertedId))->with('success', 'New linked tree added successfully.');
        }
            
    }
    
    /* not very efficient code -> long load time */
    public function clone(Tree $tree) {

        $this->validate(request(), [
                'title' => 'required',
        ]);

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        if ($userID === 1) {
            $university = true;
        } else {
            $university = false;
        }

        $newTree = Tree::create([
            'title' => request('title'),
            'user_id' => $userID,
            'university' => $university
        ]);

        //include current tree and all its parents, SEE getParentsAttribute() TREE MODEL
        $arrayOfTreeIDs = $tree->parents->pluck('id')->toArray();
        array_push($arrayOfTreeIDs, $tree->id);
        // branches to contain all branches of all trees - main tree then its heirachy upwards
        $treeBranches = Branch::whereIn('tree_id', $arrayOfTreeIDs)->get();
        $treeLeaves = Leaf::whereIn('tree_id', $arrayOfTreeIDs)->get();

        foreach ($treeBranches as $branch) {
            $newBranch = $branch->replicate();
            $newBranch->user_id = $userID;
            $newBranch->tree_id = $newTree->id;
            $newBranch->parent_id = $branch->id;
            $newBranch->parent_orig_id = $branch->parent_id;
            $newBranch->save();
        }         

        foreach ($treeLeaves as $leaf) {
            $newLeaf = $leaf->replicate();
            $newLeaf->user_id = $userID;
            $newLeaf->tree_id = $newTree->id;
            $newLeaf->save();
        }

        $newLeaves = Leaf::where('tree_id',$newTree->id)->get();
        $newBranches = Branch::where('tree_id',$newTree->id)->orderBy('id','desc')->get();

        foreach ($newLeaves as $newLeaf) {
            $parent = Branch::where('tree_id',$newTree->id)->where('parent_id','=',$newLeaf->parent_id)->first();
            if ($parent) {
                $newLeaf->parent_id = $parent->id;
                $newLeaf->save();
            }
        }

        foreach ($newBranches as $newBranch) {
            $parent = Branch::where('tree_id',$newTree->id)->where('parent_id','=',$newBranch->parent_orig_id)->first();
            if ($parent) {
                $newBranch->parent_id = $parent->id;
                $newBranch->save();
            }
        }

        Branch::where('tree_id',$newTree->id)->where('parent_orig_id','=',0)->update([

            'parent_id' => 0

        ]);

        Branch::where('tree_id',$newTree->id)->update([

            'parent_orig_id' => 0

        ]);

        $insertedId = $newTree->id;

        if ($university === true) {
            return redirect(route('tree', $insertedId))->with('success', 'New cloned uni tree added successfully.');
        } else {
            return redirect(route('tree', $insertedId))->with('success', 'New cloned tree added successfully.');
        }
            
    }

    /* Somewhat unelegant code based on clone code, wasted time creating pseudo new tree */
    public function add(Tree $tree) {

        $customMessages = [
            'required' => 'Please select a tree to add to.'
        ];

        $this->validate(request(), [
                'userTreeId' => 'required'
        ], $customMessages);

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        $addTree = Tree::findOrFail(request('userTreeId'));

        $addTreeId = $addTree->id;

        $pseudoTree = Tree::create([

            'title' => 'pseudo',

            'user_id' => $userID,

        ]);

        $treeBranches = Branch::where('tree_id',$tree->id)->get();
        $treeLeaves = Leaf::where('tree_id', $tree->id)->get();

        foreach ($treeBranches as $branch) {
            $newBranch = $branch->replicate();
            $newBranch->user_id = $userID;
            $newBranch->tree_id = $pseudoTree->id;
            $newBranch->parent_id = $branch->id;
            $newBranch->parent_orig_id = $branch->parent_id;
            $newBranch->save();

        }            

        foreach ($treeLeaves as $leaf) {
            $newLeaf = $leaf->replicate();
            $newLeaf->user_id = $userID;
            $newLeaf->tree_id = $pseudoTree->id;
            $newLeaf->save();
        }

        $newLeaves = Leaf::where('tree_id',$pseudoTree->id)->get();

        $newBranches = Branch::where('tree_id',$pseudoTree->id)->orderBy('id','desc')->get();

        foreach ($newLeaves as $newLeaf) {

            $parent = Branch::where('tree_id',$pseudoTree->id)->where('parent_id','=',$newLeaf->parent_id)->first();
            if ($parent) {
                $newLeaf->parent_id = $parent->id;
                $newLeaf->save();
            }

        }

        foreach ($newBranches as $newBranch) {

            $parent = Branch::where('tree_id',$pseudoTree->id)->where('parent_id','=',$newBranch->parent_orig_id)->first();

            if ($parent) {
                $newBranch->parent_id = $parent->id;
                $newBranch->save();
            }

        }

        Branch::where('tree_id',$pseudoTree->id)->where('parent_orig_id','=',0)->update([

            'parent_id' => 0

        ]);

        Leaf::where('tree_id',$pseudoTree->id)->update([

            'tree_id' => $addTreeId

        ]);

        Branch::where('tree_id',$pseudoTree->id)->update([

            'parent_orig_id' => 0,

            'tree_id' => $addTreeId

        ]);

        $pseudoTree->delete();

        return redirect(route('tree', $addTreeId))->with('success', 'Selected tree successfully added to this tree.');
        
    }

    public function favourite(Tree $tree) {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        $this->validate(request(), [
            'id' => 'required',
        ]);

        if ($tree->user_id === $userID) {

            Tree::where('user_id',$userID)->update([

                'favourite' => false

            ]);

            Tree::where('id',request('id'))->update([

                'favourite' => true

            ]);

            return back()->with('success', 'Tree has been favourited.');

        } else {

            if ($userID === 1) {
                $university = true;
            } else {
                $university = false;
            }

            $newTree = Tree::create([

                'title' => $tree->title,

                'user_id' => $userID,

                'university' => $university,

                'parent_id' => $tree->id

            ]);

            $insertedId = $newTree->id;

            Tree::where('user_id',$userID)->update([

                'favourite' => false

            ]);

            Tree::where('id',$insertedId)->update([

                'favourite' => true

            ]);

            if ($university === true) {
                return redirect(route('tree', $insertedId))->with('success', 'New linked uni tree added and favourited successfully.');
            } else {
                return redirect(route('tree', $insertedId))->with('success', 'New linked tree added and favourited successfully.');
            }
        }

    }

    public function share(Tree $tree) {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        $this->validate(request(), [
            'id' => 'required',
        ]);


        if ($tree->user_id === $userID) {

            if ($tree->shared === 0) {

                Tree::where('id',request('id'))->update([

                    'shared' => true

                ]);

                Branch::where('tree_id',$tree->id)->update([

                    'shared' => true

                ]);

                return back()->with('success', 'Tree has been shared.');

            } else {

                Tree::where('id',request('id'))->update([

                    'shared' => false

                ]);

                Branch::where('tree_id',$tree->id)->update([

                    'shared' => false

                ]);

                return back()->with('success', 'Tree sharing has been stopped.');

            }

        } else {

            return back()->withErrors([
                'You can only share your own trees.'
            ]);

        }

    }

    public function global(Tree $tree) {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        $this->validate(request(), [
            'id' => 'required',
        ]);


        if ($tree->user_id === $userID|| $user->hasRole('admin')) {

            if ($tree->global === 0) {

                Tree::where('id',request('id'))->update([

                    'global' => true

                ]);

                return back()->with('success', 'Access to tree has been made global.');

            } else {

                Tree::where('id',request('id'))->update([

                    'global' => false

                ]);

                return back()->with('success', 'Access to tree restricted to owner.');

            }

        } else {

            return back()->withErrors([
                'You can only edit access of your own trees.'
            ]);

        }

    }    

    public function desc(Tree $tree) {

        $this->validate(request(), [
                'description' => 'max:100'
        ]);
        
        $user = auth()->user();
        $userID = auth()->user()->getAuthIdentifier();

        if ($tree->user_id === $userID || $user->hasRole('admin')) {
            
            Tree::where('id',$tree->id)->update([

                'description' => request('description'),

            ]);

            return back()->with('success', 'Description edited successfully.');

        } else {

            return back()->withErrors([
                'You can only edit the description for your own tree.',
                'Please create a new unlinked tree and do your edits there!'
            ]);

        }

    }

    public function updateName(Tree $tree) {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        $this->validate(request(), [
                'title' => 'required',
                'id' => 'required'
        ]);

        if ($tree->user_id === $userID || $user->hasRole('admin')) {

            Tree::where('id', request()->id)->update([

                'title' => request('title'),

            ]);

            return back()->with('success', 'Name edited successfully.');

        } else {
            return back()->withErrors([
                'You can only edit the name your own branches and tree.',
                'Please create a new unlinked tree and do your edits there!'
            ]);
        }

    }

}
