<ul>
@foreach($childs as $child)
	<li class="leaf">
	    <a href="" data-toggle="modal" data-target="#{{ $child->id }}">{{ $child->title }}</a>
		@if(count($child->childs))
            @include('tree.rename.children',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul>