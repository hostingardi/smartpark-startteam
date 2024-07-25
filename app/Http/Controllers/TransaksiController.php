<?php

namespace App\Http\Controllers;

use App\Models\Tbtransaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Tbtransaksi::all();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:tbuser,Id_user',
            'idkendaraan' => 'required|exists:tbkendaraan,id_kendaraan',
            'hargaparkir' => 'required|integer',
            'waktupembayaran' => 'required|date',
        ]);

        Tbtransaksi::create($request->all());

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan');

            
    }

    public function edit(Tbtransaksi $transaksi)
    {
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, Tbtransaksi $transaksi)
    {
        $request->validate([
            'iduser' => 'required|exists:tbuser,Id_user',
            'idkendaraan' => 'required|exists:tbkendaraan,id_kendaraan',
            'hargaparkir' => 'required|integer',
            'waktupembayaran' => 'required|date',
        ]);

        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui');
    }

   
    public function destroy($id)
    {
        $transaksi = Tbtransaksi::findOrFail($id);
        $transaksi->delete();
    
        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi berhasil dihapus');
    }
    

    public function show($idtransaksi)
{
    $transaksi = Tbtransaksi::findOrFail($idtransaksi); // Ganti model Transaksi dengan model yang sesuai

    return view('transaksi.show', compact('transaksi'));
}

}
