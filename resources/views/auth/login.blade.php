@extends('layouts.app')

@section('content')
<div class="container fullscreen-centered">
    <div class="row justify-content-center" id="content">
        <div class="col-md-8">
            @include('layouts.messages')
            <div class="card">
                <div class="card-header">
                <h3>
                    Login
                </h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                    
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                    
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                    
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
        
                            </div>
                        </div>
                        <small class="pull-right mr-5">Belum punya akun mitra? daftar <a href="/register"><u>di sini</u></a></small>
                        <div class="form-group row ml-5">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-0 pull-right mr-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="generic-btn primary circle">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection