@extends('layouts.master')

@section('content')

<div class="midContainer">
    <div class="midContainerHeader">
        <div class="midContainerHeaderText">Trees</div>
    </div>
    <div class="midContainerContent">
    	<p> You can search through all shared trees on infotree here. The number of likes for each given tree is shown on the right. </p>
    	<input type="text" class="search-input form-control short" id="sharedTreesInput" onkeyup="myFunction()" placeholder="Search for shared trees">
        <ul id="sharedTreesUL" class="list-group">
            @foreach($allSharedTrees as $sharedTree)
            <a class="rawLink fullWidth" href="/tree/{{ $sharedTree->id }}">
                <li class="list-group-item justify-content-between">    	            
                    <strong class="padRight">{{ $sharedTree->title }}</strong> {{$sharedTree->description}} <i class="padLeft">created by {{ $sharedTree->user()->first()->name }}</i>
                    <span class="badge badge-default badge-pill">{{ $sharedTree->likes()->count() }}</span>
                </li>
            </a>
            @endforeach
        </ul>
    </div>
</div>

  	<script>
		function myFunction() {
		    // Declare variables
		    var input, filter, ul, li, a, i;
		    input = document.getElementById('sharedTreesInput');
		    filter = input.value.toUpperCase();
		    ul = document.getElementById("sharedTreesUL");
		    a = ul.getElementsByTagName('a');

		    // Loop through all list items, and hide those who don't match the search query
		    for (i = 0; i < a.length; i++) {
		        li = a[i].getElementsByTagName("li")[0];
		        if (li.innerHTML.toUpperCase().indexOf(filter) > -1) {
		            a[i].style.display = "";
		        } else {
		            a[i].style.display = "none";
		        }
		    }
		}
	</script>

@endsection