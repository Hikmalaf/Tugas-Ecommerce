<div class="content px-4">  
  <div class="clearfix"></div>

  <div class="card shadow-lg rounded-lg">
    <div class="card-header bg-gray-800 text-white p-4">
        <div class="flex flex-wrap justify-between">
            <div class="w-full md:w-1/4">
                <div class="form-group">
                    <p>Perusahaan</p>
                    <select id="filterPerusahaan" name="filterPerusahaan" class="form-control w-full" onchange="table.ajax.reload(null, false); this.blur()">
                        <option value=""> -- PERUSAHAAN -- </option>
                        <option value="11">ANEKA TIRTASURYA</option>
                        <option value="8">AQUA MARINDO</option>
                        <!-- More options here -->
                    </select>
                </div>
            </div>

            <div class="w-full md:w-1/4 text-right">
                <button class="btn btn-light-info px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg" onclick="table.ajax.reload(null, false); this.blur()">
                    <i class="fas fa-sync"></i> Refresh
                </button>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-12" style="padding:20px;">
                <table id="table" class="table w-full table-striped">
                    <thead>
                        <tr>
                            <th width="1%">No.</th>
                            <th>Perusahaan</th>
                            <th>Nomor Rekomendasi Ekspor</th>
                            <th>Tanggal Rekomendasi Ekspor</th>
                            <th>Jenis Ekspor</th>
                            <th>Pelabuhan</th>
                            <th>Negara Tujuan</th>
                            <th>Pelabuhan Import</th>
                            <th>Alamat Lengkap</th>
                            <th>File Rekomendasi Ekspor</th>
                            <th>Jumlah Coral</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>

<script>
    let table;

    $(document).ready(function() {
        $("#filterPerusahaan").select2();
        
        table = $('#table').DataTable({
            responsive: true,
            processing: true,
            scrollY: '100vh',
            scrollX: true,
            scrollCollapse: true,
            serverSide: true,
            pageLength: 25,
            ajax: {
                url: "https://akki-alam.artristik.co.id/webapi/rekomendasi_ekspor/dt",
                type: "POST",
                data: function(d) {
                    d._token = '1HW4gu1WuxCKazTV37Nf3XI9tjJl34WfYwBBaKCg';
                    d.filterPerusahaan = $("#filterPerusahaan").val();
                }
            },
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nama_perusahaan', name: 'companies.name'},
                {data: 'nomor_rekomendasi_ekspor', name: 'nomor_rekomendasi_ekspor'},
                {
                    data: 'tanggal_rekomendasi_ekspor',
                    name: 'tanggal_rekomendasi_ekspor',
                    render: function(data, type, row) {
                        return data == '0000-00-00' ? '1900-01-01' : moment(data).format("DD-MM-YYYY");
                    }
                },
                {data: 'jenis_ekspor', name: 'jenis_ekspor'},
                {data: 'pelabuhan', name: 'pelabuhan'},
                {data: 'negara_tujuan', name: 'negara_tujuan'},
                {data: 'pelabuhan_import', name: 'pelabuhan_import'},
                {data: 'alamat_lengkap', name: 'alamat_lengkap'},
                {
                    data: 'file_rekomendasi_ekspor',
                    name: 'file_rekomendasi_ekspor',
                    render: function(data) {
                        return data ? `<a class="btn btn-warning" href="https://akki-alam.artristik.co.id/${data}" target="_blank"><i class="fas fa-image"></i> Preview</a>` : '';
                    }
                },
                {
                    data: 'jumlah_koral',
                    name: 'detail_stok.jumlah_koral',
                    className: "text-right",
                    render: $.fn.dataTable.render.number('.', ',', 0, '')
                },
                {data: '_action', orderable: false, searchable: false},
            ]
        });
    });

    const actionDelete = (id) => {
        swalConfirm({
            title: "Hapus data?",
            text: "Data yang dihapus tidak bisa dikembalikan",
            confirmButtonText: "Ya, Hapus!"
        }, function() {
            const request = $.ajax({
                type: 'delete',
                url: `https://akki-alam.artristik.co.id/webapi/rekomendasi_ekspor/${id}`
            });

            request.done(({meta}) => {
                Swal.fire("Berhasil!", meta.message, "success");
                table.ajax.reload();
            });

            request.fail(error => {
                const {meta} = error.responseJSON || {};
                Swal.fire("Error!", meta.message, "error");
            });
        });
    };

    function updateStatus(idTeam) {
        swalConfirm({
            title: "Update Status?",
            text: "Data yang sudah final tidak bisa dikembalikan",
            confirmButtonText: "Ya, update!"
        }, function() {
            const request = $.ajax({
                type: 'POST',
                url: "https://akki-alam.artristik.co.id/webapi/rekomendasi_ekspor/update_rekomendasi_ekspor",
                data: {
                    id_edit: idTeam,
                    _token: '1HW4gu1WuxCKazTV37Nf3XI9tjJl34WfYwBBaKCg'
                }
            });
            request.done((arrayResponse) => {
                Swal.fire("Berhasil!", arrayResponse.message, "success");
                window.location.reload();
            });

            request.fail(error => {
                const {meta} = error.responseJSON || {};
                Swal.fire("Error!", meta.message, "error");
            });
        });
    }
</script>
