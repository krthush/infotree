@extends('layouts.app')

@section('content')
<!--Welcome content-->

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

<div class="midContainer">
  <div class="midContainerHeader">
      <div class="midContainerHeaderText">Infotree</div>
    </div>
    <div class="midContainerContent">
      <ul>
        <li>Infotree is a website made to help access educational content on the internet easier.</li>
        <li>It does this by allowing users to fully customize the structure of how information is presented to them</li>
        <li>Additionally it allows users to share these structures allowing for students in similar years to collaborate in finding the most intuitive layout</li>
        <li>This is a project started by Thushaan Rajaratnam and is currently under development, if you would like to know more about its progress click <a href="\devblog">here!</a></li>
        <li>Currently it's just me on the project, if you'd like to work on this project with, just email!</li>
        <li>The project is only its early stages, I have many plans to improve it and make it easy for people to learn! If you want to support it, for now simply just keep using the website and giving me feedback :D!</li>

<!--         <li>It also allows for fast and helpful communication with teaching members through its Q&A system.</li>
        <li>It does this by grouping together any educational content into progressive catogories much like a tree with many branches and then displaying any relevant information (including Questions & Answers) in organised manner.</li> -->
        
      </ul>
    </div>
</div>
@endsection