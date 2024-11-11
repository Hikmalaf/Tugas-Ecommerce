<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerusahaanSeeder extends Seeder
{
    public function run()
    {
        $perusahaanData = [
            ['kode_perusahaan' => 'BSA', 'nama_perusahaan' => 'BLUE STAR AQUATIC', 'kota' => 'KOTA TANGERANG SELATAN', 'jenis' => 'cv', 'provinsi' => 'BANTEN', 'email' => 'bluestarjkt@gmail.com', 'nomor_telepon' => '(021) 73692738', 'kontak_person' => 'Erik Jaya', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'IP3', 'nama_perusahaan' => 'INTI PUTRA PERTIWI PERSADA', 'kota' => 'KOTA BEKASI', 'jenis' => 'pt', 'provinsi' => 'JAWA BARAT', 'email' => 'persada@corecoral.com', 'nomor_telepon' => '(+6221)85521001', 'kontak_person' => 'Budi', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'ATS', 'nama_perusahaan' => 'ANEKA TIRTASURYA', 'kota' => 'KOTA JAKARTA SELATAN', 'jenis' => 'pt', 'provinsi' => 'DKI JAKARTA', 'email' => 'anekatirtasuryapt@gmail.com', 'nomor_telepon' => '(021)7238616', 'kontak_person' => 'Andreas Wis Bangun', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'NSR', 'nama_perusahaan' => 'NINI SRIREJEKI', 'kota' => 'KOTA DENPASAR', 'jenis' => 'pt', 'provinsi' => 'BALI', 'email' => 'ninitradingcompany@gmail.com', 'nomor_telepon' => '0361 - 9005966', 'kontak_person' => 'Nana', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'BBS', 'nama_perusahaan' => 'BANYU BIRU SENTOSA BALI', 'kota' => 'KABUPATEN KLUNGKUNG', 'jenis' => 'pt', 'provinsi' => 'BALI', 'email' => 'bbsbali@reefmasterindo.com', 'nomor_telepon' => '(+62) 819-1070-7079', 'kontak_person' => 'Zulfikar', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'AQM', 'nama_perusahaan' => 'AQUA MARINDO', 'kota' => 'KOTA JAKARTA SELATAN', 'jenis' => 'cv', 'provinsi' => 'DKI JAKARTA', 'email' => 'rafli@aquamarindo.com', 'nomor_telepon' => '(021)7820208', 'kontak_person' => 'Raflialdi Ardian', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'BC', 'nama_perusahaan' => 'BALI CORAL', 'kota' => 'KABUPATEN BULELENG', 'jenis' => 'cv', 'provinsi' => 'BALI', 'email' => 'cvbalicoral@gmail.com', 'nomor_telepon' => '(+62)8155050538', 'kontak_person' => 'Setyadi', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'CI', 'nama_perusahaan' => 'CORAL INTERNATIONAL', 'kota' => 'KOTA DENPASAR', 'jenis' => 'cv', 'provinsi' => 'BALI', 'email' => 'cvcoralint@yahoo.com', 'nomor_telepon' => '(+62) 81805450979', 'kontak_person' => 'Setyadi', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'PAM', 'nama_perusahaan' => 'PACIFIC ANEKAMINA', 'kota' => 'KOTA JAKARTA BARAT', 'jenis' => 'pt', 'provinsi' => 'DKI JAKARTA', 'email' => 'pampacificanekamina@gmail.com', 'nomor_telepon' => '(021) 55951130', 'kontak_person' => 'Agus', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'DIP', 'nama_perusahaan' => 'DHARMA INTI PERMAI', 'kota' => 'KOTA TANGERANG', 'jenis' => 'pt', 'provinsi' => 'BANTEN', 'email' => 'dharmainti1@gmail.com', 'nomor_telepon' => '(021) 5559240', 'kontak_person' => 'Shifa', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'DMC', 'nama_perusahaan' => 'DIRGA MEGA CIPTA', 'kota' => 'KOTA JAKARTA TIMUR', 'jenis' => 'pt', 'provinsi' => 'DKI JAKARTA', 'email' => 'rioo@aquanest-archipelago.com', 'nomor_telepon' => '(+62) 87789088999', 'kontak_person' => 'Rio', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'DMP', 'nama_perusahaan' => 'DEMONIA PERKASA', 'kota' => 'KABUPATEN GIANYAR', 'jenis' => 'pt', 'provinsi' => 'BALI', 'email' => 'johariah_70@yahoo.co.id', 'nomor_telepon' => '(+62)895-3252-30139', 'kontak_person' => 'Johariah', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'VIVA', 'nama_perusahaan' => 'VIVARIA MARINE', 'kota' => 'KOTA TANGERANG', 'jenis' => 'cv', 'provinsi' => 'BANTEN', 'email' => 'sales1@vivamarine.com', 'nomor_telepon' => '(021) 5507086', 'kontak_person' => 'Shifa', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'TAW', 'nama_perusahaan' => 'TROPIKAL AQUA WORLD', 'kota' => 'KOTA TANGERANG', 'jenis' => 'pt', 'provinsi' => 'BANTEN', 'email' => 'tropicalaquaworld@gmail.com', 'nomor_telepon' => '+621 2226 4653', 'kontak_person' => 'Mikhael', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'ST', 'nama_perusahaan' => 'SARANA TEKNIK', 'kota' => 'KOTA DENPASAR', 'jenis' => 'cv', 'provinsi' => 'BALI', 'email' => 'gmp_st_marine1@yahoo.com', 'nomor_telepon' => '(0361) 296421', 'kontak_person' => 'Marsel', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'SGA', 'nama_perusahaan' => 'SERICO GEMA PRATAMA', 'kota' => 'KOTA JAKARTA SELATAN', 'jenis' => 'pt', 'provinsi' => 'DKI JAKARTA', 'email' => 'pt.sericogemapratama@yahoo.co.id', 'nomor_telepon' => '(021) 73490254', 'kontak_person' => 'Wiwie', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'SEA', 'nama_perusahaan' => 'UD. SEAQUEST', 'kota' => 'KABUPATEN BANYUWANGI', 'jenis' => 'pt', 'provinsi' => 'JAWA TIMUR', 'email' => 'freddyhr@yahoo.com', 'nomor_telepon' => '(0333) 510107', 'kontak_person' => 'Mila', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'PAT', 'nama_perusahaan' => 'PANORAMA ALAM TROPIKA', 'kota' => 'KOTA JAKARTA SELATAN', 'jenis' => 'pt', 'provinsi' => 'DKI JAKARTA', 'email' => 'palt@cbn.net.id', 'nomor_telepon' => '(021) 7289 5538', 'kontak_person' => 'Yanto', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'KKL', 'nama_perusahaan' => 'KRAKATAU KORAL LESTARI', 'kota' => 'KOTA JAKARTA BARAT', 'jenis' => 'pt', 'provinsi' => 'DKI JAKARTA', 'email' => 'krakataucoral@gmail.com', 'nomor_telepon' => '(021) 55951130', 'kontak_person' => 'Agus', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'HSP', 'nama_perusahaan' => 'HIU SAMUDRA PRATAMA', 'kota' => 'KOTA JAKARTA BARAT', 'jenis' => 'pt', 'provinsi' => 'DKI JAKARTA', 'email' => 'hiusamudrapratama@gmail.com', 'nomor_telepon' => '(021) 55951130', 'kontak_person' => 'Agus', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'ITS', 'nama_perusahaan' => 'INTISAMUDRA LESTARI', 'kota' => 'KABUPATEN BADUNG', 'jenis' => 'pt', 'provinsi' => 'BALI', 'email' => 'Intisamudrabali20@gmail.com', 'nomor_telepon' => '(+62) 85238544477', 'kontak_person' => 'Bagiyo', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'GMP', 'nama_perusahaan' => 'GOLDEN MARINDO PERSADA', 'kota' => 'KOTA TANGERANG', 'jenis' => 'pt', 'provinsi' => 'BANTEN', 'email' => 'inquiry@goldenmarindo.co.id', 'nomor_telepon' => '(021) 55931336', 'kontak_person' => 'Nelly', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'FAQ', 'nama_perusahaan' => 'FANTASY AQUARIUM', 'kota' => 'KOTA JAKARTA SELATAN', 'jenis' => 'cv', 'provinsi' => 'DKI JAKARTA', 'email' => 'fantasyaquarium@gmail.com', 'nomor_telepon' => '(021) 7292085-86', 'kontak_person' => 'Harijati', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'DIN', 'nama_perusahaan' => 'Dinar Darum Lestari Bali', 'kota' => 'KABUPATEN BADUNG', 'jenis' => 'pt', 'provinsi' => 'BALI', 'email' => 'dinarbali@gmail.com', 'nomor_telepon' => '(0361) 420711', 'kontak_person' => 'Anung', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'DDL', 'nama_perusahaan' => 'DINAR DARUM LESTARI JKT', 'kota' => 'KABUPATEN TANGERANG', 'jenis' => 'pt', 'provinsi' => 'BANTEN', 'email' => 'dinarjkt@gmail.com', 'nomor_telepon' => '(021) 5558476', 'kontak_person' => 'Bowo', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'AFB', 'nama_perusahaan' => 'Aqua First Bali', 'kota' => 'KOTA DENPASAR', 'jenis' => 'cv', 'provinsi' => 'BALI', 'email' => 'afb195586@gmail.com', 'nomor_telepon' => '081361338023', 'kontak_person' => 'Irwanto', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'BBS', 'nama_perusahaan' => 'BANYU BIRU SENTOSA JKT', 'kota' => 'KABUPATEN TANGERANG', 'jenis' => 'pt', 'provinsi' => 'BANTEN', 'email' => 'banbiru@reefmasterindo.com', 'nomor_telepon' => '(021)22228065', 'kontak_person' => 'Zulfikar', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => ''],
            ['kode_perusahaan' => 'CB', 'nama_perusahaan' => 'CAHAYA BARU', 'kota' => 'KOTA JAKARTA SELATAN', 'jenis' => 'cv', 'provinsi' => 'DKI JAKARTA', 'email' => 'marketing@cvcahayabaru.com', 'nomor_telepon' => '(021)7342001', 'kontak_person' => 'Artha', 'nomor_telepon_seluler' => '', 'gambar' => null, 'alamat' => '']
        ];

        // Insert data into the 'perusahaan' table
        foreach ($perusahaanData as $data) {
            DB::table('perusahaan')->insert($data);
        }
    }
}
