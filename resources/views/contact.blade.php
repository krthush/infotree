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
        <li>
            Please email to: <a href="mailto:infotreeuk17@gmail.com" target="_top">infotreeuk17@gmail.com</a>.
            <ul>
                <li>If you have found a bug or error in infotree.co.uk, if possible include images, videos, etc. to make it easier to identify the bug.</li>
                <li>If you would like to become an admin for infotree.co.uk, to help monitor and update site</li>
                <li>If you have opinions on how to imrpove the website</li>
                <li>If you have trouble using the site or do not understand it's functions</li>
            </ul>
        </li>
        <li>
            Please email to: <a href="mailto:thushaan.rajaratnam14@imperial.ac.uk?Subject=Infotree%20Enquiry" target="_top">thushaan.rajaratnam14@imperial.ac.uk</a>.
            <ul>
                <li>If you have any business enquiries</li>
                <li>For any other enquiries</li>
            </ul>
        </li>
      </ul>
    </div>
</div>
@endsection