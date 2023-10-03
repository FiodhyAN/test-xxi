<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $coffee = Product::where('kategori', 'coffee')->whereDate('expired_date', '>=', now())->get();
        $non_coffee = Product::where('kategori', 'non-coffee')->whereDate('expired_date', '>=', now())->get();
        return view('menu', compact('coffee', 'non_coffee'));
    }
}
