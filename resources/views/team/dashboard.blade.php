@extends('layouts.dashboard_layout')

@section('active1')
	active
@endsection

@section('pagetitle')
	<b><i class="fas fa-tachometer-alt"></i> Dashboard</b>
@endsection

@section('content')
	<div class="card mb-4 elevation">
		<div class="card-body">
			@if ($errors->any())
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					@if(Session::has('error'))
						<h4><i class="text-danger fas fa-times mr-1"></i>{{Session::get('error')}}</h4>
					@endif

					<ul class="m-0">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif

			@if(Session::has('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif

			@if(Auth::user()->payment == null)
				<div class="alert alert-warning" role="alert">
					Tim <b>{{Auth::user()->teamname}}</b> belum melakukan pembayaran. Untuk melakukan pembayaran,
					Anda dapat melakukan pembayaran dengan mengirimkan biaya pendaftaran ke rekening xxxx-xxxxx-xxxxx dan mengirimkan foto bukti pembayaran dengan klik tombol berikut.<br>
					<button type="button" class="btn btn-dark mt-2" data-toggle="modal" data-target="#payment">
						<i class="fas fa-cloud-upload-alt"></i>
					</button>
				</div>

			@elseif((Auth::user()->payment != null) && (Auth::user()->confirmation == 0))
				<div class="alert alert-warning" role="alert">
					Tim <b>{{Auth::user()->teamname}}</b> sudah melakukan pembayaran. Status menunggu konfirmasi dari Admin. <br>
					<button type="button" class="btn btn-dark mt-2" data-toggle="modal" data-target="#payment">
						<i class="fas fa-cloud-upload-alt"></i>
					</button>
				</div>

			@elseif((Auth::user()->payment != null) && (Auth::user()->confirmation == 1))
				<div class="alert alert-success" role="alert">
					Tim <b>{{Auth::user()->teamname}}</b> sudah melakukan pembayaran. Pembayaran sudah divalidasi oleh Admin.
				</div>
			@endif

			<!-- Modal -->
			<div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-cloud-upload-alt"></i> Upload bukti pembayaran</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form enctype="multipart/form-data" action="/team/update-payment/{{Auth::user()->id}}" method="POST">
							@csrf
							{{method_field('PUT')}}
							<div class="modal-body">
								<div class="alert alert-warning" role="alert">
									Ukuran foto <span>tidak boleh</span> lebih dari 2 MB
								</div>
								<input id="file" class="" type="file" name="payment">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
								<button type="submit" name="submit" value="Simpan" class="btn btn-primary" required><i class="far fa-save"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="row justify-content-start pb-2" style="margin-left: 2px">
				<div class="col-md-4 p-0">
					<img style="" class="mb-2" height="350px" width="300px" src="/avatars/{{ Auth::user()->avatar}}"><br>
				</div>

				<div class="col-md-3 col-sm-4 p-0">
					<h5><b>Tim:</b> {{ Auth::user()->teamname }}</h5>
					<p><b>Divisi:</b> {{ Auth::user()->divisi }}</p>
					<p><b>Deskripsi:</b> {{ Auth::user()->description }}</p>
					<p><b>Dibuat tanggal:</b> {{date('d F Y', strtotime(Auth::user()->created_at))}}</p>
					<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#edit-team">
						<i class="fas fa-edit"></i>
					</button>

					<!-- Modal -->
					<div class="modal fade" id="edit-team" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Perbaharui profil tim</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form enctype="multipart/form-data" action="/team/{{Auth::user()->id}}" method="POST">
									@csrf
									{{method_field('PUT')}}
									<div class="modal-body">
										<div class="form-group row">
											<label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Username') }}</label>

											<div class="col-md-8">
												<input id="name" type="text" value="{{Auth::user()->name}}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus>

												@if ($errors->has('name'))
													<span class="invalid-feedback">
														<strong>{{ $errors->first('name') }}</strong>
													</span>
												@endif
											</div>
										</div>

										<div class="form-group row">
											<label for="teamname" class="col-md-4 col-form-label text-md-left">{{ __('Nama Tim') }}</label>

											<div class="col-md-8">
												<input id="teamname" type="text" value="{{Auth::user()->teamname}}" class="form-control{{ $errors->has('teamname') ? ' is-invalid' : '' }}" name="teamname" required>

												@if ($errors->has('teamname'))
													<span class="invalid-feedback">
														<strong>{{ $errors->first('teamname') }}</strong>
													</span>
												@endif
											</div>
										</div>

										<div class="form-group row">
											<label for="description" class="col-md-4 col-form-label text-md-left">{{ __('Deskripsi') }}</label>

											<div class="col-md-8">
												<textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }} mb-2" required>{{Auth::user()->description}}"</textarea>

												@if ($errors->has('description'))
													<span class="invalid-feedback">
														<strong>{{ $errors->first('description') }}</strong>
													</span>
												@endif
											</div>
										</div>


										<div class="form-group row">
											<label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Email') }}</label>

											<div class="col-md-8">
												<input id="email" type="text" value="{{Auth::user()->email}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>

												@if ($errors->has('email'))
													<span class="invalid-feedback">
														<strong>{{ $errors->first('email') }}</strong>
													</span>
												@endif
											</div>
										</div>

										<div class="form-group row">
											<label for="phonenumber" class="col-md-4 col-form-label text-md-left">{{ __('Nomor HP') }}</label>

											<div class="col-md-8">
												<input id="phonenumber" type="text" value="{{Auth::user()->phonenumber}}" class="form-control{{ $errors->has('phonenumber') ? ' is-invalid' : '' }}" name="phonenumber" required>

												@if ($errors->has('phonenumber'))
													<span class="invalid-feedback">
														<strong>{{ $errors->first('phonenumber') }}</strong>
													</span>
												@endif
											</div>
										</div>

										<div class="alert alert-warning text-md-left" role="alert">
											Ukuran foto <span>tidak boleh</span> lebih dari 2 MB
										</div>

										<div class="row">
											<label class="col-md-4" for="avatar">Foto profil</label>
											<input id="file" type="file" name="avatar" class="col-md-7">
									</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
										<button type="submit" name="submit" value="Simpan" class="btn btn-primary" required><i class="far fa-save"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="col-md-5 p-0">
					@if(Auth::user()->divisi == 'Dota')
					<img style="" class="mb-2" height="auto" width="300px" src="/img/Dota-2.png"><br>
					@else
					<img style="" class="mb-2" height="auto" width="400px" src="/img/ML.png"><br>
					@endif
				</div>
			</div>
		</div>
	</div>

	<div class="card mb-4 elevation">
		<h2 class="px-4 pt-4"><i class="fas fa-users"></i> Detail anggota</h2>
		<div class="card-body">
			<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#create-team">
				<i class="fas fa-user-plus"></i>
			</button>

			<!-- Modal -->
			<div class="modal fade" id="create-team" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Tambah anggota tim</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form enctype="multipart/form-data" action="{{route('member.store')}}" method="POST">
							@csrf
							<div class="modal-body">
								<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Nama Lengkap') }}</label>

									<div class="col-md-8">
										<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus>

									@if ($errors->has('name'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
								</div>

								<div class="form-group row">
									<label for="steamid" class="col-md-4 col-form-label text-md-left">{{ __('ID Steam') }}</label>

									<div class="col-md-8">
										<input id="steamid" type="text" class="form-control{{ $errors->has('steamid') ? ' is-invalid' : '' }}" name="steamid" required>

									@if ($errors->has('steamid'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('steamid') }}</strong>
										</span>
									@endif
								</div>
								</div>

								<div class="form-group row">
									<label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Email') }}</label>

									<div class="col-md-8">
										<input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>

									@if ($errors->has('email'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
								</div>

								<div class="form-group row">
									<label for="phonenumber" class="col-md-4 col-form-label text-md-left">{{ __('Nomor HP') }}</label>

									<div class="col-md-8">
										<input id="phonenumber" type="text" class="form-control{{ $errors->has('phonenumber') ? ' is-invalid' : '' }}" name="phonenumber" required>

									@if ($errors->has('phonenumber'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('phonenumber') }}</strong>
										</span>
									@endif
								</div>
								</div>

								<div class="form-group row">
									<label for="address" class="col-md-4 col-form-label text-md-left">{{ __('Alamat') }}</label>

									<div class="col-md-8">
									<textarea name="address" id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }} mb-2" required></textarea>

									@if ($errors->has('address'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('address') }}</strong>
										</span>
									@endif
								</div>
								</div>

								<div class="alert alert-warning text-md-left" role="alert">
									Ukuran foto <span>tidak boleh</span> lebih dari 2 MB
								</div>

								<div class="row">
									<label class="col-md-4" for="avatar">Foto profil</label>
									<input id="file" type="file" name="avatar" class="col-md-7">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
								<button type="submit" name="submit" value="Simpan" class="btn btn-primary"><i class="far fa-save"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
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
							<th style="min-width:50px">Aksi</th>
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
									<td>
										<div class="row justify-content-center">
											<div>
												{{-- Edit --}}
												<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#editModal{{$m->id}}"><i class="fas fa-edit"></i></button>

												<!-- Modal -->
												<div class="modal fade" id="editModal{{$m->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah anggota tim</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<form enctype="multipart/form-data" action="member/{{$m->id}}" method="POST">
																@csrf
																{{method_field('PUT')}}
																<div class="modal-body">
																	<div class="form-group row">
																		<label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Nama Lengkap') }}</label>

																		<div class="col-md-8">
																			<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $m->name }}" required autofocus>

																			@if ($errors->has('name'))
																				<span class="invalid-feedback">
																					<strong>{{ $errors->first('name') }}</strong>
																				</span>
																			@endif
																		</div>
																	</div>

																	<div class="form-group row">
																		<label for="steamid" class="col-md-4 col-form-label text-md-left">{{ __('ID Steam') }}</label>

																		<div class="col-md-8">
																			<input id="steamid" type="text" class="form-control{{ $errors->has('steamid') ? ' is-invalid' : '' }}" name="steamid" value="{{ $m->steamid }}" required>

																		@if ($errors->has('steamid'))
																			<span class="invalid-feedback">
																				<strong>{{ $errors->first('steamid') }}</strong>
																			</span>
																		@endif
																	</div>
																	</div>

																	<div class="form-group row">
																		<label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Email') }}</label>

																		<div class="col-md-8">
																			<input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $m->email }}" required>

																		@if ($errors->has('email'))
																			<span class="invalid-feedback">
																				<strong>{{ $errors->first('email') }}</strong>
																			</span>
																		@endif
																	</div>
																	</div>

																	<div class="form-group row">
																		<label for="phonenumber" class="col-md-4 col-form-label text-md-left">{{ __('Nomor HP') }}</label>

																		<div class="col-md-8">
																			<input id="phonenumber" type="text" class="form-control{{ $errors->has('phonenumber') ? ' is-invalid' : '' }}" name="phonenumber" value="{{ $m->phonenumber }}" required>

																		@if ($errors->has('phonenumber'))
																			<span class="invalid-feedback">
																				<strong>{{ $errors->first('phonenumber') }}</strong>
																			</span>
																		@endif
																	</div>
																	</div>

																	<div class="form-group row">
																		<label for="address" class="col-md-4 col-form-label text-md-left">{{ __('Alamat') }}</label>

																		<div class="col-md-8">
																			<textarea name="address" id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }} mb-2" required>{{$m->address}}</textarea>

																		@if ($errors->has('address'))
																			<span class="invalid-feedback">
																				<strong>{{ $errors->first('address') }}</strong>
																			</span>
																		@endif
																	</div>
																	</div>

																	<div class="alert alert-warning text-md-left" role="alert">
																		Ukuran foto <span>tidak boleh</span> lebih dari 2 MB
																	</div>

																	<div class="row">
																		<label class="col-md-4" for="avatar">Foto profil</label>
																		<input id="file" type="file" name="avatar" class="col-md-7">
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
																	<button type="submit" name="submit" value="Simpan" class="btn btn-primary" required><i class="far fa-save"></i></button>
																</div>
															</div>
														</form>
													</div>
												</div>
										</div>
										{{-- Delete --}}
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$m->id}}"><i class="fas fa-user-times"></i></button>
										<!-- Modal -->
										<div class="modal fade" id="deleteModal{{$m->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-user-times text-danger"></i> Konfirmasi</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<center><p>Apakah Anda yakin menghapus <b>{{$m->name}}</b></p></center>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
														<form class="form group" action="/member/{{$m->id}}" method="POST">
															@csrf
															{{method_field('DELETE')}}
															<button style="border-radius: 0px" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
														</form>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="8"><center>Tidak ada data</center></td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection