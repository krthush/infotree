<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layouts.rightSidebar', function($view) {

            $user = auth()->user();
            $userID = $user->getAuthIdentifier();
       
            $allSharedTrees = \App\Tree::where('shared',true)->where('university','!=',true)->orderBy('likes','desc')->get();
            $totalUsers = count(\App\User::all());
            $likeCutOff = ceil(0.3*$totalUsers);
            $filteredSharedTrees = \App\Tree::where('shared',true)->where('university','!=',true)->where('likes','>=',$likeCutOff)->orderBy('likes','desc')->get();

            if (count($allSharedTrees) < 10) {
                $filteredSharedTrees = $allSharedTrees;
            } elseif (count($filteredSharedTrees) < 10) {
                $filteredSharedTrees = \App\Tree::where('shared',true)->where('university','!=',true)->orderBy('likes','desc')->where('likes','>=',$likeCutOff)->get();
            } else {
                $filteredSharedTrees = \App\Tree::where('shared',true)->where('university','!=',true)->where('likes','>=',$likeCutOff)->orderBy('likes','desc')->take(10)->get();
            }

            if ($user->hasRole('admin')) {

                // Finding all trees
                $selectUserTrees = \App\Tree::where('user_id',$userID)->pluck('title','id')->all();
                $sharedTrees = \App\Tree::where('shared',true)->where('university','!=',true)->orderBy('likes','desc')->pluck('title','id')->all();

                // Give admins access to all trees
                $selectUserTrees = array_push($selectUserTrees, $sharedTrees);
                $sharedTrees = \App\Tree::where('shared',true)->where('university','!=',true)->orderBy('likes','desc')->get();

                $view->with('selectUserTrees',$selectUserTrees);
                $view->with('sharedTrees', $sharedTrees);

            } else {

                $view->with('selectUserTrees',\App\Tree::where('user_id',$userID)->pluck('title','id')->all());
                $view->with('sharedTrees',\App\Tree::where('shared',true)->where('university','!=',true)->orderBy('likes','desc')->take(20)->get());

            }

            $view->with('filteredSharedTrees',$filteredSharedTrees);
            $view->with('userTrees',\App\Tree::where('user_id',$userID)->get());            
            $view->with('uniTrees',\App\Tree::where('shared',true)->where('university',true)->get());

        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
