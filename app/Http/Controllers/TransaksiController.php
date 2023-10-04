<?php

namespace App\Http\Controllers;

use App\Models\ProdukTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();

        return view('admin.pesanan', compact('transaksi'));
    }

    public function getTransaksiById(Request $request)
    {
        $transaksi = ProdukTransaksi::with('product', 'transaksi')->where('transaksi_id', $request->id)->get();

        return response()->json($transaksi);
    }
}
