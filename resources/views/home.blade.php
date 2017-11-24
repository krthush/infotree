@extends('layouts.master')

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <ul>
            @foreach ($errors->all() as $error)
                <li><strong>{{ $error }}</strong></li>
            @endforeach
        </ul>
    </div>
@endif

<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>        
        Please remember to log on to blackboard so that all the links in infotree work!
    </strong>
</div>

<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>        
        N.B. Infotree currently relies on its admins to keep university trees up to date, as such some information MAY BE MISSING. Please do not only use infotree as your sole VLE, check blackboard as well.
    </strong>
</div>

<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>        
        N.B. Please note that for the current version of infotree, your personal tree DOES NOT update when changes are made to the university tree, please prioritise updating your tree with university changes that matter to you OR use the university tree.
    </strong>
</div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are now logged in successfully and can start using infotree!

                    <br>
                    <br>

                    Select the university tree relevant to you to begin. Initially you will not be able to edit it, but you can create trees based on it and then edit all you want! 

                    <br>
                    <br>

                    You can also create new Trees if you like to have different tree's for different purposes! (e.g. You may like to have a Tree for work applications).

                    <br>
                    <br>

                    When you are ready you can share your tree so that your classmates can see your tree's structure and hopefully help them learn faster!

                    <br>
                    <br>

                    <a href="password/reset">Click here!</a> to reset your password.

                </div>
            </div>
        </div>
    </div>
@endsection
