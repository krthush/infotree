<ul>
@foreach($childs as $child)
	@if(in_array($child->tree_id, $arrayOfTreeIDs))
	<li class="leaf">
	    <a href="" data-toggle="modal" data-target="#{{ $child->id }}">{{ $child->title }}</a>
		@if(count($child->childs))
            @include('tree.add.children',['childs' => $child->childs])
        @endif
	</li>
	@endif
@endforeach
</ul>