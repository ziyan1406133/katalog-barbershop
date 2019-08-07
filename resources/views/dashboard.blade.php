@extends('layouts.dashboard')

@section('content')
<div class="jumbotron justify-content-center">
    <h1>Selamat Datang, {{auth()->user()->name}}</h1>
</div>
@endsection
