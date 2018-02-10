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

<div class="alert alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Rename {{ $tree->title }}!</strong> Please select a the tree or it's branches rename to... or<a href="{{ route('tree', $tree) }}"> click here </a>to go back!
</div>

<div class="midContainer">
    <div class="midContainerHeader">
        <div class="midContainerHeaderText">
            <a class="rawLink" href="" data-toggle="modal" data-target="#0">
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <b>{{ $tree->title }}'s Branches</b> 
        </div>
        <div class="right dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                <span class="glyphicon glyphicon-edit">&ensp;</span><span class="caret"></span>
            </button>
          <ul class="dropdown-menu">
            <li><a href="{{ route('add-branch', $tree) }}">Add</a></li>
            <li><a href="{{ route('delete-branch', $tree) }}">Delete</a></li>
            <li><a href="{{ route('move-branch', $tree) }}">Move</a></li>
            <li><a href="{{ route('rename-branch', $tree) }}">Rename</a></li>
          </ul>
        </div>
    </div>
    <div class="midContainerContent">
        <span class="glyphicon glyphicon-tree-deciduous" id="treeIcon"></span>
        <div id="jstree">
            <ul>
                @foreach($branches as $branch)
                    @if(in_array($branch->tree_id, $arrayOfTreeIDs))
                    <li class="leaf">
                        <a href="" data-toggle="modal" data-target="#{{ $branch->id }}">
                            {{ $branch->title }}
                            @if($branch->tree_id!=$tree->id)
                            <b> - linked</b>
                            @endif
                        </a>
                        @if(count($branch->childs))
                            @include('tree.rename.children',['childs' => $branch->childs])
                        @endif
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="editContent">
                <div class="editContentButton">
                        <button id="submitEditBranches" class="btn btn-primary" type="button">
                            Done
                        </button>
                </div>
        </div>
    </div>
</div>

@foreach($branches as $branch)
    <div class="modal fade" id="{{ $branch->id }}" role="dialog">
        <div class="modal-dialog">
          <!-- editFact Modal content-->
          <div class="modal-content">
            <div class="modal-body">
                {!! Form::open(['method' => 'PATCH', 'route'=>array('rename-branch', $tree)]) !!}
                    <div class="appear midContainerContent">
                        <div class="form-group">
                            <label>Rename Branch "{{ $branch->title }}"</label>
                            <input class="form-control" type="text" name="title" placeholder="Enter new name for branch">
                        </div>
                        <div class="form-group">
                            {!! Form::text('id', $branch->id, ['class' => 'hidden', 'readonly' => 'true']) !!}
                        </div>
                    </div>
                    <div class="editContent">
                        <div class="editContentButton"><button type="submit" class="btn btn-primary">Submit</button></div>
                    </div>
                {!! Form::close() !!}
            </div>
          </div>          
        </div>
    </div>
    @if(count($branch->childs))
        @include('tree.rename.modals',['childs' => $branch->childs])
    @endif    
@endforeach

<div class="modal fade" id="0" role="dialog">
    <div class="modal-dialog">

      <!-- add Modal content-->
      <div class="modal-content">
        <div class="modal-body">
            {!! Form::open(['method' => 'PATCH', 'route'=>array('rename-tree', $tree)]) !!}
                <div class="appear midContainerContent">
                    <div class="form-group">
                        <label>Rename {{ $tree->title }}</label>
                        <input class="form-control" type="text" name="title" placeholder="Enter name of tree" >
                    </div>
                    <div class="form-group">
                        {!! Form::text('id', $tree->id, ['class' => 'hidden', 'readonly' => 'true']) !!}
                    </div>
                </div>
                <div class="editContent">
                    <div class="editContentButton">
                        <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Submit</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
      </div>
      
    </div>
</div>

<script>
    $(function () {

        $('#submitEditBranches').click(function(){
            window.location.href = "{{ route('tree', $tree) }}";
        });
        
        $('#jstree').jstree({
            // Plugins
            "plugins" : ["noselectedstate", "types", "state", ],
            // Parameters
            "core" : { 
                "check_callback" : false,
                "dblclick_toggle" :false,
                "themes" : {
                    "name" : "proton",
                    "responsive" : "true",
                    "variant" : "large",
                }
            },
            "types" : {
                "default" : {
                    "icon" : "glyphicon glyphicon-leaf"
                }
            },
            "state" : {
                "key" : "rename?{{ $tree->id }}"
            }
        });

        $('#jstree').on("hover_node.jstree", function (evt,data) {
            data.instance.set_icon(data.node, 'glyphicon glyphicon-pencil');
        }).on("dehover_node.jstree", function (evt,data) {
            data.instance.set_icon(data.node, 'glyphicon glyphicon-leaf');
        }); 
    });
</script>
@endsection