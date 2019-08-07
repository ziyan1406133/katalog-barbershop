@extends('layouts.dashboard')

@section('content')
@include('layouts.messages')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Profil</h4>
    </div>
    <div class="card-body ml-3">
        {!! Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) !!}

        <div class="row">
            <div class="col-md-12 px-1">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input name="name" type="text" class="form-control" placeholder="Naratama Wisnu Hardoyo" value="{{$user->name}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 px-1">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" placeholder="nara15@gmail.com" value="{{$user->email}}">
                </div>
            </div>
            <div class="col-md-4 pl-1">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input name="username" type="text" class="form-control" placeholder="naratama15" value="{{$user->username}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pl-1">
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" rows="3" class="form-control" 
                        placeholder="Jalan Kusbini No.35, Klitren, Gondokusuman, Klitren, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55222">{{$user->alamat}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pl-1">
                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea name="bio"  class="form-control" 
                        placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quam quam, posuere nec enim at, pretium sodales eros. Donec molestie tincidunt ligula, sed finibus lorem bibendum id. Praesent faucibus metus arcu, nec dictum purus cursus et. Fusce at neque sed sapien ultrices fringilla. Integer varius elit et rutrum ullamcorper. Integer maximus velit vitae ligula aliquam, tempus luctus purus ultricies. Fusce consequat mi id lectus vulputate viverra. In mattis diam sagittis tincidunt viverra. Donec varius libero finibus nibh volutpat pretium. Suspendisse volutpat, justo id pretium varius, tellus felis sagittis nisl, vitae dictum justo felis nec urna. Suspendisse nec euismod quam, et tincidunt ante. Donec consectetur vulputate diam et ultrices. Donec feugiat magna in interdum auctor. Donec euismod blandit mi ut lacinia. Donec interdum libero dui.">{{$user->bio}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 px-1">
                <div class="form-group">
                    <label for="no_telp">No Telepon</label>
                    <input name="no_telp" type="text" class="form-control" placeholder="+6285-1234-5678" value="{{$user->no_telp}}">
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook Profile</label>
                    <textarea name="facebook" placeholder="https://www.facebook.com/YourAccountProfile" class="form-control" >{{$user->facebook}}</textarea>
                </div>
                <div class="form-group">
                    <label for="alamat">Twitter Profile</label>
                    <textarea name="twitter" placeholder="https://twitter.com/YourAccountProfile"  class="form-control" >{{$user->twitter}}</textarea>
                </div>
                <div class="form-group">
                    <label for="alamat">Instagram Profile</label>
                    <textarea name="instagram" placeholder="https://www.instagram.com/YourAccountProfile" class="form-control" >{{$user->instagram}}</textarea>
                </div>
            </div>
            <div class="col-md-4 pl-1">
                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <input name="avatar" type="file" class="form-control">
                    <img src="{{asset('img/avatar/'.$user->avatar)}}" class="mt-3" width="50%">
                </div>
            </div>
        </div>

        <input type="submit" class="btn btn-md btn-primary btn-fill pull-right" value="Submit">
        {!! Form::close() !!}
    </div>
</div>
@endsection