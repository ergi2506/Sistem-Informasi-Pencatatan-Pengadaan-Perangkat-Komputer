<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use PDF;
use Illuminate\Support\Facades\Auth;
// use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // echo "jalan";
        // die();
        $product = Product::orderBy('created_at', 'DESC')->paginate(5);

        return view('products.index', compact('product'));
    }
    public function cetakPdf()
    {
        if (Auth::user()->type != 'admin') { 
            return redirect()->route('product')->with('error', 'You do not have permission to Print products.'); 
        }
        $product = Product::get()->all();

        $pdf = PDF::loadView('cetakPdf', ['product' => $product]);
        return $pdf->stream('Laporan-Data-product.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->type != 'admin') { 
            return redirect()->route('product')->with('error', 'You do not have permission to create products.'); 
        }
        // $imageName = time().'.'.request()->file('image')->extension();
        // request()->image->move(public_path('images'), $imageName);
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->type != 'admin') { 
            return redirect()->route('products')->with('error', 'You do not have permission to store products.'); 
        }
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
        return redirect()->route('product')->with('success', 'Product Successfully Created!');    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }
    public function search(Request $request)
{
    $query = $request->input('query'); // Ambil input dari user
    $product = Product::where('title', 'LIKE', "%$query%") // Ganti 'title' dengan kolom yang sesuai
                      ->orWhere('description', 'LIKE', "%$query%")
                      ->orWhere('tahun_pengadaan', 'LIKE', "%$query%")
                      ->orWhere('lokasi_pengguna', 'LIKE', "%$query%")
                      ->paginate(5);

    return view('products.index', compact('product'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->type != 'admin') { 
            return redirect()->route('product')->with('error', 'You do not have permission to edit products.'); 
        }
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->type != 'admin') { 
            return redirect()->route('product')->with('error', 'You do not have permission to Update products.'); 
        }
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return redirect()->route('admin/products')->with('success', 'product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->type != 'admin') { 
            return redirect()->route('product')->with('error', 'You do not have permission to delete products.'); 
        }
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('admin/products')->with('success', 'product deleted successfully');
    }
}