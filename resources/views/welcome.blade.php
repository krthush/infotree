<!DOCTYPE html>
<html lang="en">

  @include ('layouts.head')

<body>
<!--     <img src="{{url('/images/tree.jpg')}}"> -->
<!--Main responsive container for body/whole website-->  
<div class="container-fluid nomargins">

  @include ('layouts.nav')

  <!--Middle content - sidebar and central page -->
  <div class="tall headerSpace hidden-md hidden-lg"></div>


  <div class="row midSection">
    
  <!-- Left Sidebar -->  
  @include('layouts.leftSidebar')

      

    <!-- Content for page-->
    <div class="vertical-center col-md-8">


                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="midContainerHeader">
                            <div class="midContainerHeaderText">
                                <b>Welcome!</b> 
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="welcome">
                              <p class="text">
                                The open alpha version of the website is up! You can now start personalizing your study space and share it with each other.
                              </p>
                              @if (Auth::guest())
                                <p class="text">
                                  Please login or register so that you can start to use infotree!
                                </p>   
                              @endif
                              <p class="text">
                                <b>N.B. The website only houses ME2 data currently, but it serves as a proof of concept for all subjects.</b>
                              </p>
                            </div>
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">
                                            Login
                                        </button>

                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Click here to reset your password!
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

    </div>

  <!-- Right Sidebar --> 
  @if (Route::has('login'))
    @auth
        @include('layouts.rightSidebar')
    @endauth
  @endif

  </div>
  <!--Sticky footer, END of container-fluid div included in footer-->  
  @include('layouts.footer')
    <script>
        $(function () {
          document.body.style.background = "url('images/tree.png') no-repeat right top";
        });
    </script>
</body>
</html>