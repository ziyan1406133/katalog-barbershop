@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('select2/css/select2.min.css')}}"/>
@endsection

@section('content')
@include('layouts.messages')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Buat Barbershop</h4>
    </div>
    <div class="card-body ml-3">
        {!! Form::open(['action' => 'BarbershopController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

        <div class="row">
            <div class="col-md-8 px-1">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input name="name" type="text" class="form-control" placeholder="L.A. Barbershop">
                </div>
            </div>
            <div class="col-md-4 pl-1">
                <div class="form-group">
                    <label for="email">E-Mail Barbershop</label>
                    <input name="email" type="email" class="form-control" placeholder="la.barbershop@gmail.com">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 px-1">
                <div class="form-group">
                    <label for="name">Provinsi</label>
                    <select class="select2 form-control" name="provinces" id="provinces" required>
                        <option value="" disable="true"></option>
                        @foreach ($provinces as $key => $value)
                            <option value="{{$value->id}}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 px-1">
                <div class="form-group">
                    <label for="name">Kabupaten</label>
                    <select class="select2 form-control" name="regencies" id="regencies" required>
                        <option value="" disable="true"></option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 pl-1">
                <div class="form-group">
                    <label for="name">Kecamatan</label>
                    <select class="select2 form-control" name="districts" id="districts" required>
                        <option value="" disable="true"></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 pl-1">
                <div class="form-group">
                    <label for="alamat">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="form-control" 
                        placeholder="Jalan Kusbini No.35, Klitren, Gondokusuman, Klitren 55222" required></textarea>
                </div>
            </div>
            <div class="col-md-4 pl-1">
                <div class="form-group">
                    <label for="gambar">Foto/Logo Barbershop</label>
                    <input name="gambar" type="file" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <label for="koordinat">Koordinat <a data-toggle="modal" data-target="#petunjuk" href="#"><i class="fa fa-question-circle"></i></a></label>
        </div>
        <div class="row">
            <div class="col-md-6 pl-1">
                <input name="longitude" type="text" class="form-control" placeholder="-7.2019482" required>
            </div>
            <div class="col-md-6 pl-1">
                <input name="latitude" type="text" class="form-control" placeholder="107.886734" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 pl-1">
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <small>Isi dengan Jam Buka, Harga Anak/Dewasa, dan Fasilitas Barbershop</small>
                    <textarea name="deskripsi" id="article-ckeditor" class="form-control" required></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 px-1">
                <div class="form-group">
                    <label for="no_telp">No Telepon</label>
                    <input name="no_telp" type="text" class="form-control" placeholder="+6285-1234-5678">
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook Profile</label>
                    <textarea name="facebook" placeholder="https://www.facebook.com/YourAccountProfile" class="form-control" ></textarea>
                </div>
            </div>
            <div class="col-md-6 px-1">
                <div class="form-group">
                    <label for="alamat">Twitter Profile</label>
                    <textarea name="twitter" placeholder="https://twitter.com/YourAccountProfile"  class="form-control" ></textarea>
                </div>
                <div class="form-group">
                    <label for="alamat">Instagram Profile</label>
                    <textarea name="instagram" placeholder="https://www.instagram.com/YourAccountProfile" class="form-control" ></textarea>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-md btn-primary btn-fill pull-right mt-5" value="Submit">
        {!! Form::close() !!}
    </div>
</div>
<div class="modal fade" id="petunjuk" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <h4 class="mb-5">Cara Mencari Koordinat</h4>
            <p>Koordinat longitude dan latitude didapat dari google maps. Untuk mencari koordinat barbershop anda, lakukan langkah berikut :</p>
            Kunjungi halaman <a href="https://www.google.com/maps">Google Maps</a> <br>
            Masukkan Nama Barbershop atau Alamat Lengkap di form pencarian, kemudian klik Enter
            <img class="img-fluid rounded mb-5" src="{{asset('img/petunjuk1.png')}}" alt="">
            Koordinat dapat ditemukan di address bar
            <img class="img-fluid rounded mb-5" src="{{asset('img/petunjuk2.png')}}" alt="">
        </div>
    </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('select2/js/select2.min.js')}}"></script>  
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>    
<script>
    CKEDITOR.replace( 'article-ckeditor' );
</script>
<script>
$(document).ready(function() {
    $('.select2').select2();
} );
</script>
<script type="text/javascript">
    $('#provinces').on('change', function(e){
        console.log(e);
        var province_id = e.target.value;
        $.get('/json-regencies?province_id=' + province_id,function(data) {
            console.log(data);
            $('#regencies').empty();
            $('#regencies').append('<option value="0" disable="true" selected="true"></option>');

            $('#districts').empty();
            $('#districts').append('<option value="0" disable="true" selected="true"></option>');

            $.each(data, function(index, regenciesObj){
                $('#regencies').append('<option value="'+ regenciesObj.id +'">'+ regenciesObj.name +'</option>');
            })
        });
    });

    $('#regencies').on('change', function(e){
        console.log(e);
        var regencies_id = e.target.value;
        $.get('/json-districts?regencies_id=' + regencies_id,function(data) {
            console.log(data);
            $('#districts').empty();
            $('#districts').append('<option value="0" disable="true" selected="true"></option>');

            $.each(data, function(index, districtsObj){
            $('#districts').append('<option value="'+ districtsObj.id +'">'+ districtsObj.name +'</option>');
            })
        });
    });
</script>
@endsection