@include('/layouts/header')
<style>
  .login-page{
    background-image: url('/img/app/iStock-500663898.jpg');
    background-size: cover;
    background-repeat: no-repeat;
  }
</style>
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="/" class="TechLab"><span style="color:#367fa9;">{{ AppFirstName() }}</span style="color: #777;">{{ AppLastName() }}</a>
      </div>

        <div class="panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Name">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email">
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                           <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                           </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <a href="/login"><i class="fa fa-long-arrow-left"></i> Login</a>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </div>
@include('/layouts/footer')