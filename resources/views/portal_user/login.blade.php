@extends('portal_user.layouts.auth')

@section('content')
    {{-- <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('Login') }}</p>

        <form action="{{ route('portal_user.check') }}" method="post">
            @csrf

            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}" required autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        @if (Route::has('password.request'))
            <p class="mb-1">
                <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            </p>
        @endif
		 @if ($errors->any())
				 @foreach ($errors->all() as $error)
					 <div class="alert alert-danger"style="text-align:center;" >{{$error}}</div>
				 @endforeach
			@endif
    </div> --}}
    
    <!-- /.login-card-body -->

    <div class='container'>
        <div class='window'>
            <div class='overlay'></div>
            <div class='content'>
                <div class='welcome'>Log In</div>
                <form action="{{ route('portal_user.check') }}" method="post">
                @csrf
                  <div class='input-fields'>
                      <input type='email' class="input-line full-width @error('email') is-invalid @enderror" name="email" placeholder="{{ __('Email') }}" required autofocus></input>
                      @error('password')
                      <span class="error invalid-feedback">
                          {{ $message }}
                      </span>
                      @enderror
                      <input type='password' class="input-line full-width @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required></input>
                      @error('password')
                      <span class="error invalid-feedback">
                          {{ $message }}
                      </span>
                      @enderror
                  </div>
                  <div class='spacing'><span class='highlight'> <a href="{{ route('password.request') }}">Forgot Your Password ?</a></span></div>
                  <div><button type="submit" class='ghost-round full-width'>Log In</button></div>
                </form>
            </div>
           
        </div>
    </div>
@endsection

<style>
  /* .card .overlay, .info-box .overlay, .overlay-wrapper .overlay, .small-box .overlay {
    z-index: 1 !important;
  } */
    .error{
    padding: 5px;
    color: red;
}
input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus, 
input:-webkit-autofill:active{
    -webkit-box-shadow: 0 0 0 30px rgb(218 186 99) inset !important;
}
input:-webkit-autofill{
    -webkit-text-fill-color: white !important;
}
.login-page {
  background:  white !important; 
}

.login-page input {
  border: none;
}

.login-page button:focus {
  outline: none;
}

::-webkit-input-placeholder {
  color: rgba(255, 255, 255, 0.65);
}

::-webkit-input-placeholder .input-line:focus +::input-placeholder {
  color: #fff;
}

.login-page .highlight a{
  color: rgba(255, 255, 255, 0.8);
  font-weight: 400;
  cursor: pointer;
  transition: color .2s ease;
}

.login-page .highlight:hover {
  color: #fff;
  transition: color .2s ease;
}

.login-page .spacing {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
  -ms-flex-positive: 1;
  flex-grow: 1;
  height: 120px;
  font-weight: 300;
  text-align: center;
  margin-top: 10px;
  color: rgba(255, 255, 255, 0.65)
}

.login-page .input-line:focus {
  outline: none;
  background: none;
  border-color: #fff;
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
}

.login-page .ghost-round {
  cursor: pointer;
  background: none;
  border: 1px solid rgba(255, 255, 255, 0.65);
  border-radius: 25px;
  color: rgba(255, 255, 255, 0.65);
  -webkit-align-self: flex-end;
  -ms-flex-item-align: end;
  align-self: flex-end;
  font-size: 19px;
  font-size: 1.2rem;
  font-family: roboto;
  font-weight: 300;
  line-height: 2.5em;
  margin-top: auto;
  margin-bottom: 25px;
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
}

.login-page .ghost-round:hover {
  background: rgba(255, 255, 255, 0.15);
  color: #fff;
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
}

.login-page .input-line {
  background: none;
  margin-bottom: 10px;
  line-height: 2.4em;
  color: #fff;
  font-family: roboto;
  font-weight: 300;
  letter-spacing: 0px;
  letter-spacing: 0.02rem;
  font-size: 19px;
  font-size: 1.2rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.65);
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
}

.login-page .full-width {
  width: 100%;
}

.login-page .input-fields {
  margin-top: 25px;
}

.loginpage .container {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
  -ms-flex-pack: center;
  justify-content: center;
  background: #d5b535;
  height: 100%;
}

.login-page .content {
  padding-left: 25px;
  padding-right: 25px;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-flow: column;
  -ms-flex-flow: column;
  flex-flow: column;
  z-index: 5;
}

.login-page .welcome {
  font-weight: 200;
  margin-top: 75px;
  text-align: center;
  font-size: 40px;
  font-size: 2.5rem;
  letter-spacing: 0px;
  letter-spacing: 0.05rem;
}

.login-page .subtitle {
  text-align: center;
  line-height: 1em;
  font-weight: 100;
  letter-spacing: 0px;
  letter-spacing: 0.02rem;
}

.login-page .menu {
  background: rgba(0, 0, 0, 0.2);
  width: 100%;
  height: 50px;
}

.login-page .window {
  z-index: 100;
  color: #fff;
  font-family: roboto;
  position: relative;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-flow: column;
  -ms-flex-flow: column;
  flex-flow: column;
  box-shadow: 0px 15px 50px 10px rgba(0, 0, 0, 0.2);
  box-sizing: border-box;
  height: 500px;
  width: 360px;
  /* background: #fff; */
  /* background: url('https://pexels.imgix.net/photos/27718/pexels-photo-27718.jpg?fit=crop&w=1280&h=823') top left no-repeat; */
}

.login-page .overlay {
  background: -webkit-linear-gradient(#ddbd74, #d5b535);
  background: linear-gradient(#ddbd74, #d5b535);
  opacity: 1;
  filter: alpha(opacity=85);
  height: 500px;
  position: absolute;
  width: 360px;
  z-index: 1;
}

.login-page .bold-line {
  background: #e7e7e7;
  position: absolute;
  top: 0px;
  bottom: 0px;
  margin: auto;
  width: 100%;
  height: 360px;
  z-index: 1;
  opacity:0.1;
    background: url('https://pexels.imgix.net/photos/27718/pexels-photo-27718.jpg?fit=crop&w=1280&h=823') left no-repeat;
  background-size:cover;
}

@media (max-width: 500px) {
    .login-page .window {
    width: 100%;
    height: 100%;
  }
  .login-page .overlay {
    width: 100%;
    height: 100%;
  }
}
</style>
