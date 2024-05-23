<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();

        return view('admin.voucher.index', compact('transaksi'));
    }

    public function checkVoucher(Request $request)
    {
        $request->validate([
            'kode_voucher' => 'required|string'
        ]);

        $voucher = Transaksi::where('kode_voucher', $request->kode_voucher)->first();

        if (!$voucher) {
            return response()->json(['valid' => false, 'message' => 'Voucher tidak ditemukan.']);
        }

        if ($voucher->status_voucher === 'sudah digunakan') {
            return response()->json(['valid' => false, 'message' => 'Voucher sudah digunakan.']);
        }

        $createdAt = \Carbon\Carbon::parse($voucher->created_at);
        $isExpired = $createdAt->diffInDays(now()) > 30;
        $nilaiTukarVoucher = $voucher->nilai_tukar_voucher;

        if ($isExpired) {
            return response()->json(['valid' => false, 'message' => 'Voucher telah kedaluwarsa.']);
        } else {
            return response()->json(['valid' => true, 'nilai_tukar_voucher' => $nilaiTukarVoucher]);
        }
    }

    // public function checkVoucher(Request $request)
    // {
    //     $request->validate([
    //         'kode_voucher' => 'required|string'
    //     ]);

    //     $voucher = Transaksi::where('kode_voucher', $request->kode_voucher)->first();

    //     if (!$voucher) {
    //         return response()->json(['valid' => false, 'message' => 'Voucher tidak ditemukan.']);
    //     }

    //     if ($voucher->status_voucher === 'sudah digunakan') {
    //         return response()->json(['valid' => false, 'message' => 'Voucher sudah digunakan.']);
    //     }

    //     $createdAt = Carbon::parse($voucher->created_at);
    //     $isExpired = $createdAt->diffInDays(now()) > 30; // assuming vouchers are valid for 30 days
    //     $nilaiTukarVoucher = $voucher->nilai_tukar_voucher;

    //     if ($isExpired) {
    //         return response()->json(['valid' => false, 'message' => 'Voucher telah kedaluwarsa.']);
    //     } else {
    //         return response()->json(['valid' => true, 'nilai_tukar_voucher' => $nilaiTukarVoucher]);
    //     }
    // }

    public function redeemVoucher(Request $request)
    {
        $request->validate([
            'kode_voucher' => 'required|string'
        ]);

        $voucher = Transaksi::where('kode_voucher', $request->kode_voucher)->first();

        if (!$voucher) {
            return response()->json(['success' => false, 'message' => 'Voucher tidak ditemukan.']);
        }

        if ($voucher->status_voucher === 'sudah digunakan') {
            return response()->json(['success' => false, 'message' => 'Voucher sudah digunakan.']);
        }

        $voucher->update(['status_voucher' => 'sudah digunakan']);

        return response()->json(['success' => true, 'message' => 'Voucher berhasil ditukarkan.']);
    }
}
