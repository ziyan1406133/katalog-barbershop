@extends('layouts.app')

@section('content')
<div class="main-wrapper-first">

    @include('layouts.header')

    <div class="banner-area">
        <div class="container">
            <div class="row justify-content-center height align-items-center">
                <div class="col-lg-8">
                    <div class="banner-content text-center">
                        <span class="text-white top text-uppercase">Temukan Barber Terpercaya</span>
                        <h1 class="text-white text-uppercase">Gaya Rambut Terkini, Semakin Mudah Didapatkan</h1>
                        @guest
                        <p class="text-white">Anda memiliki usaha barbershop? daftar menjadi mitra
                            <a href="/register" class="primary-btn d-inline-flex align-items-center">
                                <span class="mr-10">di sini</span>
                            </a>
                        </p>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Feature Area -->
    <section class="featured-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-feature d-flex flex-wrap justify-content-between">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-th-list"></span>
                        </div>
                        <div class="desc">
                            <h6 class="title text-uppercase">Banyak Pilihan</h6>
                            <p>Kami memiliki banyak pilihan-pilihan model rambut dari berbagai macam barber handal.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-feature d-flex flex-wrap justify-content-between">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-check"></span>
                        </div>
                        <div class="desc">
                            <h6 class="title text-uppercase">Barbershop Terverifikasi</h6>
                            <p>Setiap barbershop telah melalui tahap verifikasi terlebih dahulu sehingga keasliannya dapat terjamin.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-feature d-flex flex-wrap justify-content-between">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-map"></span>
                        </div>
                        <div class="desc">
                            <h6 class="title text-uppercase">Sebaran Lokasi</h6>
                            <p>Lihat lokasi barbershop dan petunjuk arah untuk kemudahan anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Feature Area -->
    <!-- Start Service Area -->
    <section class="service-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h3 class="text-white">Mitra Terpercaya Kami</h3>
                    </div>
                </div>
            </div>
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
                            <h6 class="text-uppercase text-white">{{$barbershop->name}}</h6>
                            <p class="text-white">{{ucwords(strtolower($barbershop->alamat))}}, {{ucwords(strtolower($barbershop->district->name))}}, {{ucwords(strtolower($barbershop->regency->name))}}, {{ucwords(strtolower($barbershop->province->name))}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
                <div class="row justify-content-center height align-items-center mt-5">
                    <a href="/barbershopguest" class="primary-btn d-inline-flex align-items-center"><span class="mr-10">Lihat Lebih Banyak</span><span class="lnr lnr-arrow-right"></span></a>
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