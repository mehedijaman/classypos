@include('/layouts/header')
<style>
  .login-page{
    background-image: url('/img/app/iStock-500663898.jpg');
    /*background-image: url('/img/app/point-of-sale-system.jpg');*/
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
    <div class="panel-heading"><i class="fa fa-sign-in"></i> Login </div>
    <div class="panel-body">
      {{ Form::open(array('url' => '/login', 'class' => 'form-horizontal')) }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> 
          <div class="col-md-12">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
              <input id="email" type="email" class="form-control" aria-haspopup="true" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
            </div>

            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">                            
          <div class="col-md-12">
            <div class="input-group">
              <span class="input-group-addon"><span class="i fa fa-key"></span></span>
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
          <div class="col-xs-8">
            <input type="checkbox" class="icheck"> Remember Me            
          </div>
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">
              Login
            </button>
          </div>
        </div> 

       <!--  <div class="form-group">
          <a class="btn btn-link" href="/password/reset">Forgot Your Password?</a>
        </div> -->
      {{ Form::close() }}
    </div>
    <div class="panel-footer">
      <a class="btn btn-link" href="/password/reset">Forgot Password?</a>
      <a class="btn btn-link" href="/register">Register New</a>
    </div>
  </div>  
</div>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' 
    });
  });
</script>

@include('/layouts/footer')