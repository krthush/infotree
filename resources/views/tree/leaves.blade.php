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

@if ($empty === 1)
         <div class="stack midHeader">
            <div class="midContainerHeader">
                <div class="midContainerHeaderText">{{ $branch->title }}</div>        
            </div>
        </div>
        @if ($edit === 'edit')        
        <div class="padLeft topStack">
            Please <a href="" data-toggle="modal" data-target="#editFact">click here</a> if you would like to add some facts for {{ $branch->title }}
        </div>
        @endif    
@else
<div class="midContainer">
	<div class="midContainerHeader">
    	<div class="midContainerHeaderText">{{ $branch->title }}</div>        
    </div>
    <div class="{{ $edit }} midContainerContent">
        {!! nl2br(e($branch->facts)) !!}
    </div>
        @if ($edit === 'edit')
            <div class="editContent">
                <div class="editContentButton"><a href="" data-toggle="modal" data-target="#editFact">Edit</a></div>
            </div>
        @endif 
</div>
@endif

<div class="hidden-lg hidden-md topStack midHeader">
    <a class="rawLink" href="{{ route('tree', $tree) }}">
    <div class="link midContainerHeader">
        <div class="midHeaderText">Return To Current Tree "{{ $tree->title }}"</div>
    </div>
    </a>
</div>

<div class="row">

  	<div class="col-md-6">
        <div class="stack midContainer">
        	<div class="midContainerHeader">
            	<div class="midContainerHeaderText">Educational Content</div>
            </div>
            <div class="{{ $edit }} midContainerContent">
            	<ul class="list">
                    @foreach($infoContents as $infoContent)
                        <li>
                            <a href="{{ $infoContent->link }}" target="_blank">{{ $infoContent->title }}</a>
                        </li>
                    @endforeach
                    @if(count($infoContents) === 0)
                        <li>There is no educational content!</li>
                    @endif
                </ul>                    
            </div>
                @if ($edit === 'edit')
                    <div class="editContent">
                        <div class="editContentButton"><a href="" data-toggle="modal" data-target="#renEdu">Rename</a></div>
                        <div class="editContentButton"><a href="" data-toggle="modal" data-target="#delEdu">Delete</a></div>
                        <div class="editContentButton"><a href="" data-toggle="modal" data-target="#addEdu">Add</a></div>
                    </div>
                @endif                
        </div>
 	</div>

    <div class="col-md-6">
        <div class="stack midContainer">
            <div class="midContainerHeader">
                <div class="midContainerHeaderText">Teaching Videos / Animations / Pictures</div>
            </div>
            <div class="{{ $edit }} midContainerContent">
                <ul class="list">
                    @foreach($infoVideos as $infoVideo)
                        <li>
                            <a href="{{ $infoVideo->link }}" target="_blank">{{ $infoVideo->title }}</a>
                        </li>
                    @endforeach
                    @if(count($infoVideos) === 0)
                        <li>There are no teaching videos!</li>
                    @endif
                </ul>
            </div>
                @if ($edit === 'edit')
                    <div class="editContent">
                        <div class="editContentButton"><a href="" data-toggle="modal" data-target="#renVid">Rename</a></div>
                        <div class="editContentButton"><a href="" data-toggle="modal" data-target="#delVid">Delete</a></div>
                        <div class="editContentButton"><a href="" data-toggle="modal" data-target="#addVid">Add</a></div>
                    </div>
                @endif              
        </div>
    </div>

</div>



<div class="row">

    <div class="col-md-6">
        <div class="stack midContainer">
            <div class="midContainerHeader">
                <div class="midContainerHeaderText">Problem Sets / Tutorials / Past Papers</div>
            </div>
            <div class="{{ $edit }} midContainerContent">
                <ul class="list">
                    @foreach($infoTutorials as $infoTutorial)
                        <li>
                            <a href="{{ $infoTutorial->link }}" target="_blank">{{ $infoTutorial->title }}</a>
                        </li>
                    @endforeach
                    @if(count($infoTutorials) === 0)
                        <li>There are no problem sets / tutorials / past papers!</li>
                    @endif
                </ul>                    
            </div>
                @if ($edit === 'edit')
                    <div class="editContent">
                        <div class="editContentButton"><a href="" data-toggle="modal" data-target="#renTut">Rename</a></div>
                        <div class="editContentButton"><a href="" data-toggle="modal" data-target="#delTut">Delete</a></div>
                        <div class="editContentButton"><a href="" data-toggle="modal" data-target="#addTut">Add</a></div>
                    </div>
                @endif                
        </div>
    </div>

    <div class="col-md-6">
        <div class="stack midContainer">
            <div class="midContainerHeader">
                <div class="midContainerHeaderText">Further Reading / Additional Information</div>
            </div>
            <div class="{{ $edit }} midContainerContent">
                <ul class="list">
                    @foreach($infoContentAdds as $infoContentAdd)
                        <li>
                            <a href="{{ $infoContentAdd->link }}" target="_blank">{{ $infoContentAdd->title }}</a>
                        </li>
                    @endforeach
                    @if(count($infoContentAdds) === 0)
                        <li>There is no further reading / additional information!</li>
                    @endif
                </ul>
            </div>
                @if ($edit === 'edit')
                    <div class="editContent">
                        <div class="editContentButton"><a href="" data-toggle="modal" data-target="#renAdd">Rename</a></div>
                        <div class="editContentButton"><a href="" data-toggle="modal" data-target="#delAdd">Delete</a></div>
                        <div class="editContentButton"><a href="" data-toggle="modal" data-target="#addAdd">Add</a></div>
                    </div>
                @endif                       
        </div>
    </div>

</div>

<!-- <div class="stack midContainer">
    <div class="midContainerHeader">
        <div class="midContainerHeaderText">Questions And Answers On {{ $branch->title }}</div>
    </div>
    <div class="{{ $edit }} midContainerContent">
        <ul class="list">
            Under Construction
        </ul>
    </div>
    <div class="editContent">
        <div class="editContentButton"><a href="#">Under Construction</a></div>
    </div>                        
</div> -->

@include('tree.leafModals')
      
@endsection