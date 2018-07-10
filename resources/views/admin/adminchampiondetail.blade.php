@extends('layouts.admin_layout')

@section('active4')
    active
@endsection

@section('pagetitle')
	<b><i class="fas fa-users"></i> Detail Tim {{$team->teamname}}</b>
@endsection

@section('breadcrumb')
	<a href="#">Detail juara / {{$team->teamname}}</a>
@endsection

@section('content')
    <div class="card mb-4 elevation">
        <div class="card-body">
            <a href="/admin/team" style="color:black"><h3><i class="fas fa-arrow-left"></i></h3></a>
            <div class="row justify-content-start pb-2" style="margin-left: 2px">
                <div class="col-md-4 p-0">
                    <img style="" class="mb-2" height="auto" width="300px" src="/avatars/{{ $team->avatar}}"><br>
                </div>

                <div class="col-md-7 col-sm-7 p-0">
                    <h5><b>Tim:</b> {{ $team->teamname }}</h5>
                    <p><b>Deskripsi:</b> {{ $team->description }}</p>
                    <p><b>Dibuat tanggal:</b> {{date('d F Y', strtotime($team->created_at))}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 elevation">
        <h2 class="px-4 pt-4"><i class="fas fa-users"></i> Detail anggota</h2>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatables" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama anggota</th>
                            <th>Foto</th>
                            <th>ID Steam</th>
                            <th>Email</th>
                            <th>Nomor ponsel</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($member))
                            @foreach($member as $m)
                                <td>{{$loop->iteration}}</td>
                                <td>{{$m->name}}</td>
                                <td>
                                    <img src="/avatars/{{$m->avatar}}" width="80px" height="auto" alt="">
                                </td>
                                <td>{{$m->steamid}}</td>
                                <td>{{$m->email}}</td>
                                <td>{{$m->phonenumber}}</td>
                                <td>{{$m->address}}</td>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection