@extends('layouts.dashboard_layout')

@section('active4')
    active
@endsection

@section('pagetitle')
<b><i class="fas fa-envelope"></i> Pesan Keluar</b>
@endsection

@section('content')
    <div class="card mb-4 elevation">
        <div class="card-body">
            <a href="/user/message-out" style="color:black"><h3><i class="fas fa-arrow-left"></i></h3></a>

            <h3 class="mb-1">{{$currentMessage->subject}}</h3>
            <hr style="border-bottom:1px solid #E5E5E5">
            Diterima: {{date('d F Y', strtotime($currentMessage->created_at))}} pukul: {{date('H:i', strtotime($currentMessage->created_at))}} ({{$currentMessage->created_at->diffForHumans()}})
            <p>Dari: <b>{{$currentMessage->user->teamname}}</b> | {{$currentMessage->user->email}}</p>
            <p>Pesan:<br>{{$currentMessage->message}}</p>
        </div>
    </div>
@endsection
