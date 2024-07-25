<?php

namespace App\Http\Controllers;

use App\Models\Tbtransaksi;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        return view('kasir.dashboard');
    }

    public function dashboard()
    {
        // Ambil data transaksi sebagai contoh
        $transaksiHariIni = Tbtransaksi::whereDate('created_at', today())->get();
        $totalTransaksiHariIni = $transaksiHariIni->sum('jumlah'); // Sesuaikan dengan field di tabel transaksi Anda

        return view('cashier.dashboard', [
            'transaksiHariIni' => $transaksiHariIni,
            'totalTransaksiHariIni' => $totalTransaksiHariIni,
        ]);
    }
    

    
   
}
