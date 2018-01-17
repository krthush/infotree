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
    <strong>Move {{ $tree->title }}'s Branches!</strong> Please move branches and submit to store changes... or <a href="{{ route('tree', $tree) }}"> click here </a>to go back!
</div>

<div class="midContainer">
    @include('layouts.branchesHeader')
    <div class="midContainerContent">
        <span class="glyphicon glyphicon-tree-deciduous" id="treeIcon"></span>
        <div id="jstree">
            <ul>
                @foreach($branches as $branch)
                    <li class="leaf" id="{{ $branch->id }}">
                        <a href="branches/{{ $branch->id }}">{{ $branch->title }}</a>
                        @if(count($branch->childs))
                            @include('tree.showBranchChildren',['childs' => $branch->childs])
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

<div id="postRequestData"></div>

<script>
    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var movedBranches = [];
        // tracks moved branches

        $('#submitEditBranches').click(function(){
            var jstreeData = $('#jstree').data().jstree._model.data;
            var branchIds = [];
            var branchParentIds = [];
            for (var property in jstreeData) {
                if (jstreeData.hasOwnProperty(property)) {
                    branchIds.push(property);
                    branchParentIds.push(jstreeData[property].parent);
                }
            }

            // console.log(branchIds);
            // console.log(branchParentIds);
            // console.log(jstreeData);

            $.ajax({
                url: "/tree/move-branch",
                type:"POST",
                data: {
                    '_method': 'PATCH',
                    'branchIds': branchIds,
                    'branchParentIds': branchParentIds
                },
                success:function(data){
                    console.log(data);
                    window.location.href = "{{ route('tree', $tree) }}";
                },
                error:function(){ 
                    alert("Error!!!!");
                }
            }); //end of ajax
        });

        $('#jstree').jstree({
            // Plugins
            "plugins" : ["noselectedstate", "dnd", "types", "state", ],
            // Parameters            
            "core" : { 
                "check_callback" : true,
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
                "key" : "move?{{ $tree->id }}"
            }
        }).bind("move_node.jstree", function (e, data) {
            movedBranches.push(data);
            // tracks moved branches, maybe use later with events for fluid changes?
        });

    });
</script>
<script >
    $(document).on('dnd_stop.vakata', function (e, data) {
        setTimeout(saveMove, 100);
        function saveMove() {
            console.log('Started');
            var jstreeData = $('#jstree').data().jstree._model.data;
            var branchIds = [];
            var branchParentIds = [];
            for (var property in jstreeData) {
                if (jstreeData.hasOwnProperty(property)) {
                    branchIds.push(property);
                    branchParentIds.push(jstreeData[property].parent);
                }
            }

            // console.log(branchIds);
            // console.log(branchParentIds);
            // console.log(jstreeData);

            $.ajax({
                url: "/tree/move-branch",
                type:"POST",
                data: {
                    '_method': 'PATCH',
                    'branchIds': branchIds,
                    'branchParentIds': branchParentIds
                },
                success:function(data){
                    console.log(data);
                },
                error:function(){ 
                    alert("Error!!!!");
                }
            }); //end of ajax
        }
    });
</script>
@endsection