<div class="col-md-2 smallpadding">
    @isset($infoContents)
    <div class="panel-group hidden-sm hidden-xs" aria-multiselectable="true">
      <div class="panel panel-default">
        <a href="{{ route('tree', $tree) }}" class="sidebarButtons" id="sidebarButton1">{{ $tree->title }}</a>
        <div id="sidebarContent1" class="panel-collapse collapse">
          <div class="panel-body">Return To Current Tree</div>
        </div>
      </div>
    </div>
    <div class="midContainer hidden-sm hidden-xs">
      <div class="midContainerHeader">
        <div class="midContainerHeaderText" id="branchTitle" data-title="{{ $branch->title }}" data-id="{{ $branch->id }}">Navigation</div>
      </div>
      <div class="midContainerContent jstreeSidebar">
        <div>
          <input class="search-input form-control short" placeholder="Search">
        </div>
        <div id="jstreeSidebar">
          <ul>
              @foreach($branches as $branch)
                  <li class="leaf" id="{{ $branch->id }}">
                      <a href="/branches/{{ $branch->id }}">{{ $branch->title }}</a>
                      @if(count($branch->childs))
                          @include('tree.showBranchChildren',['childs' => $branch->childs])
                      @endif
                  </li>
              @endforeach
          </ul>
        </div>
      </div>
    </div>      
    @else
        <div class="panel-group hidden-sm hidden-xs" aria-multiselectable="true">    
          <div class="panel panel-default">
            <a href="{{ route('mytree') }}" class="sidebarButtons" id="sidebarButton1">My Tree</a>
            <div id="sidebarContent1" class="panel-collapse collapse">
              <div class="panel-body">Navigate to your favourite Tree</div>
            </div>
          </div>  
          <div class="panel panel-default">
            <a href="{{ route('trees') }}" class="sidebarButtons" id="sidebarButton2">All Trees</a>
            <div id="sidebarContent2" class="panel-collapse collapse">
              <div class="panel-body">Look through all shared trees to see how other's learn</div>
            </div>
          </div>
          <div class="panel panel-default">
            <a href="{{ route('devblog') }}" class="sidebarButtons" id="sidebarButton3">Dev Blog</a>
            <div id="sidebarContent3" class="panel-collapse collapse">
              <div class="panel-body">Learn about infotree's progress and development</div>
            </div>
          </div>

          <div class="panel panel-default">
            <a href="{{ route('contact') }}" class="sidebarButtons" id="sidebarButton4">Contact</a>
            <div id="sidebarContent4" class="panel-collapse collapse">
              <div class="panel-body">Report bugs or enquiries</div>
            </div>
          </div>
        </div>
    @endisset
</div>