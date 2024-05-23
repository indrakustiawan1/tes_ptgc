@extends('layouts.admin')

@section('title', 'Voucher')

@section('content')
    <div class="content">
        <div class="page-header">
            <div>
                <h3>Voucher</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Voucher</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Periksa dan Tukarkan Voucher</h5>
                    </div>
                    <div class="card-body">
                        <form id="voucherForm">
                            @csrf
                            <div class="form-group row">
                                <label for="kode_voucher" class="col-sm-2 col-form-label">Kode Voucher</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kode_voucher" name="kode_voucher"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Periksa</button>
                                </div>
                            </div>
                        </form>
                        <div id="voucherResult" class="mt-4">
                            <div class="alert" role="alert" id="voucherMessage" style="display: none;"></div>
                            <div id="voucherDetails" style="display: none;">
                                <p>Nilai Tukar Voucher: <span id="nilaiTukarVoucher"></span></p>
                                <button id="redeemVoucherBtn" class="btn btn-success">Tukarkan Voucher</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#voucherForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('voucher.check') }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#voucherMessage').hide();
                        $('#voucherDetails').hide();

                        if (response.valid) {
                            $('#voucherDetails').show();
                            $('#nilaiTukarVoucher').text(response.nilai_tukar_voucher);
                            $('#redeemVoucherBtn').data('kode-voucher', $('#kode_voucher')
                                .val());
                        } else {
                            $('#voucherMessage').removeClass('alert-success').addClass(
                                'alert-danger').text(response.message).show();
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#voucherMessage').removeClass('alert-success').addClass(
                                'alert-danger').text('Terjadi kesalahan. Silakan coba lagi.')
                            .show();
                    }
                });
            });

            $('#redeemVoucherBtn').click(function() {
                var kodeVoucher = $(this).data('kode-voucher');

                $.ajax({
                    url: '{{ route('voucher.redeem') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        kode_voucher: kodeVoucher
                    },
                    success: function(response) {
                        $('#voucherMessage').hide();
                        if (response.success) {
                            $('#voucherMessage').removeClass('alert-danger').addClass(
                                'alert-success').text(response.message).show();
                            $('#voucherDetails').hide();
                        } else {
                            $('#voucherMessage').removeClass('alert-success').addClass(
                                'alert-danger').text(response.message).show();
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#voucherMessage').removeClass('alert-success').addClass(
                                'alert-danger').text('Terjadi kesalahan. Silakan coba lagi.')
                            .show();
                    }
                });
            });
        });
    </script>
@endsection
