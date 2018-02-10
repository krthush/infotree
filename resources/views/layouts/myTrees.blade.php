<div class="midContainer topStack">
    <div class="midContainerHeader">
        <div class="midContainerHeaderText">My Trees</div>
        <div class="midContainerHeaderButtonContainer" id="treeButtonsTop1">
            <div class="midHeaderButton" data-toggle="tooltip" title="Delete Tree">
                <a data-toggle="modal" data-target="#deleteTree">
                    <button class="btn btn-primary" type="button">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                </a>
            </div>
             <div class="midHeaderButton" data-toggle="tooltip" title="New Tree">
                <a data-toggle="modal" data-target="#newTree">
                    <button class="btn btn-primary" type="button">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </a>
            </div>               
        </div>
    </div>
    <div class="edit midContainerContent">
        <ul class="list">
            @if(count($userTrees) === 0)
                <p>You currently have no trees! Please create a tree using the controls below.</p>
            @endif
            @foreach($userTrees as $userTree)
                <li>
                    <a href="/tree/{{ $userTree->id }}">{{ $userTree->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="editContent" id="treeButtonsBottom1">
        <div class="midHeaderButton" data-toggle="tooltip" title="Delete Tree">
            <a data-toggle="modal" data-target="#deleteTree">
                <button class="btn btn-primary" type="button">
                    <span class="glyphicon glyphicon-minus"></span>
                </button>
            </a>
        </div>
         <div class="midHeaderButton" data-toggle="tooltip" title="New Tree">
            <a data-toggle="modal" data-target="#newTree">
                <button class="btn btn-primary" type="button">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </a>
        </div>
    </div> 
</div>