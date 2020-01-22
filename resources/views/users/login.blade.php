@extends('layouts.login')

<!-- Section Start -->
@section('title', 'Login')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body login-card-body">
                @if ($errors->any())
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Username atau password salah</strong>
                </div>
                @endif

                <div class="login-logo">
                    <a href="#"><b>Sistem Monitoring TA</b><br>Login</a>
                </div>
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('storage/design/undraw_welcome_3gvl.png') }}" class="w-75" srcset="">
                </div>
                <form action="{{route('login.store')}}" method="post">
                    <div class="input-group mb-3">
                        <input name='user_name' type="text" class="form-control form-control-sm" placeholder="Username"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control form-control-sm"
                            placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="icheck-primary">
                        <input type="checkbox" id="remember" name="remember">
                        <label class="check-login" for="remember">
                            Remember Me
                        </label>
                    </div> --}}
                    @csrf
                    <button type="submit" class="btn bg-gradient-primary btn-block">Sign In</button>
                </form>
                {{-- <p class="mt-2">
                    <a href="#">
                        <small>
                            I forgot my password
                        </small>
                    </a>
                </p> --}}
            </div>
        </div>
    </div>
</section>
@endsection