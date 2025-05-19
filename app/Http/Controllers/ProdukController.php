<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Str;
use Image;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $data = Produk::all();
        // dd($data);
        return view('produk.index', compact('data'));
    }
    
    public function create(Request $request)
    {
        return view('produk.create');

    }

    public function store(Request $request)
    {
        // dd($request->hasFile('foto'));
        // Validasi input
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'nullable|string',
            'harga_produk' => 'required|numeric',
            'jumlah_produk' => 'required|integer',
        ]);


        if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '-' . Str::slug($request->nama_produk) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('produk_images', $filename, 'public');
    }
        // dd($filename);
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga_produk' => $request->harga_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'foto' => $filename,
        ]);


        // Redirect ke halaman produk dengan pesan sukses
        return redirect()->route('listProduk')->with('success', 'Produk berhasil ditambahkan!');
    }
}
