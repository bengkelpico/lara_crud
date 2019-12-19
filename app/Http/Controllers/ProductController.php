<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::limit(10)->get();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function lists()
    {
        $products = Product::limit(10)->get();

        return \response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->all();
        $post['gbr_product'] = $request->file('gbr_product')->store('avatars');
        $save = Product::create($post);

        return \response()->json(['status', $save]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param mixed $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find(['id_product' => $id])->first();
        $product->merk = $request->input('merk');
        $product->harga = $request->input('harga');
        $product->stok = $request->input('stok');
        try {
            $product->gbr_product = $request->file('gbr_product')->store('avatars');
        } catch (\Throwable $err) {
            // $product->gbr_product = 'kosong';
        }
        $save = $product->save();

        return \response()->json(['status' => $save]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find(['id_product' => $id])->first();

        return \response()->json(['status' => $product->delete()]);
    }
}
