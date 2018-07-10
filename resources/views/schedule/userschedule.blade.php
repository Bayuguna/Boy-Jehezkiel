
@extends('layouts.dashboard_layout')

@section('active2')
	active
@endsection

@section('pagetitle')
	<b><i class="fas fa-calendar-alt"></i> Jadwal</b>
@endsection
@section('content')
	<div class="card mb-4 elevation">
		<div class="card-body">
			@if(count($location))
				@foreach($location as $l)
					<div class="alert alert-success" role="alert">
						<h5><i class="fas fa-map-marker-alt"></i> Lokasi pertandingan: <b>{{$l->location}}</b></h5>
					</div>
				@endforeach
			@else
				<div class="alert alert-warning" role="alert">
					<i class="fas fa-map-marker-alt"></i> Tempat pertandingan belum ditentukan</b>
				</div>
			@endif

			<div class="table-responsive">
				<table id="datatables" class="table">
					<thead>
						<tr>
							<th>#</th>
							<th><center>Tanggal</center></th>
							<th><center>Waktu</center></th>
							<th><center>Pertandingan</center></th>
						</tr>
					</thead>
					<tbody>
						@if(count($schedule))
							@foreach($schedule as $s)
								<tr>
									<td><center>{{$loop->iteration}}</center></td>
									<td><center>{{date('d F Y', strtotime($s->date))}}</center></td>
									<td><center>{{date('h:i', strtotime($s->time))}}</center></td>
									<td><center>{{$s->team1}} vs {{$s->team2}}</center></td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="4"><center>Tidak ada jadwal</center></td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection