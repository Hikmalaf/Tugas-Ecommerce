@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Kuota Tahunan</h1>

@if($user->role == 'Super Admin' || $user->role == 'Asosiasi')
    <!-- Dropdown untuk memilih perusahaan hanya untuk Super Admin atau Asosiasi -->
    @if($perusahaanOptions->isEmpty())
        <p>Tidak ada perusahaan yang tersedia</p>
    @else
    <form method="GET" action="{{ route('asosiasi.kuota.index') }}">
        <div class="form-group mb-3">
            <label for="perusahaan_id">Pilih Perusahaan</label>
            <select name="perusahaan_id" id="perusahaan_id" class="form-control" onchange="this.form.submit(); updatePerusahaanId(this.value);">
                <option value="">-- Pilih Perusahaan --</option>
                @foreach($perusahaanOptions as $perusahaan)
                    <option value="{{ $perusahaan->id }}" 
                        {{ request('perusahaan_id') == $perusahaan->id ? 'selected' : '' }}>
                        {{ $perusahaan->nama_perusahaan }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
    @endif
@endif

    <!-- Tombol Tambah Kuota -->
    <button class="btn btn-primary mb-3 float-end" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Kuota</button>

    <!-- Tabel Kuota -->
    <table id="table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Coral</th>
                <th>Jumlah Kuota</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotaDetails as $index => $quotaDetail)
            <tr id="row-{{ $quotaDetail->id }}">
                <td>{{ $index + 1 }}</td>
                <td>{{ optional($quotaDetail->coral)->nama ?? 'Nama Coral Tidak Tersedia' }}</td>
                <td class="text-right">{{ number_format($quotaDetail->jumlah_kuota, 0, ',', '.') }}</td>
                <td>
                    <button class="btn btn-info" onclick="actionEdit('{{ $quotaDetail->id }}')">Edit</button>
                    <button class="btn btn-danger" onclick="actionHapus('{{ $quotaDetail->id }}')">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

<!-- Modal Tambah Kuota -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Kuota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="POST" action="{{ route('asosiasi.kuota.store') }}">
                    @csrf
                    <!-- Input tersembunyi untuk menyimpan perusahaan_id yang dipilih -->
                    <input type="hidden" name="perusahaan_id" id="selected_perusahaan_id">

                    <div class="form-group">
                        <label for="coral_id">Nama Coral</label>
                        <select name="coral_id" id="coral_id" class="form-control" required>
                            @foreach ($corals as $coral)
                                <option value="{{ $coral->id }}">{{ $coral->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quota_amount">Jumlah Kuota</label>
                        <input type="number" name="quota_amount" id="quota_amount" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Kuota -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Kuota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT') <!-- Metode PUT karena akan melakukan update -->
                    <div class="form-group">
                        <label for="edit_coral_id">Nama Coral</label>
                        <select name="coral_id" id="edit_coral_id" class="form-control" required>
                            @foreach ($corals as $coral)
                                <option value="{{ $coral->id }}">{{ $coral->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_quota_amount">Jumlah Kuota</label>
                        <input type="number" name="quota_amount" id="edit_quota_amount" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
// Tambahkan data menggunakan AJAX
// Fungsi untuk menambahkan kuota menggunakan AJAX
// Tambahkan data menggunakan AJAX
$('#addForm').on('submit', function(event) {
    event.preventDefault(); // Mencegah form submit secara default

    var formData = new FormData(this); // Mengambil data form

    $.ajax({
        url: "{{ route('asosiasi.kuota.store') }}", // URL untuk request AJAX
        type: 'POST', // Menggunakan metode POST untuk mengirim data
        data: formData, // Data form yang akan dikirim
        processData: false, // Jangan memproses data secara otomatis (karena FormData)
        contentType: false, // Jangan mengatur content-type secara otomatis (biarkan browser yang mengatur)
        success: function(response) { // Fungsi callback saat request berhasil
            if (response.success) {
                // Cek apakah coral_id sudah ada di tabel
                var existingRow = $(`#row-${response.id}`);
                
                // Jika sudah ada, hanya update jumlah kuota pada baris yang ada
                if (existingRow.length > 0) {
                    var currentQuota = existingRow.find('td:nth-child(3)').text().replace(/\./g, ''); // Ambil jumlah kuota yang ada dan hilangkan titik
                    currentQuota = parseInt(currentQuota, 10);
                    var newQuota = response.jumlah_kuota; // Tambahkan jumlah kuota baru

                    // Update jumlah kuota di kolom "Jumlah Kuota"
                    existingRow.find('td:nth-child(3)').text(new Intl.NumberFormat().format(newQuota));
                } else {
                    // Jika tidak ada, buat baris baru
                    var rowCount = $('#table tbody tr').length + 1;  // Menambahkan 1 untuk nomor urut berikutnya
                    var newRow = `<tr id="row-${response.id}">
                        <td>${rowCount}</td> <!-- Nomor urut berdasarkan jumlah baris yang ada -->
                        <td>${response.coral.nama}</td> <!-- Nama Coral menggunakan response.coral.nama -->
                        <td class="text-right">${new Intl.NumberFormat().format(response.jumlah_kuota)}</td> <!-- Jumlah Kuota menggunakan response.jumlah_kuota -->
                        <td>
                            <button class="btn btn-info" onclick="actionEdit('${response.id}')">Edit</button>
                            <button class="btn btn-danger" onclick="actionHapus('${response.id}')">Hapus</button>
                        </td>
                    </tr>`;
                    // Menambahkan baris baru ke dalam tabel
                    $('#table tbody').append(newRow);
                }

                $('#addModal').modal('hide'); // Menutup modal setelah berhasil
                $('#addForm')[0].reset(); // Reset form setelah data disubmit
            } else {
                alert('Gagal menambahkan data'); // Menampilkan pesan jika gagal
            }
        },
        error: function(xhr, status, error) { // Fungsi callback saat terjadi kesalahan
            alert('Terjadi kesalahan: ' + error); // Menampilkan pesan kesalahan
        }
    });
});




// Fungsi untuk mengedit data
// Fungsi untuk mengedit data
function actionEdit(id) {
    fetch(`/asosiasi/kuota/detailkuota/${id}/edit`)  // Pastikan URL ini sesuai dengan route edit Anda
        .then(response => {
            if (!response.ok) {
                throw new Error('Gagal mengambil data edit');
            }
            return response.json();
        })
        .then(data => {
            console.log(data); // Debug: Pastikan data yang diterima benar

            // Isi nilai di dropdown coral_id dan input jumlah_kuota
            document.getElementById('edit_coral_id').value = data.coral_id;
            document.getElementById('edit_quota_amount').value = data.jumlah_kuota;

            // Tentukan URL action form sesuai id yang diambil
            document.getElementById('editForm').action = `/asosiasi/kuota/detailkuota/${id}`;
            
            // Tampilkan modal edit
            $('#editModal').modal('show');
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
            alert('Gagal memuat data untuk edit. Silakan coba lagi.');
        });
}

// Fungsi untuk mengupdate data menggunakan AJAX
$('#editForm').on('submit', function(event) {
    event.preventDefault(); // Mencegah form submit secara default

    var formData = new FormData(this); // Mengambil data form
    var formAction = $(this).attr('action'); // Mengambil URL form action yang sesuai

    $.ajax({
        url: formAction,  // URL untuk request AJAX
        type: 'POST',     // Menggunakan metode POST
        data: formData,   // Data form yang akan dikirim
        processData: false,  // Jangan memproses data secara otomatis (karena FormData)
        contentType: false,  // Jangan mengatur content-type secara otomatis
        success: function(response) {
            if (response.success) {
                // Menutup modal setelah berhasil
                $('#editModal').modal('hide');

                // Update baris yang sesuai di tabel
                var updatedRow = $(`#row-${response.id}`);

                // Update kolom Nama Coral dan Jumlah Kuota pada baris yang diubah
                updatedRow.find('td:nth-child(2)').text(response.coral.nama);
                updatedRow.find('td:nth-child(3)').text(new Intl.NumberFormat().format(response.jumlah_kuota));

                alert('Data berhasil diperbarui');
            } else {
                alert('Gagal memperbarui data');
            }
        },
        error: function(xhr, status, error) {
            alert('Terjadi kesalahan: ' + error);
        }
    });
});



// Fungsi untuk menghapus data
function actionHapus(id) {
    if (confirm('Anda yakin ingin menghapus data ini?')) {
        fetch(`/asosiasi/kuota/detailkuota/${id}`, { // URL sesuai dengan rute yang benar
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Respons gagal dengan status ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const row = document.querySelector(`#row-${id}`);
                if (row) {
                    row.remove();  // Menghapus baris dari DOM
                }
                alert('Data berhasil dihapus');
            } else {
                alert(data.message || 'Gagal menghapus data');
            }
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
            alert('Terjadi kesalahan saat menghapus data. Coba lagi atau periksa koneksi.');
        });
    }
}


</script>
@endsection
