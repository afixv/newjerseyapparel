<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('product.index', [
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1028',
            'stok' => 'required',
        ]);

        $imageName = time().'.'.$request->gambar->extension();

        $request->gambar->move(public_path('images'), $imageName);

        Product::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'harga_promo' => $request->harga_promo,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imageName,
            'stok' => $request->stok,
        ]);

        return redirect()->route('product.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1028',
            'stok' => 'required',
        ]);

        $imageName = time().'.'.$request->gambar->extension();

        $request->gambar->move(public_path('images'), $imageName);

        $product->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'harga_promo' => $request->harga_promo,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imageName,
            'stok' => $request->stok,
        ]);

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Product deleted successfully.');
    }
}
