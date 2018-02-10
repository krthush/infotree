<ul>
@foreach($childs as $child)
	@if(in_array($child->tree_id, $arrayOfTreeIDs))
	<li class="leaf" id="{{ $child->id }}" >
	    <a href="/branches/{{ $child->id }}">
	    	{{ $child->title }}
	    	@if($child->tree_id!=$tree->id)
	            <b> - linked</b>
            @endif
	    	<p class="hiddenText">{{ $child->id }}</p>
	    </a>
		@if(count($child->childs))
            @include('tree.move.children',['childs' => $child->childs])
        @endif
	</li>
	@endif
@endforeach
</ul>