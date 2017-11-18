<nav class="short navbar navbar-default hidden-xs hidden-sm"> <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
    <a class="navbar-brand" href="/">infotree</a></div>
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="topFixedNavbar1">
    <ul class="nav navbar-nav navbar-right">
      @if (Route::has('login'))
        @auth
            <li><a href="{{ route('home') }}">{{ Auth::user()->name }}</a></li>
            <li><a href="{{ route('logout') }}">Log Out</a></li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @endauth
      @endif
      <li><a href="{{ route('about') }}">About</a></li>
    </ul>         
  </div>
  <!-- /.navbar-collapse -->
</nav>
<nav class="navbar navbar-default navbar-fixed-top hidden-md hidden-lg"> <!-- Brand and toggle get grouped for better mobile display -->
  <div id="navLeftPad"  class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar2" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
    <a class="navbar-brand" href="/">infotree</a></div>
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="topFixedNavbar2">
    <ul class="nav navbar-nav navbar-right">
      <li><a href="">My Tree</a></li>
      <li><a href="{{ route('devblog') }}">Dev Blog</a></li>
<!--       <li><a href="/question">Question</a></li>
      <li><a href="/answer">Answer</a></li> -->
      @if (Route::has('login'))
        @auth
            <li><a href="{{ route('home') }}">{{ Auth::user()->name }}</a></li>
            <li><a href="{{ route('logout') }}">Log Out</a></li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @endauth
      @endif
      <li id="navRightPad"><a href="{{ route('about') }}">About</a></li>
     </ul>          
  </div>
  <!-- /.navbar-collapse -->
</nav>