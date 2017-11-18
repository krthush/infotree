<div class="midContainerHeader">
    <div class="midContainerHeaderText">
        {{ $tree->title }}'s Branches 
    </div>
    <div class="right dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            <span class="glyphicon glyphicon-edit">&ensp;</span><span class="caret"></span>
        </button>
      <ul class="dropdown-menu">
        <li><a href="{{ route('add-branch', $tree) }}">Add</a></li>
        <li><a href="{{ route('delete-branch', $tree) }}">Delete</a></li>
        <li><a href="{{ route('move-branch', $tree) }}">Move</a></li>
        <li><a href="{{ route('rename-branch', $tree) }}">Rename</a></li>
      </ul>
    </div>
</div>