<?php

namespace App\Http\Controllers;

use App\Models\SlotParkir;
use App\Models\Tbdataparkir;
use Illuminate\Http\Request;

class SlotParkirController extends Controller
{
    public function index()
    {
        $slotParkirs = Tbdataparkir::all();
        return view('slotparkir.index', compact('slotParkirs'));
    }

    public function create()
    {
        return view('slotparkir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slot_parkir' => 'required|integer',
            'status' => 'required|in:Tersedia,Tidak Tersedia',
        ]);

        Tbdataparkir::create($request->all());

        return redirect()->route('slotparkir.index')
            ->with('success', 'Slot Parkir berhasil ditambahkan');
    }

    public function edit(Tbdataparkir $slotParkir)
    {
        return view('slotparkir.edit', compact('slotParkir'));
    }

    public function update(Request $request, Tbdataparkir $slotParkir)
    {
        $request->validate([
            'slot_parkir' => 'required|integer',
            'status' => 'required|in:Tersedia,Tidak Tersedia',
        ]);

        $slotParkir->update($request->all());

        return redirect()->route('slotparkir.index')
            ->with('success', 'Slot Parkir berhasil diperbarui');
    }

    public function destroy(Tbdataparkir $slotParkir)
    {
        $slotParkir->delete();

        return redirect()->route('slotparkir.index')
            ->with('success', 'Slot Parkir berhasil dihapus');
    }
}
