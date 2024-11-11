<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\DetailKuota;
use App\Models\Corals;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class DetailKuotaController extends Controller
{


        // Menambahkan filter perusahaan saat index kuota
        public function index(Request $request)
        {
            // Dapatkan data pengguna yang sedang login
            $user = Auth::user();
            $corals = Corals::all(); // Daftar coral untuk dropdown tambah/edit
            $perusahaanOptions = null; // Variabel untuk pilihan perusahaan hanya untuk super_admin atau asosiasi
            $perusahaans = Perusahaan::all(); // Tambahkan variabel perusahaan
        
            // Jika pengguna adalah super_admin atau asosiasi, mereka dapat memilih perusahaan dari dropdown
            if ($user->role == 'Super Admin' || $user->role == 'Asosiasi') {
                $perusahaanOptions = Perusahaan::all(); // Pilihan perusahaan untuk dropdown
        
                if ($request->has('perusahaan_id')) {
                    // Filter data berdasarkan perusahaan yang dipilih
                    $quotaDetails = DetailKuota::where('perusahaan_id', $request->input('perusahaan_id'))->with('coral')->get();
                } else {
                    $quotaDetails = collect(); // Tampilkan tabel kosong jika belum ada perusahaan yang dipilih
                }
            } else {
                // Jika bukan super_admin atau asosiasi, ambil data berdasarkan perusahaan_id pengguna
                $quotaDetails = DetailKuota::where('perusahaan_id', $user->perusahaan_id)->with('coral')->get();
            }
        
            // Tampilkan view dengan data yang difilter
            return view('asosiasi.kuota.detailkuota', compact('quotaDetails', 'perusahaanOptions', 'corals', 'user', 'perusahaans'));
        }


    public function infoPerusahaan()
    {
        $perusahaanId = Perusahaan::with('perusahaan_id')->get();
    
        return view('asosiasi.kuota.detailkuota', compact('perusahaanId'));
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
        public function indexPerusahaan(Request $request)
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user(); 

        // Pastikan role diambil dengan benar
        if (!$user) {
            // Jika tidak ada pengguna yang sedang login, redirect ke halaman login atau tampilkan error
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
        }

        // Ambil data coral untuk dropdown
        $corals = Corals::all(); 

        // Variabel untuk pilihan perusahaan
        $perusahaanOptions = null; 
        $quotaDetails = collect(); // Data kuota yang relevan

        if ($user->role == 'Super Admin') {
            // Jika pengguna adalah super_admin, ambil semua perusahaan
            $perusahaanOptions = Perusahaan::all(); 

            // Jika ada perusahaan yang dipilih, filter data berdasarkan perusahaan tersebut
            if ($request->has('perusahaan_id') && $request->input('perusahaan_id') != '') {
                $perusahaanId = $request->input('perusahaan_id');
                // Filter kuota berdasarkan perusahaan_id yang dipilih
                $quotaDetails = DetailKuota::where('perusahaan_id', $perusahaanId)
                    ->with('coral')
                    ->get();
            }
        } else {
            // Jika bukan super_admin, tampilkan data kuota berdasarkan perusahaan pengguna yang sedang login
            $quotaDetails = DetailKuota::where('perusahaan_id', $user->perusahaan_id)
                ->with('coral')
                ->get();
        }

        // Kirim data ke view
        return view('perusahaan.kuota.detailperusahaan', compact('quotaDetails', 'perusahaanOptions', 'corals', 'user'));
    }


    
    
    
    
    
    public function edit($id)
    {
        $quotaDetail = DetailKuota::find($id);
    
        if (!$quotaDetail) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404); // Menyediakan respons JSON yang jelas
        }
    
        // Mengambil nama coral (atau menampilkan pesan default)
        $coral = $quotaDetail->coral ? $quotaDetail->coral->nama : 'Nama Coral Tidak Tersedia';
    
        return response()->json([
            'coral_id' => $quotaDetail->coral_id,
            'jumlah_kuota' => $quotaDetail->jumlah_kuota,
            'coral_name' => $coral,
        ]);
    }
    
    
    
    public function update(Request $request, $id)
    {
        $quotaDetail = DetailKuota::findOrFail($id);
    
        $quotaDetail->coral_id = $request->input('coral_id');
        $quotaDetail->jumlah_kuota = $request->input('quota_amount');
        $quotaDetail->save();
    
        return response()->json([
            'success' => true,
            'id' => $quotaDetail->id,
            'coral' => $quotaDetail->coral,
            'jumlah_kuota' => $quotaDetail->jumlah_kuota
        ]);
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


