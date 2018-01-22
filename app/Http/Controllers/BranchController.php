<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Branch;
use App\Leaf;
use App\Tree;
use App\User;

class BranchController extends Controller
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



    // Add related BranchController methods
    public function create(Tree $tree) {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();
        $branches = Branch::where('tree_id',$tree->id)->where('parent_id',0)->get();

        if ($tree->user_id === $userID || $user->hasRole('admin')) {

            return view(
                'tree.add.branches',
                compact(
                    'tree',
                    'branches'
                )
            );

        } else {
            return back()->withErrors([
                'You can only edit your own branches.',
                'Please create a new clone tree and do your edits there!'
            ]);
        }
    }

    public function store(Tree $tree) {

        $this->validate(request(), [
        		'title' => 'required',
        ]);

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();


        if ($tree->user_id === $userID) {

            if (empty(request('parent_id'))) {
                $parent_id = 0;
            } else {
                $parent_id = request('parent_id');
            }

            if ($user->hasRole('admin')) {

                if ($tree->shared===1) {

                    Branch::create([

                        'title' => request('title'),

                        'user_id' => $user->getAuthIdentifier(),

                        'parent_id' => $parent_id,

                        'tree_id' => $tree->id,

                        'university' => true,

                        'shared' => true

                    ]);

                    return back()->with('success', 'New shared uni branch added successfully.');

                } else {

                    Branch::create([

                        'title' => request('title'),

                        'user_id' => $user->getAuthIdentifier(),

                        'parent_id' => $parent_id,

                        'tree_id' => $tree->id,

                        'university' => true

                    ]);

                    return back()->with('success', 'New uni branch added successfully.');

                }
                    
            } elseif($tree->shared===1) {

                Branch::create([

                    'title' => request('title'),

                    'user_id' => $user->getAuthIdentifier(),

                    'parent_id' => $parent_id,

                    'tree_id' => $tree->id,

                    'shared' => true

                ]);

                return back()->with('success', 'New shared branch added successfully.');

            } else {

                Branch::create([

                    'title' => request('title'),

                    'user_id' => $user->getAuthIdentifier(),

                    'parent_id' => $parent_id,

                    'tree_id' => $tree->id

                ]);

                return back()->with('success', 'New branch added successfully.');  
            }

        } elseif ($user->hasRole('admin')) {

            if (empty(request('parent_id'))) {
                $parent_id = 0;
            } else {
                $parent_id = request('parent_id');
            }
                
            if ($tree->shared===1) {

                Branch::create([

                    'title' => request('title'),

                    'user_id' => $user->getAuthIdentifier(),

                    'parent_id' => $parent_id,

                    'tree_id' => $tree->id,

                    'university' => true,

                    'shared' => true

                ]);

                return back()->with('success', 'New shared uni branch added successfully.');

            } else {

                Branch::create([

                    'title' => request('title'),

                    'user_id' => $user->getAuthIdentifier(),

                    'parent_id' => $parent_id,

                    'tree_id' => $tree->id,

                    'university' => true,

                ]);

                return back()->with('success', 'New uni branch added successfully.');

            }
            
        } else {
            return back()->withErrors([
                'You can only edit your own branches.',
                'Please create a new clone tree and do your edits there!'
            ]);
        }

    }



    // Delete related BranchController methods
    public function delete(Tree $tree) {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();
        $branches = Branch::where('tree_id',$tree->id)->where('parent_id',0)->get();

        if ($tree->user_id === $userID || $user->hasRole('admin')) {

            return view(
                'tree.delete.branches',
                compact(
                    'tree',
                    'branches'
                )
            );

        } else {
            return back()->withErrors([
                'You can only edit your own branches.',
                'Please create a new clone tree and do your edits there!'
            ]);
        }
    }

    public function destroy(Tree $tree) {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        $this->validate(request(), [
                'id' => 'required',
        ]);

        if ($tree->user_id === $userID  || $user->hasRole('admin')) {

            // Getting the parent branch
            $parent = Branch::findOrFail(request()->id);
            // Getting all children ids
            $array_of_ids = $this->getChildren($parent);
            // Appending the parent category id
            array_push($array_of_ids, request()->id);
            // Destroying all of them
            Branch::destroy($array_of_ids);

            // Destruction of related leaves
            foreach ($array_of_ids as $id) {
                Leaf::where('parent_id',$id)->delete();
            }

            return back()->with('success', 'Branch deleted successfully.');

        } else {
            return back()->withErrors([
                'You can only edit your own branches.',
                'Please create a new clone tree and do your edits there!'
            ]);
        }

    
    }

    private function getChildren($branch) {
        $ids = [];
        foreach ($branch->childs as $bra) {
            $ids[] = $bra->id;
            $ids = array_merge($ids, $this->getChildren($bra));
        }
        return $ids;
    }



    // Updating related BranchController methods
    public function move(Tree $tree) {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();
        $branches = Branch::where('tree_id',$tree->id)->where('parent_id',0)->get();

        if ($tree->user_id === $userID || $user->hasRole('admin')) {

            return view(
                'tree.moveBranches',
                compact(
                    'tree',
                    'branches'
                )
            );

        } else {
            return back()->withErrors([
                'You can only edit your own branches.',
                'Please create a new clone tree and do your edits there!'
            ]);
        }
    }

    public function update(Request $request) {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        if(request()->ajax()) {
            $branchIds = request()->input('branchIds');
            $branchParentIds = request()->input('branchParentIds');
            $length = count($branchParentIds);
            $length = $length - 2;

            for ($x = 0; $x <= ($length); $x++) {
                if($branchParentIds[$x]=='#') {
                    $branchParentIds[$x] = 0;
                    $branch = Branch::findOrFail($branchIds[$x]);
                    Branch::where('id', $branch->id)->update(['parent_id' => $branchParentIds[$x],]);
                } else {
                    $branch = Branch::findOrFail($branchIds[$x]);
                    Branch::where('id', $branch->id)->update(['parent_id' => $branchParentIds[$x],]);
                }
            }

            return $branchParentIds;
        }
    }



    /* Name related BranchController methods */
    public function rename(Tree $tree) {

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();
        $branches = Branch::where('tree_id',$tree->id)->where('parent_id',0)->get();

        if ($tree->user_id === $userID || $user->hasRole('admin')) {

            return view(
                'tree.rename.branches',
                compact(
                    'tree',
                    'branches'
                )
            );

        } else {
            return back()->withErrors([
                'You can only edit your own branches.',
                'Please create a new clone tree and do your edits there!'
            ]);
        }
    }

    public function updateName(Tree $tree) {

        $this->validate(request(), [
                'title' => 'required',
                'id' => 'required'
        ]);

        $user = auth()->user();
        $userID = $user->getAuthIdentifier();

        if ($tree->user_id === $userID || $user->hasRole('admin')) {

            Branch::where('id', request()->id)->update([

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
}
