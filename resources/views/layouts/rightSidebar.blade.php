<div class="col-md-2 smallpadding">
    
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


<div class="modal fade" id="newTree" role="dialog">
    <div class="modal-dialog">
      <!-- newtree Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <form id="addTreeForm" name="addTreeForm" method="POST" onsubmit="" onreset="" action="{{ route('new-tree') }}">
                    {{ csrf_field() }}
                    <div class="appear midContainer">
                        <div class="appear midContainerContent">
                            <div class="form-group">
                                <label>Create New Tree</label>
                                <input class="form-control" type="text" name="title" placeholder="Enter name of new tree" >
                            </div>
                                <small class="form-text text-muted">Create a fresh new tree that has no prior links.</small>             
                        </div>
                        <div class="editContent">
                            <div class="editContentButton">
                                <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">New Tree</button>                            
                            </div>
                        </div>
                    </div>
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
                <div class="appear midContainer">
                    {!! Form::open(['route' => 'delete-tree', 'method' => 'DELETE']) !!}
                            <div class="appear double midContainerContent">
                                <div class="form-group">
                                    {!! Form::label('Delete Tree') !!}
                                    {!! Form::select('id', $selectUserTrees, old('id'), ['class'=>'form-control', 'placeholder'=>'Select Tree']) !!}
                                </div>
                            </div>
                            <div class="editContent">
                                <div class="editContentButton">
                                    <button class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Delete Tree</button>
                                </div>
                            </div>
                    {!! Form::close()  !!}
                </div>
                
                @isset($selectSharedTrees)
                <div class="appear midContainer">
                    {!! Form::open(['route' => 'delete-tree', 'method' => 'DELETE']) !!}
                                <div class="appear double midContainerContent">
                                    <div class="form-group">
                                        {!! Form::label('Delete Shared Tree') !!}
                                        {!! Form::select('id', $selectSharedTrees, old('id'), ['class'=>'form-control', 'placeholder'=>'Select Tree']) !!}
                                    </div>
                                </div> 
                            <div class="editContent">
                                <div class="editContentButton">
                                    <button class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Delete Tree</button>
                                </div>
                            </div>
                    {!! Form::close()  !!}
                </div>
                @endisset($selectSharedTrees)
            </div>
        </div>          
    </div>
</div>