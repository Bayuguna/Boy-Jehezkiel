@extends('layouts.dashboard_layout')

@section('active3')
    active
@endsection

@section('pagetitle')
<b><i class="fas fa-envelope"></i> Pesan Masuk</b>
@endsection

@section('content')
    <div class="card mb-4 elevation">
        <div class="card-body">
            <a href="/user/message" style="color:black"><h3><i class="fas fa-arrow-left"></i></h3></a>

            <h3 class="mb-1">{{$currentMessage->subject}}</h3>
            <hr style="border-bottom:1px solid #E5E5E5">
            Diterima: {{date('d F Y', strtotime($currentMessage->created_at))}} pukul: {{date('H:i', strtotime($currentMessage->created_at))}} ({{$currentMessage->created_at->diffForHumans()}})
            <p>Dari: <b>{{$currentMessage->sender}}</b> | noreply@mail.com</p>
            <p>Pesan:<br>{{$currentMessage->message}}</p>
            {{-- Reply --}}
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#replyMessage">
                <i class="fas fa-reply"></i>
            </button>
            <!-- Modal -->
            <div class="modal fade" id="replyMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-reply"></i> Balas pesan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/user/message" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Ke') }}</label>

                                    <div class="col-md-8">
                                        <input id="sender" type="text" class="form-control" name="sender" value="{{$currentMessage->sender}}" disabled>

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
        </div>
    </div>
@endsection