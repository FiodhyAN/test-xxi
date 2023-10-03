<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product');
    }

    public function getProduct()
    {
        $product = Product::all();

        return DataTables::of($product)
            ->addIndexColumn()
            ->addColumn('kode_produk', function ($product) {
                return $product->kode_produk;
            })
            ->addColumn('nama_produk', function ($product) {
                return $product->nama_produk;
            })
            ->addColumn('kategori', function ($product) {
                return $product->kategori;
            })
            ->addColumn('harga_satuan', function ($product) {
                return 'Rp. ' . number_format($product->harga, 0, ',', '.');
            })
            ->addColumn('expired_date', function ($product) {
                return $product->expired_date;
            })
            ->addColumn('action', function ($product) {
                $btn = '';
                $btn_edit = '<button type="button" class="btn btn-sm btn-warning" id="editBtn" data-id="' . $product->id . '">Edit</button>';
                $btn_delete = '<button type="button" class="btn btn-sm btn-danger" id="deleteBtn" data-id="' . $product->id . '">Delete</button>';
                $btn = $btn_edit . ' ' . $btn_delete;
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function addProduct(Request $request)
    {
        $validator = Validator::make([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'harga_satuan' => $request->harga_satuan,
            'expired_date' => $request->expired_date,
            'foto_produk' => $request->foto_produk,
        ], [
            'kode_produk' => 'required|unique:products,kode_produk',
            'nama_produk' => 'required',
            'kategori' => 'required',
            'harga_satuan' => 'required|integer',
            'expired_date' => 'required|date',
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $imageName = time() . '.' . $request->foto_produk->extension();

        $request->foto_produk->move(public_path('images'), $imageName);

        $image_url = url('images/' . $imageName);

        Product::create([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'harga' => $request->harga_satuan,
            'expired_date' => $request->expired_date,
            'foto_produk' => $image_url,
        ]);

        return response()->json([
            'message' => 'Product added successfully!'
        ]);
    }

    public function getProductById(Request $request)
    {
        $product = Product::find($request->id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found!'
            ], 404);
        }

        return response()->json([
            'product' => $product
        ]);
    }

    public function updateProduct(Request $request)
    {
        $product = Product::find($request->id);
        if (!$product) {
            return response()->json([
                'message' => 'Product not found!'
            ], 404);
        }
        if ($product->kode_produk !== $request->kode_produk) {
            $validator = Validator::make([
                'kode_produk' => $request->kode_produk,
            ], [
                'kode_produk' => 'required|unique:products,kode_produk',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 400);
            }
        }
        $validator = Validator::make([
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'harga_satuan' => $request->harga_satuan,
            'expired_date' => $request->expired_date,
            'foto_produk' => $request->foto_produk,
        ], [
            'nama_produk' => 'required',
            'kategori' => 'required',
            'harga_satuan' => 'required|integer',
            'expired_date' => 'required|date',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $product->kode_produk = $request->kode_produk;
        $product->nama_produk = $request->nama_produk;
        $product->kategori = $request->kategori;
        $product->harga = $request->harga_satuan;
        $product->expired_date = $request->expired_date;

        if ($request->foto_produk) {
            $image_path = public_path('images') . '/' . basename($product->foto_produk);
            unlink($image_path);

            $imageName = time() . '.' . $request->foto_produk->extension();

            $request->foto_produk->move(public_path('images'), $imageName);

            $image_url = url('images/' . $imageName);

            $product->foto_produk = $image_url;
        }

        $product->save();

        return response()->json([
            'message' => 'Product updated successfully!'
        ]);
    }

    public function deleteProduct(Request $request)
    {
        $product = Product::find($request->id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found!'
            ], 404);
        }

        $image_path = public_path('images') . '/' . basename($product->foto_produk);
        unlink($image_path);

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully!'
        ]);
    }
}
