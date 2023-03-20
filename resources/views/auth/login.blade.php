@section('title','MK Login')

@extends('user.layouts.master')

@section('content')


<div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url({{asset('user/assets/images/backgrounds/login-bg.jpg')}}">
    <div class="container">
        <div class="form-box">
            <div class="form-tab">
                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                    </li>
                </ul>
                <div class="tab-content" id="tab-content-5">
                    <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="singin-email">{{ __('Email') }}*</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="singin-email" name="email" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="singin-password">{{ __('Password') }}*</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="singin-password" name="password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>LOG IN</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember_me" class="custom-control-input" id="signin-remember">
                                    <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                </div><!-- End .custom-checkbox -->

                                <a href="#" class="forgot-link">Forgot Your Password?</a>
                            </div><!-- End .form-footer -->
                        </form>
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="register-name">{{ __('Name') }}*</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') }}" id="register-name" name="name" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div><!-- End .form-group -->
                            <div class="form-group">
                                <label for="register-email">{{ __('Email') }}*</label>
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" id="register-email" name="email" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="register-password">{{ __('Password') }}</label>
                                <input type="password" class="form-control  @error('password') is-invalid @enderror" id="register-password" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="confirm-password">{{ __('Confirm Password') }}</label>
                                <input type="password" class="form-control  @error('password') is-invalid @enderror" id="confirm-password" name="password_confirmation" required autocomplete="new-password">
                            </div><!-- End .form-group -->

                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>SIGN UP</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                            </div><!-- End .form-footer -->
                        </form>
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .form-tab -->
        </div><!-- End .form-box -->
    </div><!-- End .container -->
</div><!-- End .login-page section-bg -->


@endsection