@extends('layouts.app')

@section('content')
    <h1>Edit Pemeriksaan</h1>

    <form action="{{ route('dokter.periksa.update', $periksa->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Untuk form update -->

        <div class="form-group">
            <label for="id_pasien">Pilih Pasien</label>
            <select name="id_pasien" id="id_pasien" class="form-control" required>
                @foreach ($pasiens as $pasien)
                    <option value="{{ $pasien->id }}" {{ $pasien->id == $periksa->id_pasien ? 'selected' : '' }}>
                        {{ $pasien->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Form lainnya sesuai data yang ingin diedit -->
        <div class="form-group mt-3">
            <label for="tgl_periksa">Tanggal Periksa</label>
            <input type="datetime-local" name="tgl_periksa" value="{{ $periksa->tgl_periksa }}" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="catatan">Catatan</label>
            <textarea name="catatan" class="form-control">{{ $periksa->catatan }}</textarea>
        </div>

        <div class="form-group mt-3">
            <label for="biaya_periksa">Biaya Periksa</label>
            <input type="number" name="biaya_periksa" value="{{ $periksa->biaya_periksa }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-3">Update</button>
        <a href="{{ route('dokter.periksa.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
@endsection
