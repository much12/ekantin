@extends('master')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item" aria-current="page">User</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data User

                    <div class="float-right">
                        <button type="button" class="btn btn-custom-color btn-sm" onclick="addUser()">
                            <i class="fa fa-plus"></i>
                            Tambah User
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover w-100" id="table-users">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Balance</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php ($num = 1)
                                @foreach($users as $key => $value)

                                @if($value->userId !== getCurrentIdUser())
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->username }}</td>
                                    <td>{{ $value->balance }}</td>
                                    <td>{{ $value->role->roleName }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm btn-flat" onclick="editUser('{{ $value->userId }}')">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="deleteUser('{{ $value->userId }}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endif

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table-users').DataTable();
    });

    function addUser() {
        $.ajax({
            url: "{{ url()->current() . '/add' }}",
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.RESULT == 'OK') {
                    $('#ModalGlobal').html(response.CONTENT);
                    $('#ModalGlobal').modal('show');
                } else {
                    swalError(response.MESSAGE);
                }
            }
        }).fail(function() {
            swalError();
        });
    }

    function editUser(userId) {
        $.ajax({
            url: "{{ url()->current() . '/edit' }}",
            method: 'POST',
            dataType: 'json',
            data: {
                _token: '{{ csrf_token() }}',
                userId: userId
            },
            success: function(response) {
                if (response.RESULT == 'OK') {
                    $('#ModalGlobal').html(response.CONTENT);
                    $('#ModalGlobal').modal('show');
                } else {
                    swalError(response.MESSAGE);
                }
            }
        }).fail(function() {
            swalError();
        });
    }

    function deleteUser(userId) {
        swal({
            title: 'Apakah anda yakin?',
            text: 'Apakah anda yakin ingin menghapus user tersebut?',
            icon: 'warning',
            buttons: true,
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{ url()->current() . '/delete' }}",
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        userId: userId
                    },
                    success: function(response) {
                        if (response.RESULT == 'OK') {
                            swalSuccess(response.MESSAGE);

                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        } else {
                            swalMessage(response.MESSAGE);
                        }
                    }
                }).fail(function() {
                    swalError();
                });
            }
        });
    }
</script>
@endsection