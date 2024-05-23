@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="content">
        <div class="page-header d-md-flex justify-content-between">
            <div>
                <h3>User</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                        {{-- <button type="button" class="btn btn-primary">Primary</button> --}}
                    </ol>
                </nav>
            </div>
            <div class="mt-3 mt-md-0">
                <div class="btn btn-outline-light">
                    <span>{{ now()->isoFormat('D MMMM Y') }}</span>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary btn-uppercase mt-1 mb-1">Tambah</button>
                    </div>
                    <div class="card-body">
                        <div class="row text-center justify-content-md-center">
                            <div class="table-responsive">
                                <table class="table" id="dtUser">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Email</th>
                                            <th class="text-right" scope="col">Aksi</th>
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
    </div>
@endsection

<script>
    $(document).ready(function() {

        var SITEURL = "{{ route('user') }}";

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
            language: {
                paginate: {
                    previous: "<i class='fa-solid fa-angle-left'>",
                    next: "<i class='fa-solid fa-angle-right'>"
                }
            },

            ajax: {
                type: 'POST',
                url: "{{ route('user-list') }}"
            },

            columns: [{
                    orderable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    width: '20px',
                    className: 'text-center'
                },
                {
                    data: 'nama',
                    name: 'nama',
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    orderable: false,
                    data: 'action',
                    width: '80px',
                    className: 'text-center'
                },
            ]
        });

        // create
        // $('#formAgama').submit(function(e) {
        //     e.preventDefault();
        //     formData = new FormData($('#formAgama')[0]);
        //     $.ajax({
        //         type: 'POST',
        //         url: SITEURL,
        //         data: formData,
        //         dataType: 'json',
        //         contentType: false,
        //         processData: false,
        //         beforeSend: function() {
        //             $('.err').empty();
        //             $('#btn-save').attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        //         },
        //         success: function(response) {
        //             console.log(response);
        //             $('#btn-save').attr('disabled', false).html('Simpan');
        //             if (response.status == false) {
        //                 $.each(response.error, function(i, val) {
        //                     $("#" + i + "_error").html(val[0])
        //                 });
        //             } else {
        //                 $('#modalAgama').modal('hide');
        //                 $('#dtAgama').DataTable().ajax.reload(null, false);
        //                 reset()
        //                 Toast.fire('Berhasil', `${response.message}`, 'success');
        //             }
        //         }
        //     });
        // });

        // // delete
        // $(document).on('click', '#btn-deleteAgama', function() {
        //     id = $(this).data('id')
        //     $.ajax({
        //         type: "delete",
        //         url: SITEURL + "/" + id,
        //         dataType: "json",
        //         success: function(response) {
        //             $('#dtAgama').DataTable().ajax.reload(null, false);
        //             Toast.fire('Berhasil', `${response.message}`, 'success');
        //         }
        //     });
        // });

        // // edit
        // $(document).on('click', '#btn-editAgama', function() {
        //     id = $(this).data('id')
        //     $.ajax({
        //         type: "get",
        //         url: SITEURL + "/" + id + "/edit",
        //         dataType: "json",
        //         success: function(response) {
        //             console.log(response)
        //             if (response.status) {
        //                 $('#modalAgama').modal('show');
        //                 $('#id').val(response.data.id)
        //                 $('#agama').val(response.data.agama)
        //             } else {
        //                 console.error('Data tidak ditemukan.');
        //             }
        //         }
        //     });
        // });

        $('#btn-addUser').click(function(e) {
            e.preventDefault();
            reset();
        });

        $('.cancel').click(function(e) {
            e.preventDefault();
            reset();
        });

        function reset() {
            $("input[type=hidden]").val('');
            $('#formUser').trigger('reset');
            $('.err').empty();
        }
    });
</script>
