@extends('layouts.master')

@section('content')

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

<div class="col-md-10 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">Register</div>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

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
                        <input id="password" type="password" class="form-control" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <a data-toggle="modal" data-target="#register">
                            <button class="btn btn-primary" type="button">
                                Register
                            </button>
                        </a>
                    </div>
                </div>

                <div class="modal fade" id="register" role="dialog">
                    <div class="modal-dialog">

                      <!-- add Modal content-->
                      <div class="modal-content">
                        <div class="modal-body">
                                <div class="appear midContainerContent">

                                    <label>The use of this website is subject to the following terms of use:</label>

                                    <ul>
                                        
                                        <li>By registering you agree to these terms and conditions.</li>

                                        <li>The content of the pages of this website is for your general information and use only. It is subject to change without notice.</li>

                                        <li>This website uses cookies to monitor browsing preferences. If you do allow cookies to be used, personal information may be stored by us to further improve your browsing experience.</li>

                                        <li>Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.</li>

                                        <li>Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.</li>

                                        <li>This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.</li>

                                        <li>All trade marks reproduced in this website which are not the property of, or licensed to, the operator are acknowledged on the website.</li>

                                        <li>Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.</li>

                                        <li>This website will also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).</li>

                                        <li>Your use of this website and any dispute arising out of such use of the website is subject to the laws of England, Northern Ireland, Scotland and Wales.</li>

                                    </ul>
                                </div>
                                <div class="editContent">
                                    <div class="editContentButton">
                                        <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">
                                            Register
                                        </button>
                                    </div>
                                </div>
                        </div>
                      </div>
                      
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });
</script>

@endsection
