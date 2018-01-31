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

@if($childBranches->count())
<div class="stack midContainer">
    <div class="midContainerHeader">
        <div class="midContainerHeaderText">Folders</div>
    </div>
    <div class="{{ $edit }} midContainerContent">
        <div class="icons container">
            @foreach($childBranches as $childbranch)
                <div class="col-sm-4 folder">
                    <a class="rawLink" href="{{ route('leaves', $childbranch->id) }}" >
                        <div class="icon">
                            <img src="/images/folder.png" class="img-circle">
                            <h4>{{ $childbranch->title }}</h4>
                        </div>
                    </a>
                </div>                        
            @endforeach
        </div>                    
    </div>
    <div class="editContent">
        @if($infoContents->count()==0)
            <div class="editContentButton"><a href="" data-toggle="modal" data-target="#addEdu">Add Educational Content</a></div>
        @endif
        @if($infoVideos->count()==0)
            <div class="editContentButton"><a href="" data-toggle="modal" data-target="#addVid">Add Tutorial Content</a></div>
        @endif
        @if($infoTutorials->count()==0)
            <div class="editContentButton"><a href="" data-toggle="modal" data-target="#addTut">Add Video Content</a></div>
        @endif
        @if($infoContentAdds->count()==0)
            <div class="editContentButton"><a href="" data-toggle="modal" data-target="#addAdd">Add Additional Content</a></div>
        @endif
    </div>               
</div>
@endif

<div class="grid">
@if($infoContents->count())
  	<div class="col-sm-6 grid-item">
        <div class="stack midContainer">
        	<div class="midContainerHeader">
            	<div class="midContainerHeaderText">Educational Content</div>
            </div>
            <div class="{{ $edit }} midContainerContent">
            	<div class="icons container">
                    @foreach($infoContents as $infoContent)
                            <a class="rawLink" href="{{ $infoContent->link }}" target="_blank">
                                <div class="icon">
                                    <img src="/images/document.png" class="img-circle">
                                    <h4 class="break-word">{{ $infoContent->title }}</h4>
                                </div>
                            </a>                      
                    @endforeach
                    @if(count($infoContents) === 0)
                        <div>There is no educational content!</div>
                    @endif
                </div>                    
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
@endif

@if($infoVideos->count())
    <div class="col-sm-6 grid-item">
        <div class="stack midContainer">
            <div class="midContainerHeader">
                <div class="midContainerHeaderText">Teaching Videos / Animations / Pictures</div>
            </div>
            <div class="{{ $edit }} midContainerContent">
                <div class="icons container">
                    @foreach($infoVideos as $infoVideo)
                            <a class="rawLink" href="{{ $infoVideo->link }}" target="_blank">
                                <div class="icon">
                                    <img src="/images/videocameraclassic.png" class="img-circle">
                                    <h4>{{ $infoVideo->title }}</h4>
                                </div>
                            </a>                       
                    @endforeach
                    @if(count($infoVideos) === 0)
                        <div>There is no educational content!</div>
                    @endif
                </div>
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
@endif

@if($infoTutorials->count())
    <div class="col-sm-6 grid-item">
        <div class="stack midContainer">
            <div class="midContainerHeader">
                <div class="midContainerHeaderText">Problem Sets / Tutorials / Past Papers</div>
            </div>
            <div class="{{ $edit }} midContainerContent">
                <div class="icons container">
                    @foreach($infoTutorials as $infoTutorial)
                            <a class="rawLink" href="{{ $infoTutorial->link }}" target="_blank">
                                <div class="icon">
                                    <img src="/images/compose.png" class="img-circle">
                                    <h4>{{ $infoTutorial->title }}</h4>
                                </div>
                            </a>                       
                    @endforeach
                    @if(count($infoTutorials) === 0)
                        <div>There is no educational content!</div>
                    @endif
                </div>                    
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
@endif

@if($infoContentAdds->count())
    <div class="col-sm-6 grid-item">
        <div class="stack midContainer">
            <div class="midContainerHeader">
                <div class="midContainerHeaderText">Further Reading / Additional Information</div>
            </div>
            <div class="{{ $edit }} midContainerContent">
                <ul class="list">
                    @foreach($infoContentAdds as $infoContentAdd)
                            <a class="rawLink" href="{{ $infoContentAdd->link }}" target="_blank">
                                <div class="icon">
                                    <img src="/images/news.png" class="img-circle">
                                    <h4>{{ $infoContentAdd->title }}</h4>
                                </div>
                            </a>                      
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
@endif
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