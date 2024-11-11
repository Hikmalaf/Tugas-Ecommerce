<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna; // Import model Pengguna

class LoginController extends Controller
{
    // Fungsi login
    public function login(Request $request)
    {
        // Validasi input email dan password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Ambil input email dan password
        $credentials = $request->only('email', 'password');

        // Cari user berdasarkan email
        $user = Pengguna::where('email', $credentials['email'])->first();

        // Jika user ditemukan dan password cocok
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Login pengguna
            Auth::login($user);

            // Simpan perusahaan_id di session jika role adalah Perusahaan
            if (in_array($user->role, ['Perusahaan Pimpinan', 'Perusahaan Operator'])) {
                session(['perusahaan_id' => $user->perusahaan_id]);
            }

            // Redirect sesuai role atau ke dashboard
            return redirect()->intended('dashboard');
        }

        // Jika tidak cocok, kembali ke halaman login dengan error
        return redirect()->back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Fungsi logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Fungsi untuk menampilkan dashboard
    public function dashboard()
    {
        $perusahaan = Auth::user()->perusahaan;  // Mengakses perusahaan melalui relasi
        $perusahaanId = session('perusahaan_id'); // Mengakses perusahaan_id dari session

        return view('dashboard', compact('perusahaan', 'perusahaanId'));
    }

    // Fungsi register pengguna baru
    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|min:8|confirmed',
            'nama' => 'required|string|max:255',  // Menambahkan nama agar tersimpan
            'role' => 'required|in:Super Admin,Asosiasi,AKKII - Pimpinan,AKKII - Operator,MA - Dit. KKHSG - Pimpinan,MA - Dit. KKHSG - Operator,MA - KSDA - Pimpinan,MA - KSDA - Operator,SA - SKIKH-BRIN,SA - PRO-BRIN,Perusahaan Pimpinan,Perusahaan Operator'
        ]);

        $user = new Pengguna();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Hash password
        $user->role = $request->role;
        $user->perusahaan_id = $request->input('perusahaan_id', null);  // opsional, bisa null
        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
