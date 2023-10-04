<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProdukTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
    {
        $coffee = Product::where('kategori', 'coffee')->whereDate('expired_date', '>=', now())->get();
        $non_coffee = Product::where('kategori', 'non-coffee')->whereDate('expired_date', '>=', now())->get();
        return view('menu', compact('coffee', 'non_coffee'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [];
        }

        $existingProduct = null;
        foreach ($cart as $key => $item) {
            if ($item->id == $request->id  && $item->ukuran == $request->ukuran) {
                $existingProduct = $key;
                break;
            }
        }

        if ($existingProduct !== null) {
            $cart[$existingProduct]->quantity += $request->jumlah;
            $cart[$existingProduct]->harga += $request->harga_produk;
        } else {
            $cart[] = (object)[
                'id' => $product->id,
                'nama_produk' => $product->nama_produk,
                'harga' => $request->harga_produk,
                'quantity' => $request->jumlah,
                'ukuran' => $request->ukuran,
                'foto_produk' => $product->foto_produk,
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang!']);
    }



    public function getCart()
    {
        $cart = session()->get('cart');
        return response()->json($cart);
    }

    public function deleteCart(Request $request)
    {
        $cart = session()->get('cart');
        foreach ($cart as $key => $item) {
            if ($item->id == $request->id && $item->ukuran == $request->ukuran) {
                unset($cart[$key]);
                break;
            }
        }

        $cart = array_values($cart);

        session()->put('cart', $cart);

        return response()->json(session()->get('cart'));
    }

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        if (!session()->has('cart')) {
            return response()->json(['message' => 'Keranjang kosong!'], 400);
        }

        $cart = session()->get('cart');
        $total = 0;
        $quantity = 0;
        foreach ($cart as $item) {
            $total += $item->harga;
            $quantity += $item->quantity;
        }

        $transaksi = Transaksi::create([
            'no_transaksi' => 'TRX' . time(),
            'nama_pelanggan' => $request->nama_pelanggan,
            'jumlah' => $quantity,
            'harga_total' => $total,
        ]);

        foreach ($cart as $item) {
            ProdukTransaksi::create([
                'product_id' => $item->id,
                'transaksi_id' => $transaksi->id,
                'ukuran' => $item->ukuran,
                'jumlah_product' => $item->quantity,
                'harga_product' => $item->harga,
            ]);
        }

        session()->forget('cart');

        return response()->json(['message' => 'Checkout berhasil!']);
    }
}
