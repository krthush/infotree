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

<div class="midContainer">
    <div class="midContainerHeader">
        <div class="midContainerHeaderText">
            {{ $tree->title }}'s Branches 
        </div>
        <div class="midContainerHeaderButtonContainer hidden-xs">

            @if($shared === 1)
                @if ($edit === 1)
                <div class="midHeaderButton">
                    Your tree has {{ $tree->likes()->count() }} likes.
                </div>
                @else 
                <div class="midHeaderButton">
                    This tree has {{ $tree->likes()->count() }} likes.
                </div>
                @endif

                @if ($tree->isLiked)
                    <div class="midHeaderButton" data-toggle="tooltip" title="Unlike Tree">
                        <a class="btn btn-primary" href="{{ route('like-tree', $tree) }}">
                            <span class="glyphicon glyphicon-thumbs-down"></span>
                        </a>
                    </div>
                @else
                    <div class="midHeaderButton" data-toggle="tooltip" title="Like Tree">
                        <a class="btn btn-primary" href="{{ route('like-tree', $tree) }}">
                            <span class="glyphicon glyphicon-thumbs-up"></span>
                        </a>
                    </div>
                @endif

            @endif

            @if ($edit === 1)
                @if ($shared === 0)
                <div class="midHeaderButton" data-toggle="tooltip" title="Share Tree">
                    <div class="hidden">
                        <form id="shareTreeForm" action="/{{ $tree->id }}/share-tree" method="POST">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <input type="text" name="id" value="{{ $tree->id }}" readonly>
                        </form>
                    </div>         
                    <button class="btn btn-primary" type="submit" form="shareTreeForm" value="Submit">
                        <span class="glyphicon glyphicon-share"></span>
                    </button>
                </div>
                @endif

                @if ($favourite === 0)
                <div class="midHeaderButton" data-toggle="tooltip" title="Favourite Tree">
                    <div class="hidden">
                        <form id="favouriteTreeForm" action="/{{ $tree->id }}/favourite-tree" method="POST">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <input type="text" name="id" value="{{ $tree->id }}" readonly>
                        </form>
                    </div>
                    <button class="btn btn-primary" type="submit" form="favouriteTreeForm" value="Submit">
                        <span class="glyphicon glyphicon-star"></span>
                    </button>
                </div>
                @endif

            <div class="midHeaderButton" data-toggle="tooltip" title="Edit Tree">
                <div class="dropdown">
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
            @endif

        </div>
    </div>
    <div class="midContainerContent">
        <div>
            <input class="search-input form-control short" placeholder="Search for branches in the tree">
        </div>
        <span class="glyphicon glyphicon-tree-deciduous" id="treeIcon"></span>
        <div id="jstree">
            <ul>
                @foreach($branches as $branch)
                    <li class="leaf">
                        <a href="/branches/{{ $branch->id }}">{{ $branch->title }}</a>
                        @if(count($branch->childs))
                            @include('tree.showBranchChildren',['childs' => $branch->childs])
                        @endif
                    </li>
                @endforeach
            </ul>
        </div> 
    </div>
</div>

@if ($empty === 1)
    @isset($edit)       
        <div class="padLeft topStack">
            Please <a href="" data-toggle="modal" data-target="#editDesc">click here</a> if you would like to add a description for this tree.
        </div>
    @endisset
@else
<div class="midContainer noHeight topStack">
    <div class="edit midContainerContent" id="treeDesc">
        <b>{{ $tree->description }}</b>
    </div>
    @isset($edit)
            <div class="editContent">
                <div class="editContentButton"><a href="" data-toggle="modal" data-target="#editDesc">Edit</a></div>
            </div>
    @endisset 
</div>
@endif

<!-- editFact Modal -->
<div class="modal fade" id="editDesc" role="dialog">
    <div class="modal-dialog">

      <!-- editFact Modal content-->
      <div class="modal-content">
        <div class="modal-body">
              <form method="POST" action="{{ route('description-tree', $tree) }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                  <div class="appear midContainerContent">
                    <div class="form-group">
                      <label>Edit Description</label>                      
                      <input id="description" name="description" class="form-control" placeholder="Please enter description here" ></input>
                    </div>
                    <small class="form-text text-muted">Please enter a description shorter than 10 words</small>
                  </div>
                  <div class="editContent">
                    <div class="editContentButton">
                      <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Submit</button>
                    </div>
                  </div> 
            </form>
        </div>
      </div>
      
    </div>
</div>

<div class="midHeader hidden-md hidden-lg hidden-sm">
    <div class="midContainerHeader">
        <div class="midContainerHeaderText">

            @if($shared === 1)
                @if ($edit === 1)
                <div class="midHeaderButton">
                    Your tree has {{ $tree->likes()->count() }} likes.
                </div>
                @else 
                <div class="midHeaderButton">
                    This tree has {{ $tree->likes()->count() }} likes.
                </div>
                @endif
            @endif

        </div>
        <div class="midContainerHeaderButtonContainer hidden-lg hidden-md hidden-sm">
            @if($shared === 1)
                @if ($tree->isLiked)
                    <div class="midHeaderButton" data-toggle="tooltip" title="Unlike Tree">
                        <a class="btn btn-primary" href="{{ route('like-tree', $tree) }}">
                            <span class="glyphicon glyphicon-thumbs-down"></span>
                        </a>
                    </div>
                @else
                    <div class="midHeaderButton" data-toggle="tooltip" title="Like Tree">
                        <a class="btn btn-primary" href="{{ route('like-tree', $tree) }}">
                            <span class="glyphicon glyphicon-thumbs-up"></span>
                        </a>
                    </div>
                @endif
            @endif

            @if ($edit === 1)
                @if ($shared === 0)
                <div class="midHeaderButton" data-toggle="tooltip" title="Share Tree">
                    <div class="hidden">
                        <form id="shareTreeForm" action="/{{ $tree->id }}/share-tree" method="POST">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <input type="text" name="id" value="{{ $tree->id }}" readonly>
                        </form>
                    </div>         
                    <button class="btn btn-primary" type="submit" form="shareTreeForm" value="Submit">
                        <span class="glyphicon glyphicon-share"></span>
                    </button>
                </div>
                @endif

                @if ($favourite === 0)
                <div class="midHeaderButton" data-toggle="tooltip" title="Favourite Tree">
                    <div class="hidden">
                        <form id="favouriteTreeForm" action="/{{ $tree->id }}/favourite-tree" method="POST">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <input type="text" name="id" value="{{ $tree->id }}" readonly>
                        </form>
                    </div>
                    <button class="btn btn-primary" type="submit" form="favouriteTreeForm" value="Submit">
                        <span class="glyphicon glyphicon-star"></span>
                    </button>
                </div>
                @endif

            <div class="midHeaderButton" data-toggle="tooltip" title="Edit Tree">
                <div class="dropdown">
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
            @endif
        </div>
    </div>
</div>

<script>
    $(function () {
        $(".search-input").keyup(function() {
            var searchString = $(this).val();
            $('#jstree').jstree('search', searchString);
        });

        $('#jstree').jstree({
            // Plugins
            "plugins" : ["noselectedstate", "types", "search", "state"],
            // Parameters
            "core" : { 
                "check_callback" : false,
                "dblclick_toggle" :false,
                "themes" : {
                  "variant" : "large",
                  "dots" : "true"
                }
            },
            "types" : {
                "default" : {
                    "icon" : "glyphicon glyphicon-leaf"
                }
            },
            "search": {
                "case_insensitive": true,
                "show_only_matches" : true,
                "show_only_matches_children" : true,
                // "fuzzy" : true
            },
            "state" : {
                "key" : "{{ $tree->id }}"
            }
        }).bind("select_node.jstree", function (e, data) {
            var href = data.node.a_attr.href;
            document.location.href = href;
        });


        // // Need to fix this AJAX method
        // $('#submitFavouriteTree').click(function() {

        //     $.ajax({
        //         url: "/{{ $tree->id }}/favourite-tree",
        //         type:"POST",
        //         data: {
        //             '_method': 'PATCH'
        //         },
        //         success:function(data){
        //             alert("Success");
        //         },
        //         error:function(){ 
        //             alert("Error!!!!");
        //         }
        //     }); //end of ajax
        // });
    });
</script>
@endsection