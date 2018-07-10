@extends('layouts.admin_layout')

@section('active5')
	active
@endsection

@section('pagetitle')
	<b><i class="fas fa-calendar-alt"></i> Jadwal</b>
@endsection

@section('breadcrumb')
	<a href="/admin/schedule">Jadwal</a>
@endsection

@section('content')
	@if(count($location))
		@foreach($location as $l)
			<div class="alert alert-success elevation" role="alert">
				<h5><i class="fas fa-map-marker-alt"></i> Lokasi pertandingan: <b>{{$l->location}}</b><br></h5>
				{{-- Edit match location --}}
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changeLocationModal"><i class="fas fa-map"></i></button>
				<!-- Modal -->
				<div class="modal fade" id="changeLocationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title text-dark" id="exampleModalLongTitle"><i class="fas fa-map-marker-alt"></i> Ubah Lokasi Pertandaingan</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="/admin/location/update/{{$l->id}}" method="POST">
								@csrf
								{{method_field('PUT')}}
								<div class="modal-body">
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-left text-secondary" for="date">Lokasi</label>

										<div class="col-md-8">
											<textarea name="location" id="location" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" required autofocus></textarea>
											@if ($errors->has('location'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('location') }}</strong>
											</span>
											@endif
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
									<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@else
		<div class="alert alert-warning" role="alert">
			<p><i class="fas fa-map-marker-alt"></i> Lokasi pertandingan <b>belum ditentukan</b><br></p>
			{{-- Edit match location --}}
			<button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#changeLocationModal"><i class="fas fa-map"></i></button>
			<!-- Modal -->
			<div class="modal fade" id="changeLocationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-map-marker-alt text-secondary"></i><span class="text-secondary"> Tentukan lokasi pertandingan</span></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="/admin/location/add" method="POST">
							@csrf
							<div class="modal-body">
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-left" for="date">Lokasi</label>

									<div class="col-md-8">
										<textarea name="location" id="location" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" required autofocus></textarea>
										@if ($errors->has('location'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('location') }}</strong>
										</span>
										@endif
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
								<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endif
	<div class="card mb-4 elevation">
		<div class="card-body">
			{{-- Add Schedule --}}
			<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addJadwalModal"><i class="fas fa-calendar-plus"></i></button>
			<!-- Modal -->
			<div class="modal fade" id="addJadwalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-calendar-plus"></i> Tambah jadwal</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<form method="POST" action="{{route('schedule.store')}}">
							@csrf
							<div class="modal-body">
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-left" for="date">Tanggal</label>

									<div class="col-md-8">
										<input id="date" type="date" name="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" required autofocus>
										@if ($errors->has('date'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('date') }}</strong>
										</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-left" for="time">Waktu</label>

									<div class="col-md-8">
										<input id="time" type="time" name="time" class="form-control" required>
										@if ($errors->has('time'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('time') }}</strong>
										</span>
										@endif
									</div>
								</div>

								<div class="form-group row mb-0">
									<label class="col-md-4 col-form-label text-md-left" for="match">Pertandingan</label>
									<div class="form-group col-md-8">
										<div class="text-md-left">
											<label class="col-form-label" for="teamid1">Tim 1</label>
											<select name="teamid1" class="custom-select">
												@foreach($team as $t)
													<option value="{{$t->id}}">{{$t->teamname}}</option>
												@endforeach
											</select>
										</div>
										<div class="text-md-left">
											<label class="col-form-label" for="teamid2">Tim 2</label>
											<select name="teamid2" class="custom-select">
												@foreach($team as $t)
													<option value="{{$t->id}}">{{$t->teamname}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
								<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="table-responsive">
				<table id="datatables" class="table">
					<thead>
						<tr>
							<th>#</th>
							<th><center>Tanggal</center></th>
							<th><center>Waktu</center></th>
							<th><center>Pertandingan</center></th>
							<th><center>Aksi</center></th>
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
									<td>
										<center>
											{{-- Edit --}}
											<button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#updateModal{{$s->id}}"><i class="fas fa-edit"></i></button>
											<!-- Modal -->
											<div class="modal fade" id="updateModal{{$s->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered" role="document">
													<div class="modal-content">
														<div class="modal-header">
														<h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-edit"></i> Ubah jadwal</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
														</div>
														<form method="POST" action="/admin/schedule/{{$s->id}}">
															@csrf
															{{method_field('PUT')}}
															<div class="modal-body">
																<div class="form-group row">
																	<label class="col-md-4 col-form-label text-md-left" for="date">Tanggal</label>

																	<div class="col-md-8">
																		<input id="date" type="date" name="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" value="{{$s->date}}" required autofocus>
																		@if ($errors->has('date'))
																		<span class="invalid-feedback">
																			<strong>{{ $errors->first('date') }}</strong>
																		</span>
																		@endif
																	</div>
																</div>

																<div class="form-group row">
																	<label class="col-md-4 col-form-label text-md-left" for="time">Waktu</label>

																	<div class="col-md-8">
																		<input id="time" type="time" name="time" class="form-control" value="{{$s->time}}" required>
																		@if ($errors->has('time'))
																		<span class="invalid-feedback">
																			<strong>{{ $errors->first('time') }}</strong>
																		</span>
																		@endif
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-md-4 col-form-label text-md-left" for="match">Pertandingan</label>
																	<div class="form-group col-md-8">
																		<div class="text-md-left">
																			<label class="col-form-label" for="teamid1">Tim 1</label>
																			<select name="teamid1" class="custom-select">
																				@foreach($team as $t)
																					<option @if($t->id == $s->teamid1) selected @endif value="{{$t->id}}">{{$t->teamname}}</option>
																				@endforeach
																			</select>
																		</div>
																		<div class="text-md-left">
																			<label class="col-form-label" for="teamid2">Tim 2</label>
																			<select name="teamid2" class="custom-select">
																				@foreach($team as $t)
																					<option @if($t->id == $s->teamid2) selected @endif value="{{$t->id}}">{{$t->teamname}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
																<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
															</div>
														</form>
													</div>
												</div>
											</div>

											{{-- Delete --}}
											<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$s->id}}"><i class="fas fa-calendar-times"></i></button>
											<!-- Modal -->
											<div class="modal fade" id="deleteModal{{$s->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-calendar-times text-danger"></i> Konfirmasi</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<p>Apakah Anda yakin menghapus jadwal pertandingan <b>{{$s->team1}} vs {{$s->team2}}</b></p>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
															<form class="form group" action="/admin/schedule/{{$s->id}}" method="POST">
																@csrf
																{{method_field('DELETE')}}
																<button style="border-radius: 0px" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
															</form>
														</div>
													</div>
												</div>
											</div>
										</center>
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="5"><center>Tidak ada jadwal</center></td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection