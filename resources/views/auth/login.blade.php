<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="We provides complete solution packages 
                 for building website and online advertising.">
    <link rel="shortcut icon" href="">

    <title>Login</title>

    <!--Core CSS -->
    <link href="{{asset('public/backend/bs3/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/css/bootstrap-reset.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{asset('public/backend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet" />
</head>

  <body class="login-body">

    <div class="container">
<form class="form-horizontal form-signin" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
        <h2 class="form-signin-heading"><img  class="img-responsive admin_logo" src="{{asset('public/img/logo.png')}}" alt="Login to CMS"></h2>
        <div class="login-wrap">
            <div class="user-login-info">
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" name="email" class="form-control" placeholder="@Email" value="{{ old('email') }}" autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a href="{{ url('/password/reset') }}"> Forgot Password?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>

            

        </div>
</form>
          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix" id="password-reset" required>
                          
                          <span class="help-block">
                                <strong id="error-email"></strong>
                            </span>

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="submit">Submit</button>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
          <!-- modal -->

      

    </div>

    <!--Core js-->
    <script src="{{asset('public/backend/js/jquery.j')}}s"></script>
    <script src="{{asset('public/backend/bs3/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript">
    $('#password-reset').on('keypress change keyup paste click',function(){
      var val=$(this).val();
      $('#error-email').load("{{URL::to('emailCheck')}}?email="+val);
    });
    
    </script>

  </body>
</html>















