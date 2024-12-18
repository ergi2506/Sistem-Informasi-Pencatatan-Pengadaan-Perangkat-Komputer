<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use PDF;
// use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::orderBy('created_at', 'DESC')->get();

        return view('products.index', compact('product'));
    }
    public function cetakPdf()
    {
        $product = Product::get()->all();

        $pdf = PDF::loadView('cetakPdf', ['product' => $product]);
        return $pdf->stream('Laporan-Data-product.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $imageName = time().'.'.request()->file('image')->extension();
        // request()->image->move(public_path('images'), $imageName);
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'product_code' => 'required',
            'description' => 'required',
            'lokasi_pengguna' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'tahun_pengadaan' => 'required',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        $product = new Product;
        $product->image = $image->hashName(); // Menyimpan nama file gambar yang telah di-hash
        $product->title = $request->title;
        $product->price = $request->price;
        $product->product_code = $request->product_code;
        $product->description = $request->description;
        $product->lokasi_pengguna = $request->lokasi_pengguna;
        $product->tahun_pengadaan = $request->tahun_pengadaan;

        $product->save();
        return back()->withSuccess('Product Successfully Created!!!!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return redirect()->route('admin/products')->with('success', 'product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('admin/products')->with('success', 'product deleted successfully');
    }
}