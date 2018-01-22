<div class="midContainer topStack">
    <div class="midContainerHeader">
        <div class="midContainerHeaderText">Shared Trees</div>
        <div id="treeButtonsTop2">
            <div class="midContainerHeaderButtonContainer" id="showMoreContainer1">
                 <div class="midHeaderButton" data-toggle="tooltip" title="Show More">
                    <button class="btn btn-primary" type="button" id="showMoreButton1">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </button>
                </div>               
            </div>

            <div class="midContainerHeaderButtonContainer" id="showLessContainer1">
                <div class="midHeaderButton" data-toggle="tooltip" title="Show All">
                    <button class="btn btn-primary" type="button" id="showAllButton1">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </button>
                </div>
                <div class="midHeaderButton" data-toggle="tooltip" title="Show Less">
                    <button class="btn btn-primary" type="button" id="showLessButton1">
                        <span class="glyphicon glyphicon-eye-close"></span>
                    </button>
                </div>               
            </div>
        </div>
    </div>
        <div class="edit midContainerContent" id="sharedTrees">
            <ul class="list">
                @foreach($sharedTrees as $sharedTree)
                    <li>
                        <a href="/tree/{{ $sharedTree->id }}">
                            {{ $sharedTree->title }}
                            @if ($sharedTree->global === 1)
                                <span class="rightSideBar glyphicon glyphicon-globe"></span>
                            @else
                                <span class="rightSideBar glyphicon glyphicon-user"></span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>                    
        </div>
        <div class="edit midContainerContent" id="filteredSharedTrees">
            <ul class="list">
                @foreach($filteredSharedTrees as $filteredSharedTree)
                    <li>
                        <a href="/tree/{{ $filteredSharedTree->id }}">
                            {{ $filteredSharedTree->title }}
                            @if ($filteredSharedTree->global === 1)
                                <span class="rightSideBar glyphicon glyphicon-globe"></span>
                            @else
                                <span class="rightSideBar glyphicon glyphicon-user"></span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>                    
        </div>
        <div class="editContent" id="treeButtonsBottom2">
                <div id="showMoreContainer2">
                     <div class="midHeaderButton" data-toggle="tooltip" title="Show More">
                        <button class="btn btn-primary" type="button" id="showMoreButton2">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </div>               
                </div>

                <div id="showLessContainer2">
                    <div class="midHeaderButton" data-toggle="tooltip" title="Show All">
                        <button class="btn btn-primary" type="button" id="showAllButton2">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </div>
                    <div class="midHeaderButton" data-toggle="tooltip" title="Show Less">
                        <button class="btn btn-primary" type="button" id="showLessButton2">
                            <span class="glyphicon glyphicon-eye-close"></span>
                        </button>
                    </div>               
                </div>
        </div> 
</div>