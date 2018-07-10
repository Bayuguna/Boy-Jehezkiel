@extends('layouts.admin_layout')

@section('active1')
	active
@endsection

@section('pagetitle')
	<b><i class="fas fa-calendar-alt"></i> Dashboard</b>
@endsection

@section('breadcrumb')
    <a href="/admin/dashboard">Dashboard</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fas fa-users"></i>
                <div class="info">
                    <h4>Tim</h4>
                    <p><b>{{$teams}}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fas fa-credit-card fa-3x"></i>
                <div class="info">
                    <h4>Tim sudah bayar</h4>
                    <p><b>{{$team_paid}}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fas fa-credit-card fa-3x"></i>
                <div class="info">
                    <h4>Belum dikonfirmasi</h4>
                    <p><b>{{$team_unconfirmed}}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-times fa-3x"></i>
                <div class="info">
                    <h4>Tim belum bayar</h4>
                    <p><b>{{$team_notpaid}}</b></p>
                </div>
            </div>
        </div>
    </div>
@endsection