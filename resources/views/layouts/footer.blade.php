<footer class="footer">
	<span class="left footer"> &copy; Copyright 2017 <a class="footerLegal" href="{{ route('legal') }}">T&Cs</a> <a class="footerLegal" href="{{ route('license') }}">Licenses & Accreditations</a></span>
	<span class="right footer"> Website by Thushaan Rajaratnam </span>
</footer>
</div>

<!-- Bootstrap -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Custom JS -->
<script src="/js/custom.js"></script>
<!-- Masonary Script -->
<script src="/js/masonry.pkgd.min.js"></script>

<script>
	$(function() {
			
		$('[data-toggle="tooltip"]').tooltip();
		
	    $('#showMoreButton1').click( function() {
	        $("#filteredSharedTrees").hide();
	        $("#sharedTrees").show();
	        $("#showMoreContainer1").hide();
	        $("#showLessContainer1").show();
	    });
		$('#showLessButton1').click( function() {
	        $("#filteredSharedTrees").show();
	        $("#sharedTrees").hide();
	        $("#showMoreContainer1").show();
	        $("#showLessContainer1").hide();
	    });
	    $('#showMoreButton2').click( function() {
	        $("#filteredSharedTrees").hide();
	        $("#sharedTrees").show();
	        $("#showMoreContainer2").hide();
	        $("#showLessContainer2").show();
	    });
		$('#showLessButton2').click( function() {
	        $("#filteredSharedTrees").show();
	        $("#sharedTrees").hide();
	        $("#showMoreContainer2").show();
	        $("#showLessContainer2").hide();
	    });
		$('#showAllButton1').click( function() {
			window.location.replace("http://homestead.app/trees")
	    });
		$('#showAllButton2').click( function() {
			window.location.replace("http://homestead.app/trees")
	    });

	    $('.grid').masonry({
		  // options
		  itemSelector: '.grid-item'
		});

	});
</script>
<script type="text/javascript">
	function submitForm(action) {
		var form = document.getElementById('addTreeForm');
		form.action = action;
		form.submit();
	}

</script>
<script>
	$(window).scroll(function() {
		sessionStorage.scrollTop = $(this).scrollTop();
	});
</script>

@isset($infoContents)
<script>     
	$(function() {

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
                "show_only_matches" : true,
                "show_only_matches_children" : true,
			}
		}).bind("select_node.jstree", function (e, data) {
		  	var href = data.node.a_attr.href;
		  	document.location.href = href;
		});

		var branchId = $('#branchTitle').data("id");
	    setTimeout(function() {
			$('#jstreeSidebar').jstree('search', branchId);
	    }, 100);

	    $("#jstreeSidebar").jstree().open_node(branchId);

		if (sessionStorage.scrollTop != "undefined") {
			$(window).scrollTop(sessionStorage.scrollTop);
		}

	});
</script>
@endisset