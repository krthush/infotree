@extends('layouts.app')

@section('content')
<!--Welcome content-->

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <ul>
            @foreach ($errors->all() as $error)
                <li><strong>{{ $error }}</strong></li>
            @endforeach
        </ul>
    </div>
@endif

<div class="midContainer">
  <div class="midContainerHeader">
      <div class="midContainerHeaderText"><b>Dev Blog</b></div>
    </div>
    <div class="midContainerContent">
        <h3>CURRENT MAJOR TASKS:</h3>

        <ul>

        	<li>Add in "duplicate" branch option, to be able to let users copy branches</li>

        	<li>Add SAML ("single sign on") login so imperial users can create/login accounts using imperial account</li>

        	<li>Implement scraping tool that searches through an admin level blackboard account, checking for updates and then automatically implements them into infotree daily. HIGHLIGHLY recommended that a already existing tool is used (free if possible) and it is OKAY to spend funds on it, many tools already work well, don't waste major resource of TIME on reinventing the wheel.</li>

		</ul>

        <h3>PLANNED MAJOR TASKS:</h3>

        <ul>

        	<li>Add a navigation "overview" which shows how user has reach current leaf through branches from root</li>

        	<li>Add "edit linked" branches (e.g. users can link certain branches to university so that when they are updated, only they get updated but they can edit other branches</li>      	

			<li>Add a scrolling list of updates below university trees to let user know what changes are being made to university trees.</li>

			<li>Improve search engine feature for searching branches such that leaf links are also suggested</li>

			<li>Add a filters section to shared trees - allow users to change rating cut off?</li>

			<li>Add &#34;year&#34; class for branches/leaves - to sort content out by year, make sure to make it such that higher years can still see lower year shared content just with less priority (i.e. only shown if &#34;show more&#34; selected + higher popularity limit)</li>

			<li>Leaf page needs better UI in general, add editing overlay for leaf page (just one button on top left "edit") then all "add"s appear and Xs appear for deletion, also allow for reordering of list (maybe use sortable?) - this will also lead to CLEAN UP of multiple pages. Maybe add a feature where you can create "leaf types" so user can choose what type of information to collect together (like videos, lectures, etc)</li>

        	<li>Work on securing DO server</li>

			<li>Optimization required, <a href="https://developers.google.com/speed/pagespeed/insights/">google insights</a></li>

			<li>CSS needs CLEAN UP, needs a lot more functionality/better naming system</li>

			<li>Use AJAX everywhere (e.g. start with favourite button, editing overlays, e.t.c) to make whole website more fluids - fewer pages everything done in sync</li>

			<li>Look into to GET vs. PATCH, especially for the likes (atm likes uses get whereas share/favourite uses patch) - this should be a non-problem if AJAX is used for all also preventing use of Read-Only inputs</li>

			<li>Check into safety of using Read-Only inputs, CRSF token should protect against people forging post requests with different inputs</li>

        	<li>Better method of creating Super Admin -> currently based of off first ever created user</li>

        	<li>Controller methods have repeated code for Admin access, just create a permission using "Roles" addon so that permissions can be given to users/admins dependant on the situation</li>

        	<li>Let users create "automated" timed uploads/updates (i.e. material is uploaded automatically at different times of the year), make sure to combine this with ranking features</li>

        	<li>Allow for updates/merging of similar trees much like what github does (i.e. let users propose revisions to trees, which admins can allow)</li>

		</ul>		

		<h3>PLANNED MINOR TASKS:</h3>

		<ul>

			<li>Make errors on forms consist, atm double errors shown - some in form and some as closeable box</li>

			<li>Update front page - use tree idea - simple vector of tree overarching login page</li>
			
			<li>Move 'interesting' video carousel elsewhere</li>

			<li>Social media sharing button to generate links</li>

			<li>Fix ordering for draggable branches</li>	

			<li>Add better labels for each page (on browser tab heading)</li>
			
			<li>Fix left sidebar accordian animations (use a plugin?)</li>

			<li>Leaf controller needs some CLEAN UP when fetching leaves (many variables passed with somewhat repeated code)</li>
						
		</ul>

		<h3>KNOWN BUGS:</h3>
		<ul>

			<li>The accordian on left gets kinda screwed up if spammed on</li>

			<li>Need to fix div height issue on leaves page, see <a href="https://css-tricks.com/fluid-width-equal-height-columns/">css-tricks</a></li>

			<li>Enterering is prevented on registration form so that users are forced to view modal with terms and conditions</li>

		</ul>
		<h3>FINISHED TASKS:</h3>
		<ul>

			<li>Implement "Clone Add" to clone tree and add it under a specific user's tree</li>

			<li>Added fixed scrolling (when pages refreshed, scroll height is stored)</li>

        	<li>Upload App onto hosting service... See if it can be managed with current siteground services. Unfortunatly currently it is likely I will require another hosting service -> try laravel forge?</li>

        	<li>Include usernames in list of shared Trees</li>

			<li>Fixed new lines/line breaks when edit facts does not work </li>

			<li>Added renaming functionality for Trees</li>

        	<li>Add a description and name section for the trees in the shared trees section</li>

			<li>Add a shared tree view/page</li>

        	<li>Add verified email migration, to allow only specific emails to test website (closed alpha)</li>

			<li>Add search that searhes ALL shared trees all at once</li>

        	<li>Add clone system to profile system</li>

			<li>Deletion of tree, deletes branches, but doesn't delete leaves of said branches</li>

			<li>Tree + Branch + Leaf controller needs CLEAN UP - repeated code, especially from repeatedly passing variables... try <a href="https://stackoverflow.com/questions/28608527/how-to-pass-data-to-all-views-in-laravel-5">stackoverflow</a> and <a href="https://laracasts.com/series/laravel-5-fundamentals/episodes/25">laracasts</a></li>

			<li>Add voting system for shared branches/leaves and heirachy system to show more popular branches/leaves higher</li>

			<li>Add &#34;shared&#34; class for branches/leaves - to specify which branches/leaves are shown or hidden specific to users... note all &#34;uni&#34; branches/leaves</li>
			
        	<li>Delete tree button</li>

			<li>Fix errors for modals so that they show a notification div when a field is empty</li>

			<li>Add profile creation system</li>

			<li>Fix &#34;uni&#34; class for branches/leaves - to specify the base setup of all branches/leaves as specified by the university. Need to find way of giving permissions to specific users</li>

			<li>Add search functionality for tree</li>
			
			<li>Fix draggable branches such that backend responds to front end edits</li>
			
			<li>Fix edit facts</li>
			
			<li>Modify editing of branch with Modals and edit overlay</li>
			
			<li>Cascade deletion required on branch page (i.e. when a parent is deleted, all children must be deleted)</li>
			
			<li>CASCADE DELETION BUG - you need include deletion of leaves as well</li>
			
			<li>Fix password RESET</li>

			<li>At approx 1400px screen width, layout starts to get messed up (things inside the right sidebar start to float ontop each other (N.B. Current fix is VERY long/messy, lot of HTML/JS/CSS repeated for different hides/shows vs. screen size)</li>

        	<li>Add SSL and Domain Name to site</li>

			<li>NEED massive overhaul to creation of university branches/leaves, currently just based off of first ever user - need to incorperate admin plugin better</li>

			<li>Find way assigning admins - allow them to edit all trees?</li>

        	<li>Add Terms and Conditions + NDA type modal when users login, make sure to mention that infotree is not liable for any damages incurred by wrong information being supplied to user + some spiel about infotree being a unique idea not to be stolen, try... <a href="https://www.nibusinessinfo.co.uk/content/business-websites-legal-requirements">nibusinessinfo</a>, <a href="https://www.rocketlawyer.co.uk/pricing.rl<">rocketlawyer</a></li>

		</ul>
    </div>
</div>
@endsection