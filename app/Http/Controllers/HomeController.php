<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Thêm dòng này để sử dụng model Product

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::latest()->take(12)->get(); // hoặc phân trang nếu muốn
        return view('index', compact('products'));
    }
}
