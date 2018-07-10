@extends('layouts.admin_layout')

@section('active2')
	active
@endsection

@section('pagetitle')
	<b><i class="fas fa-user-secret"></i> Daftar Admin</b>
@endsection

@section('breadcrumb')
	<a href="/admin/admin-account-list">Daftar Admin</a>
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
			<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addAdminModal">
				<i class="fas fa-user-plus"></i>
			</button>
			<!-- Modal -->
			<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-user-plus"></i> Tambah akun admin</b></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="/admin/register" method="post">
							@csrf
							<div class="modal-body">
								<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Username') }}</label>

									<div class="col-md-8">
										<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

										@if ($errors->has('name'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('name') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail') }}</label>

									<div class="col-md-8">
										<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

										@if ($errors->has('email'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>

									<div class="col-md-8">
										<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

										@if ($errors->has('password'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('password') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Konfirmasi Password') }}</label>

									<div class="col-md-8">
										<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
								<button type="submit" name="submit" value="Simpan" class="btn btn-primary" required><i class="far fa-save"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="table-responsive">
				<table id="datatables" class="table">
					<thead>
						<th>#</th>
						<th><center>Nama</center></th>
						<th><center>Email</center></th>
						<th><center>Aksi</center></th>
					</thead>
					<tbody>
						@if(count($admin))
							@foreach($admin as $a)
								<tr>
									<td><center>{{$loop->iteration}}</center></td>
									<td><center>{{$a->name}}</center></td>
									<td><center>{{$a->email}}</center></td>
									<td>
										<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editAdmin{{$a->id}}">
											<i class="fas fa-edit"></i>
										</button></center>
										<!-- Modal -->
										<div class="modal fade" id="editAdmin{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-edit"></i> Ubah akun admin <b>{{$a->name}}</b></h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form action="/admin/update-account/{{$a->id}}" method="post">
														@csrf
														{{method_field('PUT')}}
														<div class="modal-body">
															<div class="form-group row">
																<label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Username') }}</label>

																<div class="col-md-8">
																	<input id="name" type="text" value="{{$a->name}}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

																	@if ($errors->has('name'))
																		<span class="invalid-feedback">
																			<strong>{{ $errors->first('name') }}</strong>
																		</span>
																	@endif
																</div>
															</div>

															<div class="form-group row">
																<label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail') }}</label>

																<div class="col-md-8">
																	<input id="email" type="email" value="{{$a->email}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

																	@if ($errors->has('email'))
																		<span class="invalid-feedback">
																			<strong>{{ $errors->first('email') }}</strong>
																		</span>
																	@endif
																</div>
															</div>

															<div class="form-group row">
																<label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>

																<div class="col-md-8">
																	<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

																	@if ($errors->has('password'))
																		<span class="invalid-feedback">
																			<strong>{{ $errors->first('password') }}</strong>
																		</span>
																	@endif
																</div>
															</div>

															<div class="form-group row">
																<label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Konfirmasi Password') }}</label>

																<div class="col-md-8">
																	<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
															<button type="submit" name="submit" value="Simpan" class="btn btn-primary" required><i class="far fa-save"></i></button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="2">Tidak ada tim</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection