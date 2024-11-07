<?php

namespace App\Http\Controllers;

use App\Models\DetailKuota;
use App\Models\Corals;
use Illuminate\Http\Request;

class DetailKuotaController extends Controller
{
    public function index()
    {
        // Ambil semua data quota details beserta informasi coral yang terkait
        $quotaDetails = DetailKuota::with('corals')->get();

        // Ambil semua data coral untuk dropdown
        $corals = Corals::all();

        // Kirim data ke view
        return view('kuota.detailkuota', compact('quotaDetails', 'corals'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'coral_id' => 'required|exists:corals,id',
            'quota_amount' => 'required|integer',
        ]);

        // Simpan data detail kuota
        DetailKuota::create([
            'coral_id' => $request->coral_id,
            'jumlah_kuota' => $request->quota_amount,
        ]);

        return redirect()->route('kuota.tahunan.index');
    }

    public function edit($id)
    {
        // Ambil detail kuota berdasarkan ID
        $quotaDetail = DetailKuota::findOrFail($id);
        return response()->json($quotaDetail); // Kirim data dalam format JSON
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'coral_id' => 'required|exists:corals,id',
            'quota_amount' => 'required|integer',
        ]);

        // Update data detail kuota
        $quotaDetail = DetailKuota::findOrFail($id);
        $quotaDetail->update([
            'coral_id' => $request->coral_id,
            'jumlah_kuota' => $request->quota_amount,
        ]);

        return redirect()->route('kuota.tahunan.index');
    }

    public function destroy($id)
    {
        // Hapus data detail kuota
        $quotaDetail = DetailKuota::findOrFail($id);
        $quotaDetail->delete();

        return redirect()->route('kuota.detailkuota.index');
    }
}


