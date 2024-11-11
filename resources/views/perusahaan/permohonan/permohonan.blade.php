@extends('layouts.app')

@section('content')
    <h1>Daftar Permohonan Ekspor</h1>

    @if(session('success'))
        <div style="color: green; font-weight: bold;">{{ session('success') }}</div>
    @endif

    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-12" style="padding:20px;">
                <table id="table" class="table table-striped table-bordered" style="width:100%; padding-bottom:45px;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Perusahaan</th>
                            <th>Nomor Permohonan BA Ekspor</th>
                            <th>Tanggal Permohonan BA Ekspor</th>
                            <th>Negara Tujuan</th>
                            <th>File Permohonan BA Ekspor</th>
                            <th>Jumlah Coral</th>
                            <th>Status</th>
                            <th>Status Permohonan</th>
                            <th>Detail Permohonan</th>
                        </tr>
                    </thead>
                    <tbody>
                                    @foreach($permohonanEkspor as $index => $permohonan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $permohonan->perusahaan ? $permohonan->perusahaan->nama : 'Tidak ada perusahaan' }}</td>
                        <td>{{ $permohonan->nomor_permohonan }}</td>
                        <td>{{ $permohonan->tanggal_permohonan }}</td>
                        <td>{{ $permohonan->negara_tujuan }}</td>
                        <td>
                            @if($permohonan->file_permohonan)
                                <a href="{{ asset('storage/'.$permohonan->file_permohonan) }}" target="_blank">Lihat File</a>
                            @else
                                Tidak ada file
                            @endif
                        </td>
                        <td>
                            @foreach($permohonan->detailPermohonan as $detail)
                                {{ $detail->jumlah }} Karang ({{ $detail->coral->nama }})
                            @endforeach
                        </td>
                        <td>
                            @switch($permohonan->status)
                                @case('menunggu')
                                    <span class="badge bg-warning">Menunggu</span>
                                    @break
                                @case('disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                    @break
                                @case('ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                    @break
                            @endswitch
                        </td>
                    </tr>
                @endforeach
                
                    </tbody>
                </table>
            </div>
        </div>
    </div>
                                <td>
                                    <!-- Tombol untuk membuka Modal -->
                                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Ajukan Permohonan</button>
                                </td>
<!-- Modal untuk Ajukan Permohonan -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Ajukan Permohonan Ekspor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="permohonanForm" method="POST" enctype="multipart/form-data">
          @csrf
          
          <!-- Nomor Permohonan -->
          <div class="form-group">
            <label for="nomor_permohonan">Nomor Permohonan</label>
            <input type="text" name="nomor_permohonan" id="nomor_permohonan" class="form-control" required>
          </div>

          <!-- Tanggal Permohonan -->
          <div class="form-group">
            <label for="tanggal_permohonan">Tanggal Permohonan</label>
            <input type="date" name="tanggal_permohonan" id="tanggal_permohonan" class="form-control" required>
          </div>

          <!-- Negara Tujuan -->
          <div class="form-group">
            <label for="negara_tujuan">Negara Tujuan</label>
            <input type="text" name="negara_tujuan" id="negara_tujuan" class="form-control" required>
          </div>

          <!-- File Permohonan -->
          <div class="form-group">
            <label for="file_permohonan">File Permohonan</label>
            <input type="file" name="file_permohonan" id="file_permohonan" class="form-control">
          </div>

          <!-- Jenis Karang dan Jumlah -->
          <div class="form-group" id="corals-container">
            <label for="corals">Pilih Jenis Karang dan Jumlah</label>
            <div class="coral-entry">
              <select name="corals[0][coral_id]" class="form-control" required>
                @foreach ($corals as $coral)
                  <option value="{{ $coral->id }}">{{ $coral->nama }}</option>
                @endforeach
              </select>
              <input type="number" name="corals[0][jumlah]" class="form-control" placeholder="Jumlah" required>
            </div>
          </div>
          
          <button type="button" id="add-coral" class="btn btn-secondary">Tambah Karang</button>

          <button type="submit" class="btn btn-primary mt-3">Ajukan Permohonan</button>
        </form>
      </div>
    </div>
  </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            var coralIndex = 1;

            // Menambahkan baris input untuk jenis karang
            $('#add-coral').click(function(){
                $('#corals-container').append(`
                    <div class="coral-entry">
                        <select name="corals[${coralIndex}][coral_id]" class="form-control" required>
                            @foreach ($corals as $coral)
                                <option value="{{ $coral->id }}">{{ $coral->nama }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="corals[${coralIndex}][jumlah]" class="form-control" placeholder="Jumlah" required>
                        <button type="button" class="btn btn-danger remove-coral">Hapus</button>
                    </div>
                `);
                coralIndex++;
            });

            // Menghapus input karang
            $(document).on('click', '.remove-coral', function(){
                $(this).closest('.coral-entry').remove();
            });
        });
    </script>
@endsection
