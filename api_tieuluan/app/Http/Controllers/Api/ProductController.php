<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // 1. API Lấy danh sách sản phẩm (GET)
public function index()
{
    $products = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id') // Đã sửa 'products::category_id' thành 'products.category_id'
        ->select('products.*', 'categories.name as category_name')
        ->get();

    return response()->json([
        'status' => 'success',
        'data' => $products
    ], 200);
}

    // 2. API Thêm mới sản phẩm (POST)
    public function store(Request $request)
    {
        $productId = DB::table('products')->insertGetId([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Thêm sản phẩm thành công!',
            'product_id' => $productId
        ], 201);
    }

    // 3. API Cập nhật sản phẩm (PUT)
    public function update(Request $request, $id)
    {
        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'updated_at' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật sản phẩm thành công!'
        ], 200);
    }

    // 4. API Xóa sản phẩm (DELETE)
    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Xóa sản phẩm thành công!'
        ], 200);
    }
}