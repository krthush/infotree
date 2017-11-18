@foreach($childs as $child)
    <div class="modal fade" id="{{ $child->id }}" role="dialog">
        <div class="modal-dialog">

          <!-- editFact Modal content-->
          <div class="modal-content">
            <div class="modal-body">
                {!! Form::open(['method' => 'PATCH', 'route'=>array('rename-branch', $tree)]) !!}
                    <div class="appear midContainerContent">
                        <div class="form-group">
                            <label>Rename ranch "{{ $child->title }}"</label>
                            <input class="form-control" type="text" name="title" placeholder="Enter new name for branch" required>
                        </div>
                        <div class="form-group">
                            {!! Form::text('id', $child->id, ['class' => 'hidden', 'readonly' => 'true']) !!}
                        </div>
                    </div>
                    <div class="editContent">
                        <div class="editContentButton"><button type="submit" class="btn btn-primary">Submit</button></div>
                    </div>
                {!! Form::close() !!}
            </div>
          </div>
          
        </div>
    </div>

	@if(count($child->childs))
    @include('tree.rename.modals',['childs' => $child->childs])
  @endif
@endforeach
