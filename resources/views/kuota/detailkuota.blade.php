@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Kuota</h1>

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
    <tr>   
        <td>{{ $index + 1 }}</td>
        <td>{{ $quotaDetail->coral->nama }} ({{ $quotaDetail->coral->id }})</td>  <!-- Nama coral dan ID -->
        <td class="text-right">{{ number_format($quotaDetail->jumlah_kuota, 0, ',', '.') }}</td>  <!-- Jumlah kuota -->
        <td>
            <button class="btn btn-info" onclick="actionEdit('{{ $quotaDetail->id }}')">Edit</button>
            <button class="btn btn-danger" onclick="actionHapus('{{ $quotaDetail->id }}')">Hapus</button>
        </td>
    </tr>
@endforeach
        </tbody>
    </table>
</div>

<!-- Modal untuk Tambah/Edit Data -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    
                </button>
            </div>
            <form id="form" action="{{ route('kuota.tahunan.create_detail_kuota_tahunan') }}" method="POST">
                @csrf
                <div class="modal-body">
                <div class="form-group">
    <label for="coral_id">Coral</label>
    <select id="coral_id" name="coral_id[]" class="form-control" multiple>
        @foreach($corals as $coral)
            <option value="{{ $coral->id }}">{{ $coral->nama }}</option>
        @endforeach
    </select>
</div>

                    <div class="form-group">
                        <label for="quota_amount">Jumlah Kuota</label>
                        <input type="number" id="quota_amount" name="quota_amount[]" class="form-control" required>
                    </div>

                    <input type="hidden" id="id_edit" name="id_edit">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Inisialisasi DataTable
    $(document).ready(function() {
        $('#table').DataTable({
            responsive: true,
            processing: true,
            scrollY: '50vh',
            scrollX: true,
            scrollCollapse: true,
            pageLength: 25
        });
    });

// Fungsi untuk mengedit data
function actionEdit(idTeam){
    $.ajax({
        type: 'GET',
        url: "/kuota-tahunan/edit/" + idTeam, // Menyesuaikan URL dengan route yang benar
        dataType: 'json',
        success: function(arrayResponse) {
            $('#modal_form .modal-title').html('Edit Data');
            $('#form').attr('action', "/kuota-tahunan/update/" + arrayResponse.data.id); // Pastikan URL untuk update benar
            $('#form').get(0).reset();
            $("#coral_id").select2(); // Inisialisasi Select2

            // Set value untuk form edit
            $("#coral_id").val(arrayResponse.data.coral_id).trigger('change'); // Trigger Select2 setelah set nilai
            $("#quota_amount").val(arrayResponse.data.jumlah_kuota); // Set jumlah kuota
            $("#id_edit").val(arrayResponse.data.id); // Set ID untuk form hidden
            $('#modal_form').modal(); // Tampilkan modal
        }
    });
}



    // Fungsi untuk menghapus data
    function actionHapus(idTeam) {
    swalConfirm({
        title: "Hapus data?",
        text: "Data yang dihapus tidak bisa dikembalikan",
        confirmButtonText: "Ya, Hapus!"
    }, function() {
        const request = $.ajax({
            type: 'GET',
            url: "" + idTeam
        });
        request.done((arrayResponse) => {
            Swal.fire("Berhasil!", arrayResponse.message, "success")
            .then(() => {
                window.location.reload();
            });
        });
        request.fail(error => {
            const { meta } = error.responseJSON || {};
            Swal.fire("Error!", meta.message, "error");
        });
    });
}
</script>
@endsection
