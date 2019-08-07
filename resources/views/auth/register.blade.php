@extends('layouts.app')

@section('content')
<div class="container fullscreen-centered">
    <div class="row justify-content-center" id="content">
        <div class="col-md-8">
            @include('layouts.messages')
            <div class="card">
                <div class="card-header">
                    <h3>
                        Register
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input name="name" id="name" type="text" class="form-control" required autocomplete="name"maxlength="191" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input name="username"  id="username" type="text" class="form-control" required autocomplete="username" maxlength="16" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input name="email"  id="email" type="email" class="form-control" required autocomplete="email" maxlength="16" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <small class="pull-right mr-5">Sudah punya akun? Sign In <a href="/login"><u>di sini</u></a></small>
                        <br>
                        <div class="form-group mb-0 mt-3 pull-right mr-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="generic-btn primary circle">
                                    {{ __('Register') }}
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
