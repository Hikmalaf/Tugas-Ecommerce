<?php

namespace App\Http\Controllers;

use App\Models\Corals;
use App\Models\DetailKuota;
use App\Models\PermohonanEkspor;
use App\Models\DetailPermohonan;
use App\Models\Perusahaan; // Model untuk tabel perusahaans
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermohonanEksporController extends Controller
{
    // Menampilkan daftar permohonan ekspor
    public function index()
    {
        // Mengambil semua permohonan ekspor beserta perusahaan
        $permohonanEkspor = PermohonanEkspor::with('perusahaan')->get();
        
        // Mengambil semua jenis karang dari tabel 'corals'
        $corals = Corals::all();
        
        // Mengambil semua perusahaan
        $perusahaans = Perusahaan::all();  // Menambahkan data perusahaan

        // Mengirim data permohonan ekspor, jenis karang, dan perusahaan ke view
        return view('perusahaan.permohonan.permohonan', compact('permohonanEkspor', 'corals', 'perusahaans'));
    }
    
    public function store(Request $request)
    {
        // Validasi data permohonan ekspor
        $request->validate([
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'nomor_permohonan' => 'required|string',
            'tanggal_permohonan' => 'required|date',
            'negara_tujuan' => 'required|string',
            'file_permohonan' => 'nullable|file|mimes:pdf,docx,jpg,jpeg,png',
            'corals' => 'required|array',
            'corals.*.coral_id' => 'required|exists:corals,id',
            'corals.*.jumlah' => 'required|numeric|min:1',
        ]);
    
        // Menyimpan permohonan ekspor
        $permohonan = new PermohonanEkspor();
        $permohonan->perusahaan_id = $request->perusahaan_id;
        $permohonan->nomor_permohonan = $request->nomor_permohonan;
        $permohonan->tanggal_permohonan = $request->tanggal_permohonan;
        $permohonan->negara_tujuan = $request->negara_tujuan;
    
        // Jika ada file permohonan, simpan file tersebut
        if ($request->hasFile('file_permohonan')) {
            $file = $request->file('file_permohonan');
            $path = $file->store('permohonan_files');
            $permohonan->file_permohonan = $path;
        }
    
        // Menyimpan permohonan ke database
        $permohonan->save();
    
        // Menyimpan detail permohonan karang dan mengurangi kuota
        foreach ($request->corals as $coralData) {
            // Simpan detail permohonan karang
            $permohonan->detailPermohonan()->create([
                'coral_id' => $coralData['coral_id'],
                'jumlah' => $coralData['jumlah'],
            ]);
    
            // Kurangi kuota di tabel DetailKuota
            $detailKuota = DetailKuota::where('perusahaan_id', $permohonan->perusahaan_id)
                                      ->where('coral_id', $coralData['coral_id'])
                                      ->first();
    
            if ($detailKuota) {
                // Pastikan kuota cukup sebelum mengurangi
                if ($detailKuota->jumlah_kuota >= $coralData['jumlah']) {
                    $detailKuota->jumlah_kuota -= $coralData['jumlah'];
                    $detailKuota->save();
                } else {
                    return response()->json(['error' => 'Kuota tidak mencukupi'], 400);
                }
            } else {
                return response()->json(['error' => 'Detail kuota tidak ditemukan'], 404);
            }
        }
    
        // Mengirimkan respons sukses
        return response()->json([
            'success' => 'Permohonan berhasil diajukan!',
        ]);
    }
    

}
