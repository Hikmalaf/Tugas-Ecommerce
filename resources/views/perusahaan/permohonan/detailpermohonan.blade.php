@extends('layouts.app')

@section('content')
    <h1>Detail Permohonan Ekspor</h1>

    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-12" style="padding:20px;">
                <table id="detailTable" class="table table-striped table-bordered" style="width:100%; padding-bottom:45px;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Perusahaan</th>
                            <th>Nomor Permohonan BA Ekspor</th>
                            <th>Tanggal Permohonan BA Ekspor</th>
                            <th>Negara Tujuan</th>
                            <th>File Permohonan BA Ekspor</th>
                            <th>Nama Coral</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $permohonan->perusahaan->nama }}</td>
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
                            <td colspan="2">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nama Coral</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permohonan->detailPermohonan as $detail)
                                            <tr>
                                                <td>{{ $detail->coral->nama }}</td>
                                                <td>{{ $detail->jumlah }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
@endsection
