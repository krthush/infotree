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
    <strong>Add Branches under {{ $tree->title }}!</strong> Please select a branch or the tree to add to... or<a href="{{ route('tree', $tree) }}"> click here </a>to go back!
</div>

<div class="midContainer">
    @include('layouts.branchesHeader')
    <div class="midContainerContent">
        <a class="rawLink" href="" data-toggle="modal" data-target="#0">
            <span class="glyphicon glyphicon-tree-deciduous" id="treeIcon"></span>
        </a>
        <div id="jstree">
            <ul>
                @foreach($branches as $branch)
                    <li class="leaf">
                        <a href="" data-toggle="modal" data-target="#{{ $branch->id }}">{{ $branch->title }}</a>
                        @if(count($branch->childs))
                            @include('tree.add.children',['childs' => $branch->childs])
                        @endif
                    </li>
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
          <!-- addFact Modal content-->
          <div class="modal-content">
            <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'route'=>array('add-branch', $tree)]) !!}
                    <div class="appear midContainerContent">
                        <div class="form-group">
                            <label>Add Branch Under {{ $branch->title }}</label>
                            <input class="form-control" type="text" name="title" placeholder="Enter name of branch" >
                        </div>
                        <div class="form-group">
                            {!! Form::text('parent_id', $branch->id, ['class' => 'hidden', 'readonly' => 'true']) !!}
                        </div>
                    </div>
                    <div class="editContent">
                        <div class="editContentButton">
                            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Add</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
          </div>          
        </div>
    </div>
    @if(count($branch->childs))
        @include('tree.add.modals',['childs' => $branch->childs])
    @endif    
@endforeach

<div class="modal fade" id="0" role="dialog">
    <div class="modal-dialog">

      <!-- add Modal content-->
      <div class="modal-content">
        <div class="modal-body">
            {!! Form::open(['method' => 'POST', 'route'=>array('add-branch', $tree)]) !!}
                <div class="appear midContainerContent">
                    <div class="form-group">
                        <label>Add Branch Under Tree</label>
                        <input class="form-control" type="text" name="title" placeholder="Enter name of branch" >
                    </div>
                    <div class="form-group">
                        {!! Form::text('parent_id', '0', ['class' => 'hidden', 'readonly' => 'true']) !!}
                    </div>
                </div>
                <div class="editContent">
                    <div class="editContentButton">
                        <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Add</button>
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
                "key" : "add?{{ $tree->id }}"
            }
        });

        $('#jstree').on("hover_node.jstree", function (evt,data) {
            data.instance.set_icon(data.node, 'glyphicon glyphicon-plus');
        }).on("dehover_node.jstree", function (evt,data) {
            data.instance.set_icon(data.node, 'glyphicon glyphicon-leaf');
        });

        $('#treeIcon').hover(function () {
            $(this).addClass('glyphicon-plus');
            $(this).removeClass('glyphicon-tree-deciduous');
        }, function () {
            $(this).addClass('glyphicon-tree-deciduous');
            $(this).removeClass('glyphicon-plus');
        }); 
    });
</script>
@endsection