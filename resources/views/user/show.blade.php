@extends('layouts.dashboard')

@section('content')
@include('layouts.messages')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profil Mitra</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 pr-1">
                        <h5>Nama : </h5>
                        <p class="text-muted">{{$user->name}}</p>
                    </div>
                    <div class="col-md-6 pl-1">
                        <h5>E-Mail : </h5>
                        <p class="text-muted">{{$user->email}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h5>Alamat : </h5>
                            @if($user->alamat == NULL)
                            <p class="text-muted">Belum terisi.</p>
                            @else
                            <p class="text-muted">{{$user->alamat}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h5>Bio : </h5>
                            @if($user->bio == NULL)
                                <p class="text-muted">Belum terisi.</p>
                            @else
                                <p class="text-muted">{{$user->bio}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Daftar Barbershop</h4>
            </div>
            <div class="card-body">
                @if(count($user->verified) > 0)
                    ada.
                @else
                    <p class="text-muted">Mitra ini belum memiliki barbershop yang terverifikasi.</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-user">
            <div class="card-image">
                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="...">
            </div>
            <div class="card-body">
                <div class="author">
                    <img class="avatar border-gray" src="{{asset('img/avatar/'.$user->avatar)}}" alt="...">
                    <h5 class="title">{{$user->name}}</h5>
                    <p class="description">
                        {{$user->username}}
                        <br>{{$user->no_telp}}
                    </p>
                </div>
                <p class="description text-center">
                    @if(auth()->user()->role == 'Admin' || auth()->user()->id == $user->id)
                        <a class="btn btn-warning btn-sm" href="/user/{{$user->id}}/edit"><i class="fa fa-edit"></i></a>
                        @if(auth()->user()->id == $user->id)
                        <a class="btn btn-info btn-sm" href="/editpassword/{{$user->id}}/user"><i class="fa fa-key"></i></a>
                        @endif
                    @endif
                    @if(auth()->user()->role == 'Admin')
                        <a data-toggle="modal" data-target="#delete" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    @endif
                </p>
            </div>
            @if(auth()->user()->role == 'Admin')
                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4 class="mb-5">Konfirmasi</h4>
                            <p>Apakah anda yakin ingin menghapus mitra ini? Semua barbershop dan model rambut yang terkait juga akan terhapus.</p>
                            {!!Form::open(['action' => ['UserController@destroy', $user->id], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                <div class="pull-right">
                                    <button type="button" class="btn btn-primary btn-fill" data-dismiss="modal">Batal</button>
                                    {{Form::submit('Ya', ['class' => 'btn btn-default btn-fill'])}}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    </div>
                </div>
            @endif
            <hr>
            <div class="button-container mr-auto ml-auto">
                @if($user->facebook !== NULL)
                    <a href="{{$user->facebook}}" class="btn btn-simple btn-link btn-icon" target="_blank">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                @endif
                @if($user->twitter !== NULL)
                    <a href="{{$user->twitter}}" class="btn btn-simple btn-link btn-icon" target="_blank">
                        <i class="fa fa-twitter"></i>
                    </a>
                @endif
                @if($user->instagram !== NULL)
                    <a href="{{$user->instagram}}" class="btn btn-simple btn-link btn-icon" target="_blank">
                        <i class="fa fa-instagram"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection