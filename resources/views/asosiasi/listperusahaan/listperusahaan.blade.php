@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Kuota</h1>

    <!-- Tabel Kuota -->
    <table id="table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Coral</th>
                <th>Jumlah Kuota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotaDetails as $index => $quotaDetail)
        <tr id="row-{{ $quotaDetail->id }}">
            <td>{{ $index + 1 }}</td>
            <td>{{ optional($quotaDetail->coral)->nama ?? 'Nama Coral Tidak Tersedia' }} </td>
            <td class="text-right">{{ number_format($quotaDetail->jumlah_kuota, 0, ',', '.') }}</td>
        </tr>
            @endforeach
        </tbody>

    </table>

@endsection
