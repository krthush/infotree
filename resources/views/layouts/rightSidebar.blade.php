<div class="col-md-2">
    
	<div class="midContainer hidden-xs hidden-sm">
		<div class="midContainerHeader">
			<div class="midContainerHeaderText">University Trees</div>
		</div>
		   	<div class="edit midContainerContent">
            	<ul class="list">
                    @foreach($uniTrees as $uniTree)
                        <li>
                            <a href="/tree/{{ $uniTree->id }}">{{ $uniTree->title }}</a>
                        </li>
                    @endforeach
                </ul>                    
            </div> 
	</div>
    <div class="midContainer topStack hidden-lg hidden-md">
        <div class="midContainerHeader">
            <div class="midContainerHeaderText">University Trees</div>
        </div>
            <div class="edit midContainerContent">
                <ul class="list">
                    @foreach($uniTrees as $uniTree)
                        <li>
                            <a href="/tree/{{ $uniTree->id }}">{{ $uniTree->title }}</a>
                        </li>
                    @endforeach
                </ul>                    
            </div> 
    </div>

    @include ('layouts.myTrees')

    @include ('layouts.sharedTrees')

</div>


<div class="modal fade" id="addTree" role="dialog">
    <div class="modal-dialog">
      <!-- newtree Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <form id="addTreeForm" name="addTreeForm" method="POST" onsubmit="" onreset="" action="">
                    {{ csrf_field() }}
                    <div class="appear midContainer">
                        <div class="appear double midContainerContent">
                            <div class="form-group">
                                <label>Create New Tree</label>
                                <input class="form-control" type="text" name="title" placeholder="Enter name of new tree" >
                            </div>
                            @isset($tree)
                                <small class="form-text text-muted">Selecting "Clone New Tree" creates a new tree based on current shared tree that is being viewed</small>
                            @endisset                        
                        </div>
                        <div class="editContent">
                            <div class="editContentButton">
                                @isset($tree)
                                <button class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; submitForm('/{{ $tree->id }}/clone-tree')">Clone New Tree</button>
                                @endisset
                                <button class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; submitForm('/tree/new-tree')">New Tree</button>                            
                            </div>
                        </div>
                    </div>
                    @isset($tree)
                    <div class="appear midContainer">
                        <div class="appear double midContainerContent">
                            <div class="form-group">
                                {!! Form::label('Add To Tree') !!}
                                {!! Form::select('userTreeId', $selectUserTrees, old('userTreeId'), ['class'=>'form-control', 'placeholder'=>'Select Tree To Add To']) !!}
                            </div>
                            <small class="form-text text-muted">Selecting "Add To Tree" adds the current shared tree that is being viewed to the selected tree</small>                       
                        </div>
                        <div class="editContent">
                            <div class="editContentButton">
                                <button class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; submitForm('/{{ $tree->id }}/add-tree')">Add To Tree</button>
                            </div>
                        </div>
                    </div>
                    @endisset($tree) 
                </form>
            </div>
        </div>       
    </div>
</div>

<div class="modal fade" id="deleteTree" role="dialog">
    <div class="modal-dialog">
          <!-- deletetree Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                {!! Form::open(['method' => 'DELETE', 'route'=>'delete-tree']) !!}
                    <div class="appear midContainerContent">
                        <div class="form-group">
                            {!! Form::label('Delete Tree') !!}
                            {!! Form::select('id', $selectUserTrees, old('id'), ['class'=>'form-control', 'placeholder'=>'Select Tree']) !!}
                        </div>                      
                    </div>
                    <div class="editContent">
                        <div class="editContentButton">
                            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Delete Tree</button>                            
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>          
    </div>
</div>