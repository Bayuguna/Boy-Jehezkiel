<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/favicon.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Library Css -->
    <link rel="stylesheet" href="{{asset("css/animate.min.css")}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome-all.css')}}">

</head>
<body style="background: #e5e5e5">
    <div class="container">
        <div class="card my-4 elevation">
            <div class="card-body">
                <a href="/" style="color:black"><h3><i class="fas fa-arrow-left"></i></h3></a>
                <div class="row justify-content-start pb-2" style="margin-left: 2px">
                    <div class="col-md-4 p-0">
                        <img style="" class="img-fluid" height="auto" width="300px" src="/avatars/{{$champion->user->avatar}}"><br>
                    </div>

                    <div class="col-md-7 col-sm-7 p-0">
                        <h5><b>Tim:</b> {{ $champion->user->teamname }}</h5>
                        <p><b>Deskripsi:</b> {{ $champion->user->description }}</p>
                        <p><b>Dibuat tanggal:</b> {{date('d F Y', strtotime($champion->user->created_at))}}</p>
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
                                <th class="text-left">Nama anggota</th>
                                <th class="text-left">Foto</th>
                                <th class="text-left">ID Steam</th>
                                <th class="text-left">Email</th>
                                <th class="text-left">Nomor ponsel</th>
                                <th class="text-left">Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($member))
                                @foreach($member as $m)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$m->name}}</td>
                                        <td>
                                            <img src="/avatars/{{$m->avatar}}" width="80px" height="auto" alt="">
                                        </td>
                                        <td>{{$m->steamid}}</td>
                                        <td>{{$m->email}}</td>
                                        <td>{{$m->phonenumber}}</td>
                                        <td>{{$m->address}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>