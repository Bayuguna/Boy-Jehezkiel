<!-- Show Member Modal -->
<div class="modal fade bd-example-modal-lg" id="teamDetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-users"></i> Detail Tim</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama anggota</th>
                                <th>Foto</th>
                                <th>ID Steam</th>
                                <th>Email</th>
                                <th>Nomor ponsel</th>
                                <th style="width: 150px;">Alamat</th>
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
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
        </div>
    </div>
</div>