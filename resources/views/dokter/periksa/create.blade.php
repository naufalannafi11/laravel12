@extends('layouts.app')

@section('content_body')
<div class="p-6 bg-white rounded shadow">
    <h3 class="mb-4">Tambah Pemeriksaan</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dokter.periksa.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="id_pasien">Pilih Pasien</label>
            <select name="id_pasien" id="id_pasien" class="form-control" required>
                <option value="">-- Pilih Pasien --</option>
                @foreach ($pasiens as $pasien)
                    <option value="{{ $pasien->id }}">{{ $pasien->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="id_dokter" value="{{ auth()->user()->id }}"> <!-- Dokter otomatis -->

        <div class="form-group mt-3">
            <label for="tgl_periksa">Tanggal Periksa</label>
            <input type="datetime-local" name="tgl_periksa" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="catatan">Catatan</label>
            <textarea name="catatan" class="form-control"></textarea>
        </div>

        <div class="form-group mt-3">
            <label for="biaya_periksa">Biaya Periksa</label>
            <input type="number" name="biaya_periksa" class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan</button>
        <a href="{{ route('dokter.periksa.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
