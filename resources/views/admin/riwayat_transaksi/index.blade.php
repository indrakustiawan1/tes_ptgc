@extends('layouts.admin')
@section('title', 'Riwayat Transaksi')
@section('content')
    <div class="content">
        <div class="page-header">
            <div>
                <h3>Riwayat Transaksi</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Transaksi</li>
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
                                    data-target="#" id="btn-add">Cetak</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-info float-right mr-2"
                                    data-toggle="modal" data-target="#modalTerlaris" id="btn-terlaris">Terlaris</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-warning float-right mr-2"
                                    data-toggle="modal" data-target="#modalKurangLaku" id="btn-kurangLaku">Kurang Laku</a>

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

                                <table id="dtRiwayatTransaksi" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Customer</th>
                                            <th>No. HP</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Total Belanja</th>
                                            <th>Invoice</th>
                                            <th>Kode Voucher</th>
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
        {{-- //terlaris --}}
        <div class="modal fade" id="modalTerlaris" tabindex="-1" role="dialog" aria-labelledby="modalTerlarisLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTerlarisLabel">Produk Terlaris</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalContent">
                    </div>
                </div>
            </div>
        </div>

        <!-- Kurang Laku -->
        <div class="modal fade" id="modalKurangLaku" tabindex="-1" role="dialog" aria-labelledby="modalKurangLakuLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalKurangLakuLabel">Produk Kurang Laku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalContentKurangLaku">
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
        $(document).ready(function() {
            var SITEURL = "{{ route('riwayat_transaksi.index') }}"

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var urutkanByTanggal = "";
            var urutkanByNama = "";
            var dtRiwayatTransaksi = $('#dtRiwayatTransaksi').DataTable({
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
                    url: "{{ route('riwayat_transaksi.list') }}",
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
                        data: 'customer_name',
                        name: 'customer_name',
                    },
                    {
                        data: 'customer_no_hp',
                        name: 'customer_no_hp',
                    },
                    {
                        data: 'customer_email',
                        name: 'customer_email',
                    },
                    {
                        data: 'customer_address',
                        name: 'customer_address',
                    },
                    {
                        data: 'total_harga',
                        name: 'total_harga',
                    },
                    {
                        data: 'invoice',
                        name: 'invoice',
                    },
                    {
                        data: 'kode_voucher',
                        name: 'kode_voucher',
                        render: function(data, type, row) {
                            return `
                                <span class="kode-voucher-text">${data}</span>
                                `;
                        },
                    },
                ]
            });

            $('#filter_urutTanggal, #filter_urutNama')
                .change(function(e) {
                    urutkanByTanggal = $('#filter_urutTanggal').val();
                    urutkanByNama = $('#filter_urutNama').val();
                    dtRiwayatTransaksi.draw();
                    e.preventDefault();
                });


            $(document).on('click', '.copy-voucher', function() {
                var voucherCode = $(this).data('code');
                navigator.clipboard.writeText(voucherCode).then(function() {
                    alert('Kode voucher disalin: ' + voucherCode);
                }, function(err) {
                    console.error('Gagal menyalin teks: ', err);
                });
            });

            $(document).ready(function() {
                $('#btn-terlaris').on('click', function() {
                    // Kirim AJAX request saat modal dibuka
                    $.ajax({
                        url: "{{ route('produk-terlaris') }}", // URL sesuai dengan route Anda
                        type: 'GET',
                        success: function(response) {
                            if (response.transaksi.length > 0) {
                                // Buat tabel untuk modal
                                let content =
                                    `<h4>Produk Terlaris: ${response.name_produk}</h4>`;
                                content += `<table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>No. HP</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody>`;

                                response.transaksi.forEach(function(transaksi) {
                                    content += `<tr>
                            <td>${transaksi.customer_name}</td>
                            <td>${transaksi.customer_no_hp}</td>
                            <td>${transaksi.customer_email}</td>
                            <td>${transaksi.customer_address}</td>
                            <td>${transaksi.invoice}</td>
                        </tr>`;
                                });

                                content += `</tbody></table>`;
                                $('#modalContent').html(content);
                            } else {
                                $('#modalContent').html(
                                    '<p>Tidak ada data produk.</p>');
                            }
                        },
                        error: function(xhr) {
                            $('#modalContent').html('<p>Terjadi kesalahan: ' + xhr
                                .status + ' ' + xhr.statusText + '</p>');
                        }
                    });
                });
            });

            $('#btn-kurangLaku').on('click', function() {
                $.ajax({
                    url: "{{ route('produk-kurang-laku') }}",
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        if (response.transaksi.length > 0) {
                            let content =
                                `<h4>Produk Kurang Laku: ${response.name_produk}</h4>`;
                            content += `<table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>No. HP</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Invoice</th>
                        </tr>
                    </thead>
                    <tbody>`;

                            response.transaksi.forEach(function(transaksi) {
                                content += `<tr>
                        <td>${transaksi.customer_name}</td>
                        <td>${transaksi.customer_no_hp}</td>
                        <td>${transaksi.customer_email}</td>
                        <td>${transaksi.customer_address}</td>
                        <td>${transaksi.invoice}</td>
                    </tr>`;
                            });

                            content += `</tbody></table>`;
                            $('#modalContentKurangLaku').html(content);
                        } else {
                            $('#modalContentKurangLaku').html('<p>Tidak ada data produk.</p>');
                        }
                    },
                    error: function(xhr) {
                        console.error('Terjadi kesalahan: ', xhr.status, xhr.statusText);
                        $('#modalContentKurangLaku').html('<p>Terjadi kesalahan: ' + xhr
                            .status + ' ' + xhr.statusText + '</p>');
                    }
                });
            });


        });
    </script>
@endsection
