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
    <strong>Delete {{ $tree->title }}'s Branches!</strong> Please select a branch to delete... or <a href="{{ route('tree', $tree) }}"> click here </a>to go back!
</div>

<div class="midContainer">
    @include('layouts.branchesHeader')
    <div class="midContainerContent">
        <span class="glyphicon glyphicon-tree-deciduous" id="treeIcon"></span>
        <div id="jstree">
            <ul>
                @foreach($branches as $branch)
                    <li class="leaf">
                        <a href="" data-toggle="modal" data-target="#{{ $branch->id }}">{{ $branch->title }}</a>
                        @if(count($branch->childs))
                            @include('tree.delete.children',['childs' => $branch->childs])
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
          <!-- editFact Modal content-->
          <div class="modal-content">
            <div class="modal-body">
                  {!! Form::open(['method' => 'DELETE', 'route'=>array('delete-branch', $tree)]) !!}
                    <div class="appear midContainerContent">
                      <div class="form-group">
                        <label>Are You Sure You Want To Delete {{ $branch->title }}</label>
                        {!! Form::text('id', $branch->id, ['class' => 'hidden', 'readonly' => 'true']) !!}
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="editContent">
                        <div class="editContentButton">
                            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Delete</button>
                        </div>
                      </div>
                    </div>
                  {!! Form::close() !!}
            </div>
          </div>          
        </div>
    </div>
    @if(count($branch->childs))
        @include('tree.delete.modals',['childs' => $branch->childs])
    @endif    
@endforeach

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
                "key" : "delete?{{ $tree->id }}"
            }
        });

        $('#jstree').on("hover_node.jstree", function (evt,data) {
            data.instance.set_icon(data.node, 'glyphicon glyphicon-remove');
        }).on("dehover_node.jstree", function (evt,data) {
            data.instance.set_icon(data.node, 'glyphicon glyphicon-leaf');
        });
    });
</script>
@endsection