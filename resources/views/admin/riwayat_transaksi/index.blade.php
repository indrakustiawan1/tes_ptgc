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
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                    data-target="#" id="btn-add">Download</a>
                            </div>
                            <div class="card-body">
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

    <script>
        $(document).ready(function() {

            var SITEURL = "{{ route('riwayat_transaksi.index') }}"

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#dtRiwayatTransaksi').DataTable({
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
                    url: "{{ route('riwayat_transaksi.list') }}"
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
                ]
            });
        });
    </script>
@endsection
