<ul>
@foreach($childs as $child)
	@if(in_array($child->tree_id, $arrayOfTreeIDs))
	<li class="leaf">
	    <a href="" data-toggle="modal" data-target="#{{ $child->id }}">
	    	{{ $child->title }}
	    	@if($child->tree_id!=$tree->id)
            <b> - linked</b>
            @endif
	    </a>
		@if(count($child->childs))
            @include('tree.delete.children',['childs' => $child->childs])
        @endif
	</li>
	@endif
@endforeach
</ul>