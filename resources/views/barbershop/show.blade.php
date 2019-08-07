@extends('layouts.app')


@section('head')
{!! $map['js'] !!}
@endsection

@section('content')
<div class="main-wrapper-first">

    @include('layouts.header')

    <div class="banner-area">
        <div class="container">
            <div class="row justify-content-center generic-height align-items-center">
                <div class="col-lg-8">
                    <div class="banner-content text-center">
                        <h1 class="text-white text-uppercase">{{$barbershop->name}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="about-generic-area">
        <div class="container border-top-generic">
            @include('layouts.messages')
            @auth
                @if(auth()->user()->role == 'Admin' && $barbershop->status == 'Belum Terverifikasi')
                <div class="pull-right">
                    <a data-toggle="modal" data-target="#verify" href="#" class="generic-btn info-border"><i class="fa fa-check"></i></a>
                    <a data-toggle="modal" data-target="#tolak" href="#" class="generic-btn danger-border"><i class="fa fa-times"></i></a>
                </div>
                <div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            {!! Form::model($barbershop, array('route' => array('barbershop.verify', $barbershop->id), 'method' => 'PUT')) !!}
                            <h4 class="mb-5">Konfirmasi</h4>
                            <p>Apakah anda yakin ingin memverifikasi akun ini?</p>
                            <div class="pull-right">
                                <button type="button" class="generic-btn default" data-dismiss="modal">Batal</button>
                                {{Form::submit('Ya', ['class' => 'generic-btn primary'])}}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal fade" id="tolak" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            {!! Form::model($barbershop, array('route' => array('barbershop.tolak', $barbershop->id), 'method' => 'PUT')) !!}
                            <h4 class="mb-5">Konfirmasi</h4>
                            <p>isi alasan penolakan di bawah apabila anda yakin untuk menolak barbershop ini.</p>
                            <div class="form-group">
                                <label for="alasan">Alasan Penolakan</label>
                                <textarea name="alasan" class="form-control" rows="5" required></textarea>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="generic-btn default" data-dismiss="modal">Batal</button>
                                {{Form::submit('Submit', ['class' => 'generic-btn primary'])}}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    </div>
                </div>
                @endif
                @if(auth()->user()->id == $barbershop->user->id)
                <div class="pull-right">
                    <a href="/barbershop/{{$barbershop->id}}/edit"class="generic-btn info-border"><i class="fa fa-edit"></i> Edit</a>
                    <a data-toggle="modal" data-target="#deletebarbershop" href="#" class="generic-btn danger-border"><i class="fa fa-trash"></i> Hapus</a>
                </div>
                <div class="modal fade" id="deletebarbershop" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4 class="mb-5">Konfirmasi</h4>
                            <p>Apakah anda yakin ingin menghapus barbershop ini? semua data model rambut di barbershop ini juga akan terhapus.</p>
                            {!!Form::open(['action' => ['BarbershopController@destroy', $barbershop->id], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                <div class="pull-right">
                                    <button type="button" class="generic-btn primary" data-dismiss="modal">Batal</button>
                                    {{Form::submit('Ya', ['class' => 'generic-btn default'])}}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    </div>
                </div>
                @endif
            @endauth
            <h3 class="about-title mb-50">Tentang {{$barbershop->name}}</h3>
            <div class="row">
                <div class="col-md-4">
                    <img src="{{asset('img/barbershop/'.$barbershop->gambar)}}" class="pull-right mb-5" width="30%">
                    {!! $map['html'] !!}
                    <br>
                    <div class="pull-right">
                        <a target="_blank" href="https://www.google.com/maps/dir//{{$barbershop->longitude}},{{$barbershop->latitude}}" class="generic-btn primary-border"> <i class="fa fa-location-arrow"></i> Petunjuk Arah</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <p>Owner : <a href="/user/{{$barbershop->user->id}}"></a> {{$barbershop->user->name}}</p>
                    <p>Status : {{$barbershop->status}}</p>
                    @if($barbershop->status == 'Ditolak')
                    <p>Alasan : {{$barbershop->alasan}}</p>
                    @endif
                    @if($barbershop->email != NULL)
                        <p>E-Mail : {{$barbershop->email}}</p>
                    @endif
                    <p>Alamat : {{ucwords(strtolower($barbershop->alamat))}}, {{ucwords(strtolower($barbershop->district->name))}}, {{ucwords(strtolower($barbershop->regency->name))}}, {{ucwords(strtolower($barbershop->province->name))}}</p>
                    @if($barbershop->no_telp != NULL)
                        <p>{{$barbershop->no_telp}}</p>
                    @endif
                    <p>Social Media :</p>
                    @if($barbershop->facebook !== NULL)
                    <a href="{{$barbershop->facebook}}" class="btn btn-simple btn-link btn-icon" target="_blank">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                    @endif
                    @if($barbershop->twitter !== NULL)
                        <a href="{{$barbershop->twitter}}" class="btn btn-simple btn-link btn-icon" target="_blank">
                            <i class="fa fa-twitter"></i>
                        </a>
                    @endif
                    @if($barbershop->instagram !== NULL)
                        <a href="{{$barbershop->instagram}}" class="btn btn-simple btn-link btn-icon" target="_blank">
                            <i class="fa fa-instagram"></i>
                        </a>
                    @endif
                    <hr>
                    {!!$barbershop->deskripsi!!}
                </div>
            </div>
        </div>
    </section>
    
    <!-- Start Service Area -->
    <section class="service-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title"> 
                        @auth
                        @if(auth()->user()->id == $barbershop->user->id)
                        <a  data-toggle="modal" data-target="#tambah" href="#" class="generic-btn primary-border pull-right"><i class="fa fa-plus"></i></a>
                        @endif
                        @endauth
                        <h3 class="text-white">Model Rambut</h3>
                    </div>           
                    @auth
                    @if(auth()->user()->id == $barbershop->user->id)
                    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-body">
                                {!! Form::open(['action' => 'HairstyleController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                
                                <input name="barbershop_id" type="hidden" class="form-control" value="{{$barbershop->id}}">
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control" name="kategori" required>
                                        <option value="Dewasa">Dewasa</option>
                                        <option value="Anak">Anak</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input name="gambar" type="file" class="form-control" required>
                                </div>

                                <input type="submit" class="generic-btn primary pull-right mt-5" value="Submit">
                                {!! Form::close() !!}
                            </div>
                        </div>
                        </div>
                    </div>
                    @endif
                    @endauth
                </div>
            </div>
            @if(count($barbershop->hairstyles) > 0)
            <div class="row">
                @foreach($barbershop->hairstyles as $hairstyle)
                    <div class="col-lg-4 col-sm-6">
                        <div class="single-service">
                            <div class="thumb1" style="background: url('{{asset('img/hairstyle/'.$hairstyle->gambar)}}');">
                                <div class="overlay overlay-content d-flex justify-content-center align-items-center">
                                    <a data-toggle="modal" data-target="#modal{{$hairstyle->id}}" href="#" class="generic-btn primary-border hover d-inline-flex align-items-center mr-20"><span class="fa fa-search"></span></a>
                                    @auth
                                        @if(auth()->user()->id == $barbershop->user->id)
                                            <a data-toggle="modal" data-target="#edit{{$hairstyle->id}}" href="#" class="generic-btn info-border hover d-inline-flex align-items-center mr-20"><span class="fa fa-edit"></span></a>
                                            <a data-toggle="modal" data-target="#delete{{$hairstyle->id}}" href="#" class="generic-btn danger-border hover d-inline-flex align-items-center"><span class="fa fa-trash"></span></a>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="modal fade" id="modal{{$hairstyle->id}}" tabindex="-1" role="dialog"aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <img class="img-fluid rounded mb-5" src="{{asset('img/hairstyle/'.$hairstyle->gambar)}}" alt="">
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>               
                    @auth
                    @if(auth()->user()->id == $barbershop->user->id)
                        <div class="modal fade" id="edit{{$hairstyle->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    {!! Form::model($hairstyle, array('route' => array('hairstyle.update', $hairstyle->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) !!}
                                    
                                    <input name="barbershop_id" type="hidden" class="form-control" value="{{$barbershop->id}}">
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        {!! Form::select('kategori', ['Dewasa' => 'Dewasa', 'Anak' => 'Anak'], $hairstyle->kategori, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar">Gambar</label>
                                        <input name="gambar" type="file" class="form-control">
                                    </div>

                                    <input type="submit" class="generic-btn primary pull-right mt-5" value="Submit">
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            </div>
                        </div>  
                        <div class="modal fade" id="delete{{$hairstyle->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h4 class="mb-5">Konfirmasi</h4>
                                    <p>Apakah anda yakin ingin menghapus model rambut ini dari barbershop anda?</p>
                                    {!!Form::open(['action' => ['HairstyleController@destroy', $hairstyle->id], 'method' => 'POST'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        <div class="pull-right">
                                            <button type="button" class="generic-btn primary" data-dismiss="modal">Batal</button>
                                            {{Form::submit('Ya', ['class' => 'generic-btn default'])}}
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            </div>
                        </div>
                    @endif
                        
                    @endauth
                @endforeach
            </div>
            @else
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span class="text-white">Belum ada model rambut.</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    @include('layouts.footer')

</div>
@endsection

