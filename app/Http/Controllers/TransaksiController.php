<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Transaksi_items;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
// use Barryvdh\DomPDF\Facade as PDF;

class TransaksiController extends Controller
{
    public function index()
    {
        $products = Produk::all();
        return view('admin.transaksi.index', compact('products'));
    }

    // public function store(Request $request)
    // {
    //     // Validasi data
    //     $request->validate([
    //         'customer_name' => 'required|string|max:255',
    //         'customer_email' => 'required|email|max:255',
    //         'customer_address' => 'required|string|max:500',
    //         'customer_no_hp' => 'required|string|max:500',
    //         // 'transaction_date' => 'required|date',
    //         'product_id.*' => 'required|exists:produk,id',
    //         'quantity.*' => 'required|integer|min:1',
    //         'price.*' => 'required|numeric|min:0',
    //         'total.*' => 'required|numeric|min:0',
    //     ]);

    //     // Mulai transaksi database
    //     DB::transaction(function () use ($request) { // Ganti \DB::transaksi dengan \DB::transaction
    //         // Simpan data transaksi ke tabel `transactions`
    //         $invoice = 'INV-' . str::random(16);
    //         do {
    //             $kodeVoucher = 'VC-' . Str::random(16);
    //         } while (Transaksi::where('kode_voucher', $kodeVoucher)->exists());

    //         // Hitung nilai tukar voucher
    //         $totalHarga = array_sum($request->total);
    //         $nilaiTukarVoucher = (int) (floor($totalHarga / 1000000)) * 10000;

    //         $transaction = Transaksi::create([
    //             'customer_name' => $request->customer_name,
    //             'customer_email' => $request->customer_email,
    //             'customer_address' => $request->customer_address,
    //             'customer_no_hp' => $request->customer_no_hp,
    //             'invoice' => $invoice,
    //             'total_harga' => array_sum($request->total),
    //             'total_dibayar' => $request->total_dibayar,
    //             'kode_voucher' => $kodeVoucher,
    //             'nilai_tukar_voucher' => $nilaiTukarVoucher,
    //             'created_by' => Auth::user()->id,
    //             'created_at' => date('Y-m-d H:i:s'),
    //         ]);

    //         // Simpan item-item transaksi ke tabel `transaction_items`
    //         foreach ($request->product_id as $key => $productId) {
    //             Transaksi_items::create([
    //                 'id_transaksi' => $transaction->id,
    //                 'id_produk' => $productId,
    //                 'jumlah' => $request->quantity[$key],
    //                 'harga' => $request->price[$key],
    //                 'subtotal_harga' => $request->total[$key],
    //                 'created_by' => Auth::user()->id,
    //                 'created_at' => date('Y-m-d H:i:s'),
    //             ]);
    //         }
    //     });

    //     return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat.');
    // }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_address' => 'required|string|max:500',
            'customer_no_hp' => 'required|string|max:500',
            'product_id.*' => 'required|exists:produk,id',
            'quantity.*' => 'required|integer|min:1',
            'price.*' => 'required|numeric|min:0',
            'total.*' => 'required|numeric|min:0',
        ]);

        $transactionId = null;

        // Mulai transaksi database
        DB::transaction(function () use ($request, &$transactionId) {
            // Simpan data transaksi ke tabel `transactions`
            $invoice = 'INV-' . Str::random(16);
            $kodeVoucher = null;
            if ($request->total_amount >= 1000000) {
                do {
                    $kodeVoucher = 'VC-' . Str::random(16);
                } while (Transaksi::where('kode_voucher', $kodeVoucher)->exists());
            }
            $nilaiTukarVoucher = (int) (floor($request->total_amount / 1000000)) * 10000;

            $transaction = Transaksi::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_address' => $request->customer_address,
                'customer_no_hp' => $request->customer_no_hp,
                'invoice' => $invoice,
                'total_harga' => array_sum($request->total),
                'total_dibayar' => $request->total_dibayar,
                'kode_voucher' => $kodeVoucher,
                'nilai_tukar_voucher' => $nilaiTukarVoucher,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            // Simpan item-item transaksi ke tabel `transaction_items`
            foreach ($request->product_id as $key => $productId) {
                Transaksi_items::create([
                    'id_transaksi' => $transaction->id,
                    'id_produk' => $productId,
                    'jumlah' => $request->quantity[$key],
                    'harga' => $request->price[$key],
                    'subtotal_harga' => $request->total[$key],
                    'created_by' => Auth::user()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }

            // Set transaction ID for response
            $transactionId = $transaction->id;
        });

        return response()->json(['transaction_id' => $transactionId]);
    }

    public function cetak(Request $request)
    {
        set_time_limit(120);
        $transaksi = Transaksi::find($request->transaction_id);
        if (!$transaksi) {
            abort(404, 'Transaksi tidak ditemukan');
        }

        $transaksi->change_amount = $request->change_amount;
        $items = Transaksi_items::where('id_transaksi', $transaksi->id)->with('produk')->get();

        $pdf = PDF::loadView('admin.transaksi.invoice', compact('transaksi', 'items'))->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return $pdf->download('invoice-pdf');
    }



    public function index_riwayat_transaksi()
    {
        $transaksi = Transaksi::all();
        return view('admin.riwayat_transaksi.index', compact('transaksi'));
    }

    public function riwayat_transaksi_list(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaksi::where('created_by', Auth::user()->id);
            return DataTables::of($data->get())
                ->addIndexColumn()
                ->addColumn('customer_name', function ($value) {
                    return $value->customer_name;
                })
                ->addColumn('customer_no_hp', function ($value) {
                    return $value->customer_no_hp;
                })
                ->addColumn('customer_email', function ($value) {
                    return $value->customer_email;
                })
                ->addColumn('customer_address', function ($value) {
                    return '<div style="white-space: normal;">' . $value->customer_address . '</div>';
                })
                ->addColumn('total_harga', function ($value) {
                    return 'Rp ' . number_format($value->total_harga, 0, ',', '.');
                })
                ->addColumn('invoice', function ($value) {
                    return $value->invoice;
                })
                ->rawColumns(['customer_name', 'customer_no_hp', 'customer_email', 'customer_address', 'total_harga', 'invoice'])
                ->make(true);
        }
    }
}