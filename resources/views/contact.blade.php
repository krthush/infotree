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
      <div class="midContainerHeaderText">Contact</div>
    </div>
    <div class="midContainerContent">
      <ul>
        <li>Infotree is a website made to help access educational content on the internet easier.</li>
        
      </ul>
    </div>
</div>
@endsection