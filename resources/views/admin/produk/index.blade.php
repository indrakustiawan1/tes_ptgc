@extends('layouts.admin')
@section('title', 'Produk')
@section('content')
    <div class="content">
        <div class="page-header">
            <div>
                <h3>Produk</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Produk</li>
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
                                    data-target="#modalProduk" id="btn-add">Tambah</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label for="filter_urutTanggal">Latest/Oldest</label>
                                        <select data-column="1" class="form-control form-control-sm select2"
                                            data-toggle="select" aria-hidden="true" id="filter_urutTanggal">
                                            <option value="" selected>Semua</option>
                                            <option value="0">Latest to Oldest</option>
                                            <option value="1">Oldest to Latest</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="filter_urutNama">Name Order</label>
                                        <select data-column="1" class="form-control form-control-sm select2"
                                            data-toggle="select" aria-hidden="true" id="filter_urutNama">
                                            <option value="" selected>Semua</option>
                                            <option value="a-z">A to Z</option>
                                            <option value="z-a">Z to A</option>
                                        </select>
                                    </div>
                                </div>

                                <table id="dtProduk" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Terjual</th>
                                            <th>Kategori</th>
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

        <div class="modal" tabindex="-1" role="dialog" aria-labelledby="modalProdukLabel" id="modalProduk">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalProdukLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="formProduk">
                        <div class="modal-body">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                                <label for="name">Nama Produk</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter...">
                                <small class="text-danger err" id="nama_depan_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    placeholder="Enter...">
                                <small class="text-danger err" id="description_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input type="text" class="form-control" id="price" name="price"
                                    placeholder="Enter...">
                                <small class="text-danger err" id="price_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stok</label>
                                <input type="number" class="form-control" id="stock" name="stock"
                                    placeholder="Enter...">
                                <small class="text-danger err" id="stock_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="category">Kategori</label>
                                <input type="text" class="form-control" id="category" name="category"
                                    placeholder="Enter...">
                                <small class="text-danger err" id="category_error"></small>
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

            var SITEURL = "{{ route('produk.index') }}"

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var urutkanByTanggal = "";
            var urutkanByNama = "";

            var dtProduk = $('#dtProduk').DataTable({
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
                    url: "{{ route('produk.list') }}",
                    data: function(d) {
                        d.urutTanggal = urutkanByTanggal
                        d.urutNama = urutkanByNama;
                    }
                },

                columns: [{
                        orderable: false,
                        className: 'text-center',
                        width: '20px',
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'price',
                        name: 'price',
                    },
                    {
                        data: 'stock',
                        name: 'stock',
                    },
                    {
                        data: 'quantity_sold',
                        name: 'quantity_sold',
                    },
                    {
                        data: 'category',
                        name: 'category',
                    },
                    {
                        orderable: false,
                        width: '80px',
                        className: 'text-center',
                        data: 'action',
                    },
                ]
            });


            $('#filter_urutTanggal, #filter_urutNama')
                .change(function(e) {
                    urutkanByTanggal = $('#filter_urutTanggal').val();
                    urutkanByNama = $('#filter_urutNama').val();
                    dtProduk.draw();
                    e.preventDefault();
                });

            // create
            $('#formProduk').submit(function(e) {
                e.preventDefault()
                formData = new FormData($('#formProduk')[0])
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
                            $('#modalProduk').modal('hide');
                            $('#dtProduk').DataTable().ajax.reload(null, false)
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
                            $('#modalProduk').modal('show');
                            $('#id').val(response.data.id)
                            $('#name').val(response.data.name)
                            $('#description').val(response.data.description)
                            $('#price').val(response.data.price)
                            $('#stock').val(response.data.stock)
                            $('#category').val(response.data.category_id)
                        } else {
                            console.error('Data tidak ditemukan.');
                        }
                    }
                });
            });

            // // delete
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
                                    $('#dtPegawai').DataTable().ajax.reload(null, false)
                                    toastr.success('Data berhasil dihapus');
                                }
                            })
                        }
                    });
            })

            $('#btn-add').click(function(e) {
                $('#modalProdukLabel').html('Tambah Produk')
                $('#btn-save').html('Simpan')
                e.preventDefault()
                reset()
            });

            $('.cancel').click(function(e) {
                e.preventDefault()
                reset()
            });

            function reset() {
                $('#formProduk').trigger('reset')
                $("input[type=hidden]").val('')
                $('.err').empty()
            }
        });
    </script>
@endsection
