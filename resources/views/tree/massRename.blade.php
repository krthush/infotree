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
                <div class="midContainerHeaderButtonContainer">
                    <div class="midHeaderButton" data-toggle="tooltip" title="Edit Tree">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-edit">&ensp;</span><span class="caret"></span>
                            </button>
                          <ul class="dropdown-menu">
                            <li><a href="{{ route('mass-rename',$branch) }}">Mass Rename</a></li>
                          </ul>
                        </div>
                    </div>
                </div>        
            </div>
        </div>       
        <div class="padLeft topStack">
            Please <a href="" data-toggle="modal" data-target="#editFact">click here</a> if you would like to add some facts for {{ $branch->title }}
        </div>    
@else
<div class="midContainer">
	<div class="midContainerHeader">
    	<div class="midContainerHeaderText">{{ $branch->title }}</div>
        <div class="midContainerHeaderButtonContainer">
            <div class="midHeaderButton" data-toggle="tooltip" title="Edit Tree">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-edit">&ensp;</span><span class="caret"></span>
                    </button>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('mass-rename',$branch) }}">Mass Rename</a></li>
                  </ul>
                </div>
            </div>
        </div>        
    </div>
    <div class="edit midContainerContent">
        {!! nl2br(e($branch->facts)) !!}
    </div>
            <div class="editContent">
                <div class="editContentButton"><a href="" data-toggle="modal" data-target="#editFact">Edit</a></div>
            </div>
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
    {!! Form::open(['method' => 'PATCH', 'route'=>array('rename-branches', $branch)]) !!}
        {{ csrf_field() }}
        <div class="edit midContainerContent">
            <div class="icons container">
                @foreach($childBranches as $childbranch)
                    @if(in_array($childbranch->tree_id, $arrayOfTreeIDs))
                        @if($childbranch->user_id === auth()->user()->getAuthIdentifier() || auth()->user()->hasRole('admin') || $tree->global === 1)
                            <div class="col-sm-4 folder">
                                    <div class="icon">
                                        <img src="/images/folder.png" class="img-circle">
                                        <input class="form-control input-sm" type="text" name="folder_{{ $childbranch->id }}" value="{{ $childbranch->title }}" >
                                    </div>
                            </div>
                        @else
                            <div class="col-sm-4 folder">
                                    <div class="icon">
                                        <img src="/images/folder.png" class="img-circle">
                                        <input class="form-control input-sm" type="text" name="folder_{{ $childbranch->id }}" value="{{ $childbranch->title }} - linked" disabled>
                                    </div>
                            </div>
                        @endif
                    @endif                        
                @endforeach
            </div>
            <div class="editContent">
                    <div class="editContentButton">
                            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Done</button>
                    </div>
            </div>                    
        </div>
    {!! Form::close() !!}             
</div> 
@endif

<div class="grid">
@if($infoContents->count())
  	<div class="col-sm-6 grid-item">
        <div class="stack midContainer">
        	<div class="midContainerHeader">
            	<div class="midContainerHeaderText">Educational Content</div>
            </div>
            {!! Form::open(['method' => 'PATCH', 'route'=>array('rename-leaves', $branch)]) !!}
                {{ csrf_field() }}
                <div class="edit midContainerContent">
                	<div class="icons container">
                        @foreach($infoContents as $infoContent)
                            @if($infoContent->user_id === auth()->user()->getAuthIdentifier() || auth()->user()->hasRole('admin') || $tree->global === 1)
                                <div class="icon">
                                    <img src="/images/document.png" class="img-circle">
                                    <input class="form-control input-sm" type="text" name="leaf_{{ $infoContent->id }}" value="{{ $infoContent->title }}" >
                                </div>
                            @else
                                <div class="icon">
                                    <img src="/images/document.png" class="img-circle">
                                    <input class="form-control input-sm" type="text" name="leaf_{{ $infoContent->id }}" value="{{ $infoContent->title }}" disabled>
                                </div>    
                            @endif                             
                        @endforeach
                        @if(count($infoContents) === 0)
                            <div>There is no educational content!</div>
                        @endif
                    </div>                    
                </div>
                <div class="editContent">
                    <div class="editContentButton">
                        <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Done</button>
                    </div>
                </div>
            {!! Form::close() !!}                
        </div>
 	</div>
@endif

@if($infoVideos->count())
    <div class="col-sm-6 grid-item">
        <div class="stack midContainer">
            <div class="midContainerHeader">
                <div class="midContainerHeaderText">Teaching Videos / Animations / Pictures</div>
            </div>
            {!! Form::open(['method' => 'PATCH', 'route'=>array('rename-leaves', $branch)]) !!}
                {{ csrf_field() }}
                <div class="edit midContainerContent">
                    <div class="icons container">
                        @foreach($infoVideos as $infoVideo)
                            @if($infoVideo->user_id === auth()->user()->getAuthIdentifier() || auth()->user()->hasRole('admin') || $tree->global === 1)
                                <div class="icon">
                                    <img src="/images/document.png" class="img-circle">
                                    <input class="form-control input-sm" type="text" name="leaf_{{ $infoVideo->id }}" value="{{ $infoVideo->title }}" >
                                </div>
                            @else
                                <div class="icon">
                                    <img src="/images/document.png" class="img-circle">
                                    <input class="form-control input-sm" type="text" name="leaf_{{ $infoVideo->id }}" value="{{ $infoVideo->title }}" disabled>
                                </div>   
                            @endif                    
                        @endforeach
                        @if(count($infoVideos) === 0)
                            <div>There is no video content!</div>
                        @endif
                    </div>
                </div>
                <div class="editContent">
                    <div class="editContentButton">
                        <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Done</button>
                    </div>
                </div>
            {!! Form::close() !!}                 
        </div>
    </div>
@endif

@if($infoTutorials->count())
    <div class="col-sm-6 grid-item">
        <div class="stack midContainer">
            <div class="midContainerHeader">
                <div class="midContainerHeaderText">Problem Sets / Tutorials / Past Papers</div>
            </div>
            {!! Form::open(['method' => 'PATCH', 'route'=>array('rename-leaves', $branch)]) !!}
                {{ csrf_field() }}
                <div class="edit midContainerContent">
                    <div class="icons container">
                        @foreach($infoTutorials as $infoTutorial)
                            @if($infoTutorial->user_id === auth()->user()->getAuthIdentifier() || auth()->user()->hasRole('admin') || $tree->global === 1) 
                                <div class="icon">
                                    <img src="/images/document.png" class="img-circle">
                                    <input class="form-control input-sm" type="text" name="leaf_{{ $infoTutorial->id }}" value="{{ $infoTutorial->title }}" >
                                </div>
                            @else
                                <div class="icon">
                                    <img src="/images/document.png" class="img-circle">
                                    <input class="form-control input-sm" type="text" name="leaf_{{ $infoTutorial->id }}" value="{{ $infoTutorial->title }}" disabled>
                                </div>
                            @endif                       
                        @endforeach
                        @if(count($infoTutorials) === 0)
                            <div>There is no tutorial content!</div>
                        @endif
                    </div>                    
                </div>
                <div class="editContent">
                    <div class="editContentButton">
                        <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Done</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endif

@if($infoContentAdds->count())
    <div class="col-sm-6 grid-item">
        <div class="stack midContainer">
            <div class="midContainerHeader">
                <div class="midContainerHeaderText">Further Reading / Additional Information</div>
            </div>
            {!! Form::open(['method' => 'PATCH', 'route'=>array('rename-leaves', $branch)]) !!}
                {{ csrf_field() }}            
                <div class="edit midContainerContent">
                    <ul class="list">
                        @foreach($infoContentAdds as $infoContentAdd)
                            @if($infoContentAdd->user_id === auth()->user()->getAuthIdentifier() || auth()->user()->hasRole('admin') || $tree->global === 1)
                                <div class="icon">
                                    <img src="/images/document.png" class="img-circle">
                                    <input class="form-control input-sm" type="text" name="leaf_{{ $infoContentAdd->id }}" value="{{ $infoContentAdd->title }}" >
                                </div>
                            @else
                                <div class="icon">
                                    <img src="/images/document.png" class="img-circle">
                                    <input class="form-control input-sm" type="text" name="leaf_{{ $infoContentAdd->id }}" value="{{ $infoContentAdd->title }}" disabled>
                                </div>
                            @endif                     
                        @endforeach
                        @if(count($infoContentAdds) === 0)
                            <li>There is no further reading / additional information!</li>
                        @endif
                    </ul>
                </div>
                <div class="editContent">
                    <div class="editContentButton">
                        <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Done</button>
                    </div>
                </div>
            {!! Form::close() !!}                  
        </div>
    </div>
@endif
</div>
<!-- <div class="stack midContainer">
    <div class="midContainerHeader">
        <div class="midContainerHeaderText">Questions And Answers On {{ $branch->title }}</div>
    </div>
    <div class="edit midContainerContent">
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