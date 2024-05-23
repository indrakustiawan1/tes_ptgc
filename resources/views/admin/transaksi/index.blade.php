@extends('layouts.admin')

@section('title', 'Penjualan')

@section('content')
    <div class="content">
        <div class="page-header">
            <div>
                <h3>Penjualan</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Buat Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transaksi.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="customer_name" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="customer_name" name="customer_name"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customer_email" class="col-sm-2 col-form-label">Email Pelanggan</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="customer_email" name="customer_email"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customer_no_hp" class="col-sm-2 col-form-label">No HP</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="customer_no_hp" name="customer_no_hp"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customer_address" class="col-sm-2 col-form-label">Alamat Pelanggan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="customer_address" name="customer_address" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="products" class="col-sm-2 col-form-label">Produk</label>
                                <div class="col-sm-10">
                                    <table class="table table-bordered" id="product_table">
                                        <thead>
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th>Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-control product-select" name="product_id[]">
                                                        <option value="">Pilih Produk</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="number" class="form-control quantity-input"
                                                        name="quantity[]" required></td>
                                                <td><input type="number" class="form-control price-input" name="price[]"
                                                        required></td>
                                                <td><input type="number" class="form-control total-input" name="total[]"
                                                        readonly></td>
                                                <td><button type="button"
                                                        class="btn btn-danger remove-product">Hapus</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-success add-product">Tambah Produk</button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total_amount" class="col-sm-2 col-form-label">Total Keseluruhan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="total_amount" name="total_amount"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total_dibayar" class="col-sm-2 col-form-label">Jumlah Bayar</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="total_dibayar" name="total_dibayar">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Bayar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="receiptModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('transaksi.cetak') }}" method="GET" id="receiptForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Pembayaran Berhasil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert">
                            <i class="fa fa-exclamation-triangle"></i> Fitur cetak struk sedang dalam perbaikan.
                            Silakan lihat data transaksi di <a href="{{ route('riwayat_transaksi.index') }}">Riwayat
                                Transaksi</a>.
                        </div>
                        <p>Sisa Kembalian: <span id="changeAmountDisplay"></span></p>
                        <input type="hidden" name="change_amount" id="changeAmountInput">
                        <input type="hidden" name="transaction_id" id="transactionIdInput">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        {{-- <a href="{{ route('riwayat_transaksi.index') }}" class="btn btn-info">Riwayat Transaksi</a> --}}
                        <button type="submit" class="btn btn-primary" id="cetakBtn">Cetak Struk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function calculateTotal() {
                let totalAmount = 0;
                document.querySelectorAll('#product_table tbody tr').forEach(function(row) {
                    const quantity = row.querySelector('input[name="quantity[]"]').value;
                    const price = row.querySelector('input[name="price[]"]').value;
                    const total = quantity * price;
                    row.querySelector('input[name="total[]"]').value = total;
                    totalAmount += total;
                });
                document.getElementById('total_amount').value = totalAmount;
            }

            function fetchPrice(productSelect, row) {
                const productId = productSelect.value;
                if (productId) {
                    fetch(`/product/price/${productId}`)
                        .then(response => response.json())
                        .then(data => {
                            const priceInput = row.querySelector('input[name="price[]"]');
                            priceInput.value = data.price;
                            calculateTotal();
                        })
                        .catch(error => console.error('Error fetching price:', error));
                }
            }

            document.querySelector('.add-product').addEventListener('click', function() {
                const newRow = document.querySelector('#product_table tbody tr').cloneNode(true);
                newRow.querySelectorAll('input').forEach(input => input.value = '');
                newRow.querySelector('select').addEventListener('change', function() {
                    fetchPrice(this, newRow);
                });
                newRow.querySelector('.remove-product').addEventListener('click', function() {
                    newRow.remove();
                    calculateTotal();
                });
                newRow.querySelector('input[name="quantity[]"]').addEventListener('input', calculateTotal);
                newRow.querySelector('input[name="price[]"]').addEventListener('input', calculateTotal);
                document.querySelector('#product_table tbody').appendChild(newRow);
            });

            document.querySelectorAll('.product-select').forEach(select => {
                select.addEventListener('change', function() {
                    fetchPrice(this, this.closest('tr'));
                });
            });

            document.querySelectorAll('.remove-product').forEach(button => {
                button.addEventListener('click', function() {
                    button.closest('tr').remove();
                    calculateTotal();
                });
            });

            document.querySelectorAll('input[name="quantity[]"]').forEach(input => {
                input.addEventListener('input', calculateTotal);
            });

            document.querySelectorAll('input[name="price[]"]').forEach(input => {
                input.addEventListener('input', calculateTotal);
            });

            calculateTotal();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {

            function formatRupiah(angka) {
                const formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
                return formatter.format(angka);
            }

            $('form').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var totalAmount = parseFloat($('#total_amount').val());
                var totalDibayar = parseFloat($('#total_dibayar').val());
                var change = totalDibayar - totalAmount;
                var changeAmountFormatted = formatRupiah(change);

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    success: function(response) {
                        $('#receiptModal').modal('show');
                        $('#changeAmountDisplay').text(changeAmountFormatted);
                        $('#changeAmountInput').val(change);
                        $('#transactionIdInput').val(response.transaction_id);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
