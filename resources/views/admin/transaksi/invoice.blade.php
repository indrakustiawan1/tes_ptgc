<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('logo.png') }}" style="width:100%; max-width:300px;">
                            </td>
                            <td>
                                Invoice #: {{ $transaksi->id }}<br>
                                Created: {{ $transaksi->created_at }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                {{ $transaksi->customer_name }}<br>
                                {{ $transaksi->customer_address }}<br>
                                {{ $transaksi->customer_no_hp }}
                            </td>
                            <td>
                                Company Name<br>
                                John Doe<br>
                                john@example.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                <td>
                    Amount #
                </td>
            </tr>
            <tr class="details">
                <td>
                    Cash
                </td>
                <td>
                    {{ $transaksi->total_dibayar }}
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Item
                </td>
                <td>
                    Price
                </td>
            </tr>
            @foreach ($items as $item)
                <tr class="item">
                    <td>
                        {{ $item->produk->name }} ({{ $item->quantity }} x {{ $item->price }})
                    </td>
                    <td>
                        {{ $item->quantity * $item->price }}
                    </td>
                </tr>
            @endforeach
            <tr class="total">
                <td></td>
                <td>
                    Total: {{ $transaksi->total_harga }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
