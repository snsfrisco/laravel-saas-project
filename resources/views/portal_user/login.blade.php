@extends('portal_user.layouts.auth')

@section('content')
 <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('Login') }}</p>

        <form action="{{ route('portal_user.check') }}" method="post">
            @csrf

            <div class="input-group  mb-3">
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
    </div> 
    
    <!-- /.login-card-body -->

{{-- <div class='container'>
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
    </div> --}}
@endsection


