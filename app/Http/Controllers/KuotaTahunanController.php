<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\DetailKuota;
use App\Models\Corals;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class KuotaTahunanController extends Controller
{

    // Menambahkan filter perusahaan saat index kuota
    public function index(Request $request)
    {
        // Ambil daftar perusahaan jika pengguna adalah Super Admin
        $perusahaanOptions = null;
        if (auth()->user()->role == 'super_admin') {
            $perusahaanOptions = Perusahaan::all();  // Ambil semua perusahaan
        }
    
        // Filter kuota berdasarkan perusahaan_id jika ada
        $quotaDetailsQuery = DetailKuota::query();
        if ($request->has('perusahaan_id')) {
            $quotaDetailsQuery->where('perusahaan_id', $request->input('perusahaan_id'));
        }
        $quotaDetails = $quotaDetailsQuery->get();
    
        return view('asosiasi.kuota.index', compact('quotaDetails', 'perusahaanOptions'));
    }
    


    public function infoPerusahaan()
    {
        $perusahaanId = Perusahaan::with('perusahaan_id')->get();
    
        return view('perusahaan.kuota.detailperusahaan', compact('perusahaanId'));
    }
    
    
    public function store(Request $request)
    {
        $user = auth()->user();  // Mengambil pengguna yang sedang login
        $perusahaanId = $user->perusahaan_id;  // Mengakses perusahaan_id pengguna yang login
    
        // Validasi input dari request
        $validatedData = $request->validate([
            'coral_id' => 'required|exists:corals,id',
            'quota_amount' => 'required|numeric',
        ]);
    
        // Menambahkan perusahaan_id ke data yang akan disimpan
        $validatedData['perusahaan_id'] = $perusahaanId;
    
        // Cek apakah sudah ada data kuota untuk perusahaan dan coral
        $quotaDetail = DetailKuota::where('coral_id', $validatedData['coral_id'])
                                  ->where('perusahaan_id', $validatedData['perusahaan_id'])
                                  ->first();
    
        if ($quotaDetail) {
            // Jika data sudah ada, update jumlah kuota
            $quotaDetail->jumlah_kuota += $validatedData['quota_amount'];
        } else {
            // Jika data belum ada, buat data baru
            $quotaDetail = new DetailKuota();
            $quotaDetail->coral_id = $validatedData['coral_id'];
            $quotaDetail->perusahaan_id = $validatedData['perusahaan_id'];
            $quotaDetail->jumlah_kuota = $validatedData['quota_amount'];
        }
    
        // Simpan data kuota
        $quotaDetail->save();
    
        // Ambil data coral terkait dengan id yang telah disimpan
        $coral = $quotaDetail->coral; // Ambil coral terkait
    
        // Mengembalikan response dengan nama coral
        return response()->json([
            'success' => true,
            'id' => $quotaDetail->id,
            'coral' => [
                'id' => $coral->id,
                'nama' => $coral->nama // Pastikan untuk menyertakan nama coral
            ],
            'jumlah_kuota' => $quotaDetail->jumlah_kuota
        ]);
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
    
        // Mengambil nama coral
        $coral = $quotaDetail->coral;
    
        // Return data untuk form edit, termasuk nama coral
        return response()->json([
            'coral_id' => $quotaDetail->coral_id,
            'jumlah_kuota' => $quotaDetail->jumlah_kuota,
            'coral_name' => $coral ? $coral->nama : 'Nama Coral Tidak Tersedia',  // Nama coral
        ]);
    }
    
    
    public function update(Request $request, $id)
{
    $request->validate([
        'coral_id' => 'required|exists:corals,id',
        'quota_amount' => 'required|numeric',
    ]);

    $quotaDetail = DetailKuota::findOrFail($id);
    $quotaDetail->coral_id = $request->input('coral_id');
    $quotaDetail->jumlah_kuota = $request->input('quota_amount');
    
    // Menyimpan perubahan
    $quotaDetail->save();

    // Mengembalikan respons dengan data terbaru
    return redirect()->route('asosiasi.kuota.index')->with('success', 'Kuota berhasil diperbarui!');
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


