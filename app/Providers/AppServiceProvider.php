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

                $view->with('selectSharedTrees', \App\Tree::where('shared',true)->where('university','!=',true)->pluck('title','id')->all());
                $view->with('sharedTrees',\App\Tree::where('shared',true)->where('university','!=',true)->orderBy('likes','desc')->get());

            } else {

                $view->with('sharedTrees',\App\Tree::where('shared',true)->where('university','!=',true)->orderBy('likes','desc')->take(20)->get());

            }

            $myTree = \App\Tree::where('user_id',$userID)->where('favourite',true)->first();

            $view->with('myTree',$myTree);
            $view->with('filteredSharedTrees',$filteredSharedTrees);
            $view->with('userTrees',\App\Tree::where('user_id',$userID)->get());
            $view->with('selectUserTrees',\App\Tree::where('user_id',$userID)->pluck('title','id')->all());
            $view->with('uniTrees',\App\Tree::where('shared',true)->where('university',true)->get());

        });

        view()->composer('layouts.leftSidebar', function($view) {

            if (auth()->user()) {

                $user = auth()->user();
                $userID = $user->getAuthIdentifier();

                $myTree = \App\Tree::where('user_id',$userID)->where('favourite',true)->first();

            } else {
                $myTree= null;
            }
       
            $view->with('myTree',$myTree);

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
