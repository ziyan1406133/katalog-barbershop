@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
@endsection

@section('content')
@include('layouts.messages')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Barbershop Pending</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-responsive datatable">
                <thead>
                    <tr>
                        <th>Dibuat Pada</th>
                        <th>Nama</th>
                        <th>Owner</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barbershops as $barbershop)
                        <tr>
                            <td>{{date('20y/m/d', strtotime($barbershop->created_at))}}</td>
                            <td><a href="/barbershop/{{$barbershop->id}}">{{$barbershop->name}}</a></td>
                            <td><a href="/user/{{$barbershop->user->id}}">{{$barbershop->user->name}}</a></td>
                            <td>{{ucwords(strtolower($barbershop->alamat))}}, {{ucwords(strtolower($barbershop->district->name))}}, {{ucwords(strtolower($barbershop->regency->name))}}, {{ucwords(strtolower($barbershop->province->name))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
<script>
$(document).ready(function() {
    $('.datatable').DataTable({
        "order": [[ 0, "desc" ]]
    });
} );
</script>
@endsection