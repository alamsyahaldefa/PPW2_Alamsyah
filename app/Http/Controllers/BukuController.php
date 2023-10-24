<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    //fungsi index
    public function index(){
        $data_buku = Buku::all();
        $no=0;

        $data_buku = Buku::all(); // Mengambil semua data dari model Data
        $totalBuku = count($data_buku); // Menghitung jumlah total data
    
        $data_buku = Buku::all();
        $totalHarga = Buku::sum('harga'); // Mengambil total harga dari semua buku

        return view('buku.index', compact('data_buku', 'no', 'totalBuku', 'totalHarga'));
    }


    public function create(){
        return view('buku.create');
    }

    public function store(Request $request){
        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();
        return redirect('/buku');
    }

    public function destroy($id) {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku');
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'judul' => 'required|max:255',
    ]);

    $buku = Buku::findOrFail($id);
    $buku->judul = $request->input('judul');


    $buku->save();

    return redirect()->route('buku.index')
        ->with('success', 'Data buku berhasil diperbarui.');
}

}
