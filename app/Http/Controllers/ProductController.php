<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::all();

        return response()->json([
            'error' => 'false',
            'data' => $products
        ],200);
    }

    public function detail($id){
        $product = Product::find($id);

        if ($product) {
            return response()->json([
                'error' => 'false',
                'data' => $product
            ],200);
        } else {
            return response()->json([
                'error' => 'true',
                'message' => 'Data tidak ditemukan'
            ],400);
        }
    }

    public function store(Request $request){
        try {
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->category_id = $request->category_id;

            if ($product->save()) {
                return response()->json([
                    'error' => 'false',
                    'success' => 'true'
                ],201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'true',
                'success' => 'false',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function update(Request $request, $id){
        try {
            $product = Product::findOrfail($id);
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->category_id = $request->category_id;

            if ($product->save()) {
                return response()->json([
                    'error' => 'false',
                    'success' => 'true'
                ],200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'true',
                'success' => 'false',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function destroy(Request $request){
        try {
            $product = Product::find($request->id);

            if ($product->delete()) {
                return response()->json([
                    'error' => 'false',
                    'success' => 'true'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'true',
                'success' => 'false',
                'message' => $e->getMessage()
            ],400);
        }
    }
}
