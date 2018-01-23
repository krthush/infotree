<ul>
@foreach($childs as $child)
	<li class="leaf" id="{{ $child->id }}" >
	    <a href="/branches/{{ $child->id }}">{{ $child->title }}<p class="hiddenText">{{ $child->id }}</p></a>
		@if(count($child->childs))
            @include('tree.showBranchChildren',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul>