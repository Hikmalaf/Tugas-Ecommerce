@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kuota</h1>
    <form action="{{ route('kuota.detailkuota.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="coral_id">Nama Coral</label>
            <select name="coral_id" id="coral_id" class="form-control" required>
                <option value="">Pilih Coral</option>
                @foreach ($corals as $coral)
                    <option value="{{ $coral->id }}">{{ $coral->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quota_amount">Jumlah Kuota</label>
            <input type="number" name="quota_amount" id="quota_amount" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
