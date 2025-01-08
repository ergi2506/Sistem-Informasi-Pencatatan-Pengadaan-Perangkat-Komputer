@extends('layouts.app2')

@section('contents')
<div class="p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Selamat Datang, {{ Auth::user()->name }}</h1>

    <div class="grid grid-cols-2 gap-4">
        <!-- Kolom Jumlah Barang -->
        <a href="{{ route('admin/products') }}">
        <div class="p-6 bg-blue-400 text-white rounded-lg shadow-md">
            <h2 class="text-xl font-semibold">Total Barang</h2>
            <p class="text-3xl font-bold">{{ $jumlahproduct }}</p>
        </div>
    </a>

        <!-- Kolom Jumlah User -->
        <a>
        <div class="p-6 bg-green-400 text-white rounded-lg shadow-md">
            <h2 class="text-xl font-semibold">Total User</h2>
            <p class="text-3xl font-bold">{{ $jumlahuser }}</p>
        </div>
    </a>
    <!-- Kolom Jumlah Assets -->
    <a>
        <div class="p-6 bg-green-400 text-white rounded-lg shadow-md">
            <h2 class="text-xl font-semibold">Total Assets</h2>
            <p class="text-3xl font-bold">Rp {{ number_format($totalAssets, 0, ',', '.') }}</p>
        </div>
    </a>
    
    </div>
</div>
@endsection