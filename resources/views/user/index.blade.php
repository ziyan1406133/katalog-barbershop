@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
@endsection

@section('content')
@include('layouts.messages')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Mitra</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-responsive datatable">
                <thead>
                    <tr>
                        <th>Join At</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>E-Mail</th>
                        <th>Barbershop</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{date('20y/m/d', strtotime($user->created_at))}}</td>
                            <td><a href="/user/{{$user->id}}">{{$user->name}}</a></td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if(count($user->barbershops) > 0)
                                    <ul>
                                        @foreach($user->barbershops as $barbershop)
                                            <li> <a href="/barbershop/{{$barbershop->id}}">{{$barbershop->name}}</a> - {{$barbershop->status}}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    Belum ada.
                                @endif
                            </td>
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