@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Kuota Tahunan</h1>

    <!-- Tombol Tambah Kuota -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Kuota</button>

    <!-- Tabel Kuota -->
    <table id="table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Username/th>
                <th>Role</th>
                <th>Instansi</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotaDetails as $index => $quotaDetail)
        <tr id="row-{{ $quotaDetail->id }}">
            <td>{{ $index + 1 }}</td>
            <td>{{ optional($quotaDetail->coral)->nama ?? 'Nama Coral Tidak Tersedia' }} </td>
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
                <form id="addForm" method="POST">
                    @csrf
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
<script>
$('#addForm').on('submit', function(event) {
    event.preventDefault();  // Mencegah form submit secara default

    var formData = new FormData(this); // Ambil data dari form

        $.ajax({
        url: "{{ route('asosiasi.kuota.store') }}", // Menyesuaikan dengan nama route yang benar
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            var newRow = `<tr>
                <td>${response.id}</td>
                <td>${response.coral.nama}</td>
                <td class="text-right">${new Intl.NumberFormat().format(response.jumlah_kuota)}</td>
                <td>
                    <button class="btn btn-info" onclick="actionEdit('${response.id}')">Edit</button>
                    <button class="btn btn-danger" onclick="actionHapus('${response.id}')">Hapus</button>
                </td>
            </tr>`;

            $('#table tbody').append(newRow);
            $('#addModal').modal('hide');
        },
        error: function(xhr, status, error) {
            alert('Terjadi kesalahan: ' + error);
        }
    });

});


    // Fungsi untuk mengedit data
    function actionEdit(id) {
        fetch(`/kuota/detailkuota/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('edit_coral_id').value = data.coral_id;
                document.getElementById('edit_quota_amount').value = data.jumlah_kuota;
                document.getElementById('editForm').action = `/kuota/detailkuota/${id}`;
                $('#editModal').modal('show'); // Menampilkan modal edit
            });
    }
    
// Fungsi untuk menghapus data
// Fungsi untuk menghapus data
function actionHapus(id) {
    if (confirm('Anda yakin ingin menghapus data ini?')) {
        fetch(`/detailkuota/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json()) // Pastikan response adalah JSON
        .then(data => {
            if (data.success) {
                // Menghapus baris yang terkait dengan ID yang dihapus dari tabel
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
            alert('Terjadi kesalahan: ' + error.message);
        });
    }
}

</script>
@endsection
