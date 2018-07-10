@extends('layouts.admin_layout')

@section('active7')
    active
@endsection

@section('pagetitle')
<b><i class="fas fa-envelope"></i> Pesan Keluar</b>
@endsection

@section('breadcrumb')
    <a href="/admin/message-out/{{$currentMessage->id}}">Pesan Keluar / Tim / {{$currentMessage->user->teamname}}</a>
@endsection

@section('content')
    <div class="card mb-4 elevation">
        <div class="card-body">
            <a href="/admin/message-out" style="color:black"><h3><i class="fas fa-arrow-left"></i></h3></a>

            <h3 class="mb-1">{{$currentMessage->subject}}</h3>
            <hr style="border-bottom:1px solid #E5E5E5">
            Diterima: {{date('d F Y', strtotime($currentMessage->created_at))}} pukul: {{date('H:i', strtotime($currentMessage->created_at))}} ({{$currentMessage->created_at->diffForHumans()}})
            <p>Dari: <b>{{$currentMessage->sender}}</b> | noreply@mail.com</p>
            <p>Pesan:<br>{{$currentMessage->message}}</p>
        </div>
    </div>
@endsection