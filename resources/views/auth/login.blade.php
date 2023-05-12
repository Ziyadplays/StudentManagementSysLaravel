@extends('auth.layout.layout')
@section('content')



<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control-user form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required  autofocus
                                           id="exampleInputEmail" aria-describedby="emailHelp"
                                           placeholder="Enter Email Address...">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control-user form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"
                                           id="exampleInputPassword" placeholder="Password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <hr>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{route('register')}}">Create an Account!</a>
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
{{--    ///https://www.c-sharpcorner.com/blogs/disable-browser-back-button-using-javascript1--}}
    <script type = "text/javascript" >
        function preventBack(){
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () {
            null
        };
    </script>

@endsection
