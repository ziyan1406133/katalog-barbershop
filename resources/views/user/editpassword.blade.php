@extends('layouts.dashboard')

@section('content')
@include('layouts.messages')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Profil</h4>
    </div>
    <div class="card-body ml-3">
        {!! Form::model($user, array('route' => array('password', $user->id), 'method' => 'PUT')) !!}
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">Password Lama</label>
        
                <div class="col">
                    <input name="oldpassword" id="oldpassword" type="password" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">Password Baru</label>
        
                <div class="col">
                    <input name="password" id="password" type="password" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">Konfirmasi Password</label>
        
                <div class="col">
                    <input name="password1" id="password1" type="password" class="form-control" required>
                </div>
            </div>

            <input type="submit" class="btn btn-md btn-primary btn-fill pull-right" value="Submit">
        {!! Form::close() !!}
    </div>
</div>
@endsection