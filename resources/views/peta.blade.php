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
                        <h1 class="text-white text-uppercase">Peta Barbershop</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="about-generic-area">
        <div class="container border-top-generic">
        @include('layouts.messages')
            {!! $map['html'] !!}
        </div>
    </section>
    @include('layouts.footer')

</div>
@endsection

