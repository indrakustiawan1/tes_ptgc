@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="content">
        <div class="page-header">
            <div>
                <h3>Pengguna</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Admin</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="btn btn-sm btn-success float-right" data-toggle="modal"
                                    data-target="#modalUser" id="btn-add">Tambah</a>
                            </div>
                            <div class="card-body">
                                <table id="dtUser" class="table table-striped table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        //Modal
        <div class="modal" tabindex="-1" role="dialog" aria-labelledby="modalUserLabel" id="modalUser">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalUserLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="formUser">
                        <div class="modal-body">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                                <label for="name">Nama Depan</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter...">
                                <small class="text-danger err" id="name_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Belakang</label>
                                <input type="text" class="form-control" id="name_belakang" name="name_belakang"
                                    placeholder="Enter...">
                                <small class="text-danger err" id="name_belakang_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter...">
                                <small class="text-danger err" id="email_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter...">
                                <small class="text-danger err" id="password_error"></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary cancel" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" id="btn-save">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var SITEURL = "{{ route('user.index') }}"

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#dtUser').DataTable({
                responsive: true,
                paging: true,
                bDestroy: true,
                searching: true,
                ordering: false,
                lengthChange: true,
                autoWidth: false,
                aaSorting: [],
                serverSide: true,
                processing: true,
                searchDelay: 1000,

                ajax: {
                    type: 'POST',
                    url: "{{ route('user.list') }}"
                },

                columns: [{
                        orderable: false,
                        className: 'text-center',
                        width: '20px',
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'info',
                        name: 'info',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    // {
                    //     data: 'roles',
                    //     name: 'roles',
                    // },
                    {
                        orderable: false,
                        width: '80px',
                        className: 'text-center',
                        data: 'action',
                    },
                ]
            });

            // create
            $('#formUser').submit(function(e) {
                e.preventDefault()
                formData = new FormData($('#formUser')[0])

                $.ajax({
                    type: 'POST',
                    url: SITEURL,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.err').empty();
                        $('#btn-save').attr('disabled', true).html(
                            '<i class="fas fa-spinner fa-spin"></i>')
                    },
                    success: function(response) {
                        $('#btn-save').attr('disabled', false).html('Simpan')
                        if (response.status == false) {
                            $.each(response.error, function(i, val) {
                                $("#" + i + "_error").html(val[0])
                            });
                        } else {
                            $('#modalUser').modal('hide');
                            $('#dtUser').DataTable().ajax.reload(null, false)
                            reset();

                            if (response.message == 'create') {
                                toastr.success('Data berhasil ditambah')
                            } else {
                                toastr.success('Data berhasil diubah')
                            }
                        }
                    }
                });
            });

            // edit
            $(document).on('click', '#btn-edit', function() {
                id = $(this).data('id')
                $.ajax({
                    type: "get",
                    url: SITEURL + "/" + id + "/edit",
                    dataType: "json",
                    success: function(response) {
                        console.log(response)

                        if (response.status) {
                            $('#modalUser').modal('show');
                            $('#id').val(response.data.id)
                            $('#name').val(response.data.name)
                            $('#name_belakang').val(response.data.name_belakang)
                            $('#email').val(response.data.email)
                        } else {
                            console.error('Data tidak ditemukan.');
                        }
                    }
                });
            });

            delete
            $(document).on('click', '#btn-delete', function() {
                swal({
                        text: "Apakah kamu yakin?",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            id = $(this).data('id')
                            $.ajax({
                                type: "delete",
                                url: SITEURL + "/" + id,
                                dataType: "json",
                                success: function(response) {
                                    $('#dtUser').DataTable().ajax.reload(null, false)
                                    toastr.success('Data berhasil dihapus');
                                }
                            })
                        }
                    });
            })


            $('#btn-add').click(function(e) {
                // $('#modalUser').html('Tambah User')
                // $('#btn-save').html('Simpan')
                e.preventDefault()
                reset()
            });


            $('.cancel').click(function(e) {
                e.preventDefault()
                reset()
            });

            function reset() {
                $('#formUser').trigger('reset')
                $("input[type=hidden]").val('')
                $('.err').empty()
            }



        });
    </script>
@endsection
