@extends('layouts.dashboard')

@section('content')
@include('layouts.messages')
<a href="/barbershop/create" class="btn btn-primary pull-right"><i class="fa fa-plus"></i></a>
<h4>Barbershop Saya</h4>
<hr>
@if(count(auth()->user()->barbershops) > 0)
    <div class="row">
    @foreach(auth()->user()->barbershops as $barbershop)
        <div class="col-md-3">
            <div class="card">
                <div class="card-image">
                    <a href="/barbershop/{{$barbershop->id}}"><img src="{{asset('img/barbershop/'.$barbershop->gambar)}}" alt=""></a> 
                </div>
                <div class="card-body">
                    <div class="author">
                        <a href="/barbershop/{{$barbershop->id}}"><h5 class="title text-center">{{$barbershop->name}}</h5></a>
                    </div>
                </div>
                <p class="description text-center">
                    {{$barbershop->status}}
                </p>
            </div>
        </div>
    @endforeach
    </div>
@else
    <h6 class="text-muted">Anda belum memiliki barbershop</h6>
@endif
@endsection