<?php

namespace App\Http\Controllers;

use App\Models\DetailKuota;
use App\Models\Corals;
use App\Models\Pengguna;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
class PenggunaController extends Controller
{
    public function index()
    {
        $penggunaInfo = Pengguna::with('perusahaan')->get();
        $perusahaanInfo = Perusahaan::all();
    
        return view('asosiasi.pengguna.user', compact('penggunaInfo', 'perusahaanInfo'));
    }
    
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'coral_id' => 'required|exists:corals,id',
            'quota_amount' => 'required|numeric',
        ]);
    
        // Cari data kuota yang sudah ada berdasarkan coral_id
        $quotaDetail = DetailKuota::where('coral_id', $validatedData['coral_id'])->first();
    
        if ($quotaDetail) {
            // Jika data sudah ada, tambahkan jumlah kuota baru ke jumlah kuota yang sudah ada
            $quotaDetail->jumlah_kuota += $validatedData['quota_amount'];
        } else {
            // Jika data belum ada, buat data baru
            $quotaDetail = new DetailKuota();
            $quotaDetail->coral_id = $validatedData['coral_id'];
            $quotaDetail->jumlah_kuota = $validatedData['quota_amount'];
        }
    
        // Simpan perubahan atau entri baru
        $quotaDetail->save();
    
        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data kuota berhasil ditambahkan atau diperbarui!');
    }


    // Menampilkan detail kuota untuk perusahaan
    public function indexPerusahaan()
    {
        // Ambil semua data kuota dan coral untuk perusahaan
        $quotaDetails = DetailKuota::with('coral')->get();
        $corals = Corals::all();

        // Menampilkan view kuota.perusahaan.detailperusahaan
        return view('perusahaan.kuota.detailperusahaan', compact('quotaDetails', 'corals'));
    }
    
    public function edit($id)
    {
        $quotaDetail = DetailKuota::findOrFail($id);
    
        // Return data untuk form edit
        return response()->json([
            'coral_id' => $quotaDetail->coral_id,
            'jumlah_kuota' => $quotaDetail->jumlah_kuota,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'coral_id' => 'required|exists:corals,id',
            'quota_amount' => 'required|integer|min:1',
        ]);
    
        $quotaDetail = DetailKuota::findOrFail($id);
        $quotaDetail->coral_id = $validated['coral_id'];
        $quotaDetail->jumlah_kuota = $validated['quota_amount'];
        $quotaDetail->save();
    
        return redirect()->route('kuota.index')->with('success', 'Kuota berhasil diperbarui.');
    }
    
    
    public function destroy($id)
    {
        try {
            $quotaDetail = DetailKuota::findOrFail($id);
            $quotaDetail->delete();
            
            // Mengembalikan respons JSON dengan status sukses
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            // Mengembalikan respons JSON dengan status gagal
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
    
}


