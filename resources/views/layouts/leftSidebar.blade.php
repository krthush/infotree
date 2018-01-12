<div class="col-md-2">
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
  @isset($infoContents)
        <div class="splitter"></div>

        <div class="stack midContainer">
            <div class="midContainerHeader">
                <div class="midContainerHeaderText">Tree Navigation</div>
            </div>
            <div class="midContainerContent">
              <div>Return To Current Tree:</div>
              <ul class="list">
                  <a href="{{ route('tree', $tree) }}">{{ $tree->title }}</a>
              </ul>
              <div>Previous Branches:</div>
              <ul class="list">
                  @foreach($parents as $parent)
                      <li>
                          <a href="{{ route('leaves',$parent->id) }}" >{{ $parent->title }}</a>
                      </li>
                  @endforeach
                  @if(count($parents) === 0)
                      <li>There is no parent branch!</li>
                  @endif
              </ul>
              <div>Further Branches:</div>
              <ul class="list">
                  @foreach($children as $child)
                      <li>
                          <a href="{{ route('leaves',$child->id) }}" >{{ $child->title }}</a>
                      </li>
                  @endforeach
                  @if(count($children) === 0)
                      <li>There are no children branches!</li>
                  @endif
              </ul>                    
            </div>               
        </div>   
  @endisset()
</div>