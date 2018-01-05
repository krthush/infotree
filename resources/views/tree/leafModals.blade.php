<!-- editFact Modal -->
<div class="modal fade" id="editFact" role="dialog">
    <div class="modal-dialog">

      <!-- editFact Modal content-->
      <div class="modal-content">
        <div class="modal-body">
              <form method="POST" action="/branches/{{ $branch->id }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                  <div class="appear midContainerContent">
                    <div class="form-group">
                      <label>Edit Quick Facts</label>
                      <textarea name="body" class="form-control" placeholder="Please enter quick facts here" >{{ $branch->facts }}</textarea>
                    </div>
                  </div>
                  <div class="editContent">
                    <div class="editContentButton">
                      <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Submit</button>
                    </div>
                  </div> 
            </form>
        </div>
      </div>
      
    </div>
</div>



<!-- ADD MODALS -->
<!-- addEdu Modal -->
<div class="modal fade" id="addEdu" role="dialog">
    <div class="modal-dialog">

      <!-- addEdu Modal content-->
      <div class="modal-content">
        <div class="modal-body">
              <form method="POST" action="/branches/{{ $branch->id }}/leaves">
                {{ csrf_field() }}
                  <div class="appear midContainerContent">
                    <div class="form-group">
                      <label>Add Educational Content</label>
                      <input type="text" name="title" class="form-control" placeholder="Enter title for content" >
                    </div>
                    <div class="form-group">
                      <label>Link</label>
                      <input type="text" name="link" class="form-control" placeholder="Enter URL of content" >
                    </div>
                    <div class="form-group hidden">
                      <label>Type</label>
                      <input type="text" name="type" class="form-control" value="edu" readonly>
                    </div>
                  </div>
                  <div class="editContent">
                    <div class="editContentButton">
                      <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Add</button>
                    </div>
                  </div> 
            </form>
        </div>
      </div>
      
    </div>
</div>



<!-- addTut Modal -->
<div class="modal fade" id="addTut" role="dialog">
    <div class="modal-dialog">

      <!-- addTut Modal content-->
      <div class="modal-content">
        <div class="modal-body">
              <form method="POST" action="/branches/{{ $branch->id }}/leaves">
                {{ csrf_field() }}
                <div class="appear midContainerContent">                
                    <div class="form-group">
                      <label>Add Problem Set / Tutorial / Past Paper</label>
                      <input type="text" name="title" class="form-control" placeholder="Enter title for content" >
                    </div>
                    <div class="form-group">
                      <label>Link</label>
                      <input type="text" name="link" class="form-control" placeholder="Enter URL of content" >
                    </div>
                    <div class="form-group hidden">
                      <label>Type</label>
                      <input type="text" name="type" class="form-control" value="tut" readonly>
                    </div>
                </div>
                <div class="editContent">
                  <div class="editContentButton">
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Add</button>
                  </div>
                </div>
            </form>
        </div>
      </div>
      
    </div>
</div>



<!-- addVid Modal -->
<div class="modal fade" id="addVid" role="dialog">
    <div class="modal-dialog">

      <!-- addVid Modal content-->
      <div class="modal-content">
        <div class="modal-body">
              <form method="POST" action="/branches/{{ $branch->id }}/leaves">
                {{ csrf_field() }}
                <div class="appear midContainerContent">
                    <div class="form-group">
                      <label>Add Teaching Video / Animation / Picture</label>
                      <input type="text" name="title" class="form-control" placeholder="Enter title for content" >
                    </div>
                    <div class="form-group">
                      <label>Link</label>
                      <input type="text" name="link" class="form-control" placeholder="Enter URL of content" >
                    </div>
                    <div class="form-group hidden">
                      <label>Type</label>
                      <input type="text" name="type" class="form-control" value="vid" readonly>
                    </div>
                </div>
                <div class="editContent">
                  <div class="editContentButton">
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Add</button>
                  </div>
                </div>
            </form>
        </div>
      </div>
      
    </div>
</div>



<!--addAdd Modal -->
<div class="modal fade" id="addAdd" role="dialog">
    <div class="modal-dialog">

      <!-- addAdd Modal content-->
      <div class="modal-content">
        <div class="modal-body">
              <form method="POST" action="/branches/{{ $branch->id }}/leaves">
                {{ csrf_field() }}
                <div class="appear midContainerContent">
                    <div class="form-group">
                      <label>Add Further Reading / Additional Information</label>
                      <input type="text" name="title" class="form-control" placeholder="Enter title for content" >
                    </div>
                    <div class="form-group">
                      <label>Link</label>
                      <input type="text" name="link" class="form-control" placeholder="Enter URL of content" >
                    </div>
                    <div class="form-group hidden">
                      <label>Type</label>
                      <input type="text" name="type" class="form-control" value="add" readonly>
                    </div>
                </div>
                <div class="editContent">
                  <div class="editContentButton">
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Add</button>
                  </div>
                </div>
            </form>
        </div>
      </div>
      
    </div>
</div>



<!-- DEL MODALS -->
<!-- delEdu Modal -->
<div class="modal fade" id="delEdu" role="dialog">
    <div class="modal-dialog">

      <!-- delEdu Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          {!! Form::open(['method' => 'DELETE', 'route'=>['delete-leaf', $branch]]) !!}
              <div class="appear midContainerContent">
                <div class="form-group">
                  {!! Form::label('Select Educational Content To Delete') !!}
                  {!! Form::select('id', $allInfoContents, old('id'), ['class'=>'form-control', 'placeholder'=>'Select content']) !!}
                </div>
              </div>
              <div class="editContent">
                <div class="editContentButton"><button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Delete</button></div>
              </div> 
          {!! Form::close() !!}
        </div>
      </div>
      
    </div>
</div>



<!-- delTut Modal -->
<div class="modal fade" id="delTut" role="dialog">
    <div class="modal-dialog">

      <!-- delTut Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          {!! Form::open(['method' => 'DELETE', 'route'=>['delete-leaf', $branch]]) !!}
              <div class="appear midContainerContent">
                <div class="form-group">
                  {!! Form::label('Select Problem Set / Tutorial / Past Paper To Delete') !!}
                  {!! Form::select('id', $allInfoTutorials, old('id'), ['class'=>'form-control', 'placeholder'=>'Select content']) !!}
                </div>
              </div>
              <div class="editContent">
                <div class="editContentButton">
                  <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Delete</button>
                </div>
              </div> 
          {!! Form::close() !!}
        </div>
      </div>
      
    </div>
</div>



<!-- delVid Modal -->
<div class="modal fade" id="delVid" role="dialog">
    <div class="modal-dialog">

      <!-- delVid Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          {!! Form::open(['method' => 'DELETE', 'route'=>['delete-leaf', $branch]]) !!}
              <div class="appear midContainerContent">
                <div class="form-group">
                  {!! Form::label('Select Teaching Video / Animation / Picture To Delete') !!}
                  {!! Form::select('id', $allInfoVideos, old('id'), ['class'=>'form-control', 'placeholder'=>'Select content']) !!}
                </div>
              </div>
              <div class="editContent">
                <div class="editContentButton">
                  <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Delete</button>
                </div>
              </div> 
          {!! Form::close() !!}
        </div>
      </div>
      
    </div>
</div>



<!-- delAdd Modal -->
<div class="modal fade" id="delAdd" role="dialog">
    <div class="modal-dialog">

      <!-- delAdd Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          {!! Form::open(['method' => 'DELETE', 'route'=>['delete-leaf', $branch]]) !!}
            <div class="appear midContainerContent">
              <div class="form-group">
                {!! Form::label('Select Further Reading / Additional Information') !!}
                {!! Form::select('id', $allInfoContentAdds, old('id'), ['class'=>'form-control', 'placeholder'=>'Select content']) !!}
              </div>
            </div>
            <div class="editContent">
              <div class="editContentButton">
                <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Delete</button>
              </div>
            </div> 
          {!! Form::close() !!}
        </div>
      </div>
      
    </div>
</div>



<!-- REN MODALS -->
<!-- renEdu Modal -->
<div class="modal fade" id="renEdu" role="dialog">
    <div class="modal-dialog">

      <!-- renEdu Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          {!! Form::open(['method' => 'PATCH', 'route'=>['rename-leaf', $branch]]) !!}
              <div class="appear midContainerContent">
                <div class="form-group">
                  {!! Form::label('Select Educational Content To Rename') !!}
                  {!! Form::select('id', $allInfoContents, old('id'), ['class'=>'form-control', 'placeholder'=>'Select content']) !!}
                </div>
                <div class="form-group">
                  <label>New Name for Educational Content</label>
                  <input type="text" name="title" class="form-control" placeholder="Enter title for content" >
                </div>
              </div>
              <div class="editContent">
                <div class="editContentButton"><button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Rename</button></div>
              </div> 
          {!! Form::close() !!}
        </div>
      </div>
      
    </div>
</div>



<!-- renTut Modal -->
<div class="modal fade" id="renTut" role="dialog">
    <div class="modal-dialog">

      <!-- renTut Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          {!! Form::open(['method' => 'PATCH', 'route'=>['rename-leaf', $branch]]) !!}
              <div class="appear midContainerContent">
                <div class="form-group">
                  {!! Form::label('Select Problem Set / Tutorial / Past Paper To Rename') !!}
                  {!! Form::select('id', $allInfoTutorials, old('id'), ['class'=>'form-control', 'placeholder'=>'Select content']) !!}
                </div>
                <div class="form-group">
                  <label>New Name for Problem Set / Tutorial / Past Paper</label>
                  <input type="text" name="title" class="form-control" placeholder="Enter title for content" >
                </div>
              </div>
              <div class="editContent">
                <div class="editContentButton">
                  <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Rename</button>
                </div>
              </div> 
          {!! Form::close() !!}
        </div>
      </div>
      
    </div>
</div>



<!-- renVid Modal -->
<div class="modal fade" id="renVid" role="dialog">
    <div class="modal-dialog">

      <!-- renVid Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          {!! Form::open(['method' => 'PATCH', 'route'=>['rename-leaf', $branch]]) !!}
              <div class="appear midContainerContent">
                <div class="form-group">
                  {!! Form::label('Select Teaching Video / Animation / Picture To Rename') !!}
                  {!! Form::select('id', $allInfoVideos, old('id'), ['class'=>'form-control', 'placeholder'=>'Select content']) !!}
                </div>
                <div class="form-group">
                  <label>New Name for Teaching Video / Animation / Picture</label>
                  <input type="text" name="title" class="form-control" placeholder="Enter title for content" >
                </div>
              </div>
              <div class="editContent">
                <div class="editContentButton">
                  <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Rename</button>
                </div>
              </div> 
          {!! Form::close() !!}
        </div>
      </div>
      
    </div>
</div>



<!-- renAdd Modal -->
<div class="modal fade" id="renAdd" role="dialog">
    <div class="modal-dialog">

      <!-- renAdd Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          {!! Form::open(['method' => 'PATCH', 'route'=>['rename-leaf', $branch]]) !!}
            <div class="appear midContainerContent">
              <div class="form-group">
                {!! Form::label('Select Further Reading / Additional To Rename') !!}
                {!! Form::select('id', $allInfoContentAdds, old('id'), ['class'=>'form-control', 'placeholder'=>'Select content']) !!}
              </div>
              <div class="form-group">
                  <label>New Name for Further Reading / Additional</label>
                  <input type="text" name="title" class="form-control" placeholder="Enter title for content" >
                </div>
            </div>
            <div class="editContent">
              <div class="editContentButton">
                <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Rename</button>
              </div>
            </div> 
          {!! Form::close() !!}
        </div>
      </div>
      
    </div>
</div>



