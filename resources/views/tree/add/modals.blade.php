@foreach($childs as $child)
    <div class="modal fade" id="{{ $child->id }}" role="dialog">
        <div class="modal-dialog">

          <!-- add Modal content-->
          <div class="modal-content">
            <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'route'=>array('add-branch', $tree)]) !!}
                    <div class="appear midContainerContent">
                        <div class="form-group">
                            <label>Add Branch Under {{ $child->title }}</label>
                            <input class="form-control" type="text" name="title" placeholder="Enter name of branch" >
                        </div>
                        <div class="form-group">
                            {!! Form::text('parent_id', $child->id, ['class' => 'hidden', 'readonly' => 'true']) !!}
                        </div>
                    </div>
                    <div class="editContent">
                        <div class="editContentButton">
                            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Add</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
          </div>
          
        </div>
    </div>

	@if(count($child->childs))
    @include('tree.add.modals',['childs' => $child->childs])
  @endif
@endforeach
