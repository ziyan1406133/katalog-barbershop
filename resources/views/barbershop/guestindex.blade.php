@extends('layouts.app')

@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('select2/css/select2.min.css')}}"/>
@endsection

@section('content')
<div class="main-wrapper-first">

    @include('layouts.header')

    <div class="banner-area">
        <div class="container">
            <div class="row justify-content-center generic-height align-items-center">
                <div class="col-lg-8">
                    <div class="banner-content text-center">
                        <h1 class="text-white text-uppercase">Daftar Barbershop</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Service Area -->
    <section class="service-area" style="background: white;">
        <div class="container">
            @include('layouts.messages')
                @if(count($barbershops) > 0)
                <div class="row">
                @foreach($barbershops as $barbershop)
                <div class="col-lg-3 col-sm-6">
                    <div class="single-service">
                        <div class="thumb" style="background: url('{{asset('img/barbershop/'.$barbershop->gambar)}}')">
                            <div class="overlay overlay-content d-flex justify-content-center align-items-center">
                                <a href="/barbershop/{{$barbershop->id}}" class="primary-btn hover d-inline-flex align-items-center"><span class="mr-10">Lihat</span><span class="lnr lnr-arrow-right"></span></a>
                            </div>
                        </div>
                        <div class="desc">
                            <h6 class="text-uppercase">{{$barbershop->name}}</h6>
                            <p>{{ucwords(strtolower($barbershop->alamat))}}, {{ucwords(strtolower($barbershop->district->name))}}, {{ucwords(strtolower($barbershop->regency->name))}}, {{ucwords(strtolower($barbershop->province->name))}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
                <div class="mt-20 row justify-content-center">
                    {{$barbershops->links()}}
                </div>
                @else
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center">
                            <span class="text-white">Maaf, data belum tersedia, silahkan kembali beberapa hari lagi</span>
                        </div>
                    </div>
                </div>
                @endif
        </div>
    </section>
    @include('layouts.footer')

</div>
@endsection


@section('script')
<script src="{{asset('select2/js/select2.min.js')}}"></script>  
<script>
$(document).ready(function() {
    $('.select2').select2();
} );
</script>
@endsection