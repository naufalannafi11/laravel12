@extends('layouts.app')

@section('content_body')
<div class="p-6 bg-white rounded shadow">
    <h3 class="mb-4">Daftar Pemeriksaan</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Pasien</th>
                    <th scope="col">Tanggal Periksa</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <a href="{{ route('dokter.periksa.create') }}" class="btn btn-success mb-3">➕ Tambah Pemeriksaan</a>

            <tbody>
                @forelse ($periksas as $periksa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $periksa->pasien->name }}</td>
                    <td>{{ $periksa->tgl_periksa }}</td>
                    <td>
                        <a href="{{ route('dokter.periksa.edit', $periksa->id) }}" class="btn btn-primary btn-sm">✏️ Edit</a>
                        <form action="{{ route('dokter.periksa.destroy', $periksa->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Belum ada data pemeriksaan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
