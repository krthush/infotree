@foreach($childs as $child)
    <div class="modal fade" id="{{ $child->id }}" role="dialog">
        <div class="modal-dialog">

          <!-- editFact Modal content-->
          <div class="modal-content">
            <div class="modal-body">
                  {!! Form::open(['method' => 'DELETE', 'route'=>array('delete-branch', $tree)]) !!}
                    <div class="appear midContainerContent">
                      <div class="form-group">
                        <label>Are You Sure You Want To Delete {{ $child->title }}</label>
                        {!! Form::text('id', $child->id, ['class' => 'hidden', 'readonly' => 'true']) !!}
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="editContent">
                        <div class="editContentButton">
                          <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Delete</button>
                        </div>
                      </div>
                    </div>
                  {!! Form::close() !!}
            </div>
          </div>
          
        </div>
    </div>

	@if(count($child->childs))
    @include('tree.delete.modals',['childs' => $child->childs])
  @endif
@endforeach
