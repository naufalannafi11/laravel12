@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <nav>
        <ol class="breadcrumb mt-2">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Periksa</li>
        </ol>
    </nav>

    <h2>Periksa</h2>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Form Periksa</div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('periksa.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="dokter">Dokter</label>
                    <select id="dokter" name="dokter" class="form-select @error('dokter') is-invalid @enderror">
                        <option selected disabled>Pilih Dokter</option>
                        @foreach($dokters as $dokter)
                            <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                        @endforeach
                    </select>
                    @error('dokter')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
               

                <button type="submit" class="btn btn-primary">💾 Simpan</button>
            </form>
        </div>
    </div>

    @if($riwayats->count() > 0)
<div class="card mt-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        Riwayat Periksa
        <input type="text" class="form-control w-25" placeholder="Search" disabled>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Dokter</th>
                    <th>Tanggal</th>
                    <th>Biaya Periksa</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayats as $riwayat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $riwayat->dokter->name ?? 'Tidak Diketahui' }}</td>
                        <td>
    @if($riwayat->tgl_periksa)
        {{ \Carbon\Carbon::parse($riwayat->tgl_periksa)->format('d M Y H:i') }}
    @else
        -
    @endif
</td>
<td>
    @if($riwayat->biaya_periksa)
        Rp{{ number_format($riwayat->biaya_periksa, 0, ',', '.') }}
    @else
        -
    @endif
</td>
<td>{{ $riwayat->catatan ?? '-' }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
</div>
@endsection
