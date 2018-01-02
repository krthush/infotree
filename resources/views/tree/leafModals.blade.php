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
                      <label>Add Tutorials Or Problem Sets</label>
                      <input type="text" name="title" class="form-control" placeholder="Enter title for tutorial sheet/problem set" >
                    </div>
                    <div class="form-group">
                      <label>Link</label>
                      <input type="text" name="link" class="form-control" placeholder="Enter URL of tutorial sheet/problem set" >
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
                      <label>Add Useful Videos</label>
                      <input type="text" name="title" class="form-control" placeholder="Enter title for video" >
                    </div>
                    <div class="form-group">
                      <label>Link</label>
                      <input type="text" name="link" class="form-control" placeholder="Enter URL of video" >
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
                      <label>Add any other additional useful content</label>
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
                  {!! Form::select('id', $allInfoContents, old('id'), ['class'=>'form-control', 'placeholder'=>'Select Content']) !!}
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
                  {!! Form::label('Select Tutorial Content To Delete') !!}
                  {!! Form::select('id', $allInfoTutorials, old('id'), ['class'=>'form-control', 'placeholder'=>'Select Content']) !!}
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
                  {!! Form::label('Select Video Content To Delete') !!}
                  {!! Form::select('id', $allInfoVideos, old('id'), ['class'=>'form-control', 'placeholder'=>'Select Content']) !!}
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
                {!! Form::label('Select Additional Content To Delete') !!}
                {!! Form::select('id', $allInfoContentAdds, old('id'), ['class'=>'form-control', 'placeholder'=>'Select Content']) !!}
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



