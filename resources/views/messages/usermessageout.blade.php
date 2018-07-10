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
            <!-- buat pesan -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#create-team">
                <i class="fas fa-plus"></i>
            </button>
            <!-- Modal -->
            <div class="modal fade" id="create-team" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Buat Pesan Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/user/message-out" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Pengirim') }}</label>

                                    <div class="col-md-8">
                                        <input id="sender" type="text" class="form-control" name="sender" value="{{Auth::user()->teamname}}" disabled>

                                        @if ($errors->has('sender'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('sender') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="subject" class="col-md-4 col-form-label text-md-left">{{ __('Subjek') }}</label>

                                    <div class="col-md-8">
                                        <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" required>

                                        @if ($errors->has('subject'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('subject') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="message" class="col-md-4 col-form-label text-md-left">{{ __('Pesan') }}</label>

                                    <div class="col-md-8">
                                    <textarea name="message" id="message" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }} mb-2" required></textarea>

                                        @if ($errors->has('message'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                        @endif
                                    </div>
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
                        <th>#</th>
                        <th><center>Subjek</center></th>
                        <th><center>Pesan</center></th>
                        <th><center>Waktu</center></th>
                        <th><center>Aksi</center></th>
                    </thead>
                    <tbody>
                        @if(count($userMessage))
                            @foreach($userMessage as $m)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><center>{{$m->subject}}</center></td>
                                    <td>
                                        <center>
                                            <a href="/user/message-out/{{$m->id}}"><i style="font-size: 24px; color:#343a40" class="fas fa-eye"></i></a>
                                        </center>
                                    </td>
                                    <td><center>{{date('d F Y', strtotime($m->created_at))}}</center></td>
                                    <td>
                                        <center>
                                            {{-- Delete --}}
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$m->id}}"><i class="fas fa-trash-alt"></i></button>
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
                                                            <center><p>Apakah Anda yakin menghapus pesan dari <b>{{$m->user->teamname}}</b></p></center>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
                                                            <form class="form group" action="/user/message-out/{{$m->id}}" method="POST">
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
                                <td colspan="4"><center>Tidak ada pesan</center></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection