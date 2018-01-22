<div class="col-md-2">
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
        <div class="midContainerHeaderText">Navigation</div>
      </div>
      <div class="midContainerContent jstreeSidebar">
        <div>
          <input class="search-input form-control short" value="{{ $branch->title }}">
        </div>
        <div id="jstreeSidebar">
          <ul>
              @foreach($branches as $branch)
                  <li class="leaf">
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

      <script>     
          $( window ).on( "load", function() {
              var searchString = $(".search-input").val();
              $('#jstreeSidebar').jstree('search', searchString);
          });

          $(function () {

              $(".search-input").keyup(function() {
                  var searchString = $(this).val();
                  $('#jstreeSidebar').jstree('search', searchString);
              });

              $('#jstreeSidebar').jstree({
                  // Plugins
                  "plugins" : ["noselectedstate", "types", "search", "show_matches_children"],
                  // Parameters
                  "core" : { 
                      "check_callback" : false,
                      "dblclick_toggle" :false,
                      "themes" : {
                          "name" : "proton",
                          "responsive" : "true",
                      }
                  },
                  "types" : {
                      "default" : {
                          "icon" : "glyphicon glyphicon-leaf"
                      }
                  },
                  "search": {
                      "case_insensitive": true,
                      // "fuzzy" : true
                  }
              }).bind("select_node.jstree", function (e, data) {
                  var href = data.node.a_attr.href;
                  document.location.href = href;
              });
          });
      </script>
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