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
	    });
  	</script>
  	<script type="text/javascript">
	  function submitForm(action) {
	    var form = document.getElementById('addTreeForm');
	    form.action = action;
	    form.submit();
	  }
	</script>