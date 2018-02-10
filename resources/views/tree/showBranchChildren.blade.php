<ul>
@foreach($childs as $child)
	@if(in_array($child->tree_id, $arrayOfTreeIDs))
	<li class="leaf" id="{{ $child->id }}" >
	    <a href="/branches/{{ $child->id }}">{{ $child->title }}<p class="hiddenText">{{ $child->id }}</p></a>
		@if(count($child->childs))
            @include('tree.showBranchChildren',['childs' => $child->childs])
        @endif
	</li>
	@endif
@endforeach
</ul>