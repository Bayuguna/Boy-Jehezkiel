@extends('layouts.admin_layout')

@section('active4')
	active
@endsection

@section('pagetitle')
	<b><i class="fas fa-trophy"></i> Juara</b>
@endsection

@section('breadcrumb')
	<a href="/admin/champion">Juara</a>
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
				<i class="fas fa-plus"></i>
			</button>
			<!-- Modal -->
			<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-trophy"></i> Tambah Juara</b></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="/admin/champion" method="post">
							@csrf
							<div class="modal-body">
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-left" for="match">Tahun</label>
                                    <div class="form-group col-md-8">
                                        <select name="year" class="custom-select">
                                            <option>Pilih tahun..</option>
                                            <option value="2015">2015</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <label class="col-md-4 col-form-label text-md-left" for="match">Tim</label>
                                    <div class="form-group col-md-8">
                                        <select name="team_id" class="custom-select">
                                            <option>Pilih tim</option>
                                            @foreach($team as $t)
                                                <option value="{{$t->id}}">{{$t->teamname}}</option>
                                            @endforeach
                                        </select>
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
                        <th><center>Tahun</center></th>
                        <th><center>Nama Tim</center></th>
                        <th><center>Detail Tim</center></th>
                        <th><center>Aksi</center></th>
                    </thead>
                    <tbody>
                        @if(count($champion))
                            @foreach($champion as $c)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><center>{{$c->year}}</center></td>
                                    <td><center>{{$c->user->teamname}}</center></td>
                                    <td><center><a href="/admin/champion/{{$t->id}}" class="text-dark"><i style="font-size: 24px" class="fas fa-eye"></i></i></center></td>
                                    <td>
                                        <center>
                                            {{-- Edit --}}
                                            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#editModal{{$c->id}}"><i class="fas fa-edit"></i></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-trophy"></i> Tambah Juara</b></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/admin/champion/{{$c->id}}" method="post">
                                                            @csrf
                                                            {{method_field('PUT')}}
                                                            <div class="modal-body">
                                                                <div class="form-group row mb-0">
                                                                    <label class="col-md-4 col-form-label text-md-left" for="match">Tahun</label>
                                                                    <div class="form-group col-md-8">
                                                                        <select name="year" class="custom-select">
                                                                            <option value="{{$c->year}}">{{$c->year}}</option>
                                                                            <option value="2015">2015</option>
                                                                            <option value="2016">2016</option>
                                                                            <option value="2017">2017</option>
                                                                            <option value="2018">2018</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row mb-0">
                                                                    <label class="col-md-4 col-form-label text-md-left" for="match">Tim</label>
                                                                    <div class="form-group col-md-8">
                                                                        <select name="team_id" class="custom-select">
                                                                            @foreach($team as $t)
                                                                                <option @if($t->id == $c->team_id) selected @endif value="{{$t->id}}">{{$t->teamname}}</option>
                                                                            @endforeach
                                                                        </select>
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
                                            {{-- Delete --}}
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$c->id}}"><i class="fas fa-times"></i></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-times text-danger"></i> Konfirmasi</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <center><p>Apakah Anda yakin menghapus juara tahun <b>{{$c->year}}?</b></p></center>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
                                                            <form class="form group" action="/admin/champion/{{$c->id}}" method="POST">
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
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection