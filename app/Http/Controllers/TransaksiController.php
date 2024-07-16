<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Transaksi_items;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
// use Barryvdh\DomPDF\Facade as PDF;
use TCPDF;

class TransaksiController extends Controller
{
    public function index()
    {
        $products = Produk::all();
        return view('admin.transaksi.index', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_address' => 'required|string|max:500',
            'customer_no_hp' => 'required|string|max:500',
            'product_id.*' => 'required|exists:produk,id',
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

                // Kurangi stok produk dan tambahkan quantity_sold
                $product = Produk::find($productId);
                $product->stock -= $request->quantity[$key];
                $product->quantity_sold += $request->quantity[$key];
                $product->save();
            }

            // Set transaction ID for response
            $transactionId = $transaction->id;
        });

        return response()->json(['transaction_id' => $transactionId]);
    }


    // public function cetak(Request $request)
    // {
    //     set_time_limit(120);
    //     $transaksi = Transaksi::find($request->transaction_id);
    //     if (!$transaksi) {
    //         abort(404, 'Transaksi tidak ditemukan');
    //     }

    //     $transaksi->change_amount = $request->change_amount;
    //     $items = Transaksi_items::where('id_transaksi', $transaksi->id)->with('produk')->get();

    //     $pdf = PDF::loadView('admin.transaksi.invoice', compact('transaksi', 'items'))->setPaper('a4', 'landscape');
    //     // return $pdf->stream();
    //     return $pdf->download('invoice-pdf');
    // }

    public function cetak(Request $request)
    {
        set_time_limit(120);
        $transaksi = Transaksi::find($request->transaction_id);
        if (!$transaksi) {
            abort(404, 'Transaksi tidak ditemukan');
        }

        $transaksi->change_amount = $request->change_amount;
        $items = Transaksi_items::where('id_transaksi', $transaksi->id)->with('produk')->get();

        // Buat objek TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();

        // Render view invoice dan tambahkan ke PDF
        $view = view('admin.transaksi.invoice', compact('transaksi', 'items'))->render();
        $pdf->writeHTML($view, true, false, true, false, '');

        // Hentikan output buffering sebelum mengirim headers
        if (ob_get_length()) {
            ob_end_clean();
        }

        // Set headers untuk download PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="invoice.pdf"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // Output PDF
        $pdf->Output('invoice.pdf', 'D');
        exit;
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

            // Pengurutan berdasarkan tanggal
            if ($request->has('urutTanggal')) {
                $urutTanggal = $request->input('urutTanggal');
                if ($urutTanggal == '0') {
                    $data->orderBy('created_at', 'desc'); // Urutkan dari terbaru ke terlama
                } elseif ($urutTanggal == '1') {
                    $data->orderBy('created_at', 'asc'); // Urutkan dari terlama ke terbaru
                }
            }
            // Pengurutan berdasarkan nama
            if ($request->has('urutNama')) {
                $urutNama = $request->input('urutNama');
                Log::info('urutNama: ' . $urutNama);
                if ($urutNama == 'a-z') {
                    $data->orderBy('customer_name', 'asc'); // Urutkan dari A ke Z
                    Log::info('Data ordered by name asc: ', $data->get()->toArray());
                } elseif ($urutNama == 'z-a') {
                    $data->orderBy('customer_name', 'desc'); // Urutkan dari Z ke A
                    Log::info('Data ordered by name desc: ', $data->get()->toArray());
                }
            }

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
                ->addColumn('kode_voucher', function ($value) {
                    if ($value->kode_voucher) {
                        return $value->kode_voucher . ' <button class="btn btn-sm btn-success copy-voucher" data-code="' . $value->kode_voucher . '"><i class="fa fa-copy"></i></button>';
                    }
                    return '';
                })
                ->rawColumns(['customer_name', 'customer_no_hp', 'customer_email', 'customer_address', 'total_harga', 'invoice', 'kode_voucher'])
                ->make(true);
        }
    }

    public function produkDenganPenjualanTerbanyak()
    {
        $produkPenjualan = Transaksi_items::select('id_produk')
            ->selectRaw('SUM(jumlah) as total_penjualan')
            ->groupBy('id_produk')
            ->orderBy('total_penjualan', 'desc')
            ->first();

        if (!$produkPenjualan) {
            return response()->json(['message' => 'Tidak ada data produk'], 404);
        }

        $idProdukTerbanyak = $produkPenjualan->id_produk;
        $produk = Produk::where('id', $idProdukTerbanyak)->first();
        $produk = $produk->name;
        $transaksiDenganProdukTerbanyak = Transaksi_items::where('id_produk', $idProdukTerbanyak)
            ->pluck('id_transaksi')
            ->unique();

        $transaksiDetail = Transaksi::whereIn('id', $transaksiDenganProdukTerbanyak)->get();

        return response()->json([
            'id_produk' => $idProdukTerbanyak,
            'name_produk' => $produk,
            'transaksi' => $transaksiDetail
        ]);
    }

    public function produkDenganPenjualanTerendah()
    {
        $produkPenjualan = Transaksi_items::select('id_produk')
            ->selectRaw('SUM(jumlah) as total_penjualan')
            ->groupBy('id_produk')
            ->orderBy('total_penjualan', 'asc')
            ->first();

        if (!$produkPenjualan) {
            return response()->json(['message' => 'Tidak ada data produk'], 404);
        }

        $idProdukTerendah = $produkPenjualan->id_produk;
        $produk = Produk::where('id', $idProdukTerendah)->first();
        $produk = $produk->name;
        $transaksiDenganProdukTerendah = Transaksi_items::where('id_produk', $idProdukTerendah)
            ->pluck('id_transaksi')
            ->unique();

        $transaksiDetail = Transaksi::whereIn('id', $transaksiDenganProdukTerendah)->get();

        return response()->json([
            'id_produk' => $idProdukTerendah,
            'name_produk' => $produk,
            'transaksi' => $transaksiDetail
        ]);
    }
}
