<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\User;

class PemeriksaanController extends Controller
{
    public function index()
    {
        $dokters = User::where('role', 'dokter')->get();
        $riwayats = Periksa::where('id_pasien', auth()->id())->whereNotNull('tgl_periksa')->latest()->get();
        return view('periksa', compact('dokters', 'riwayats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokter' => 'required|exists:users,id',
        ]);

        Periksa::create([
            'id_pasien' => auth()->id(),
            'id_dokter' => $request->dokter,
            'tgl_periksa' => now(),
        ]);

        return redirect()->route('periksa')->with('success', 'Permintaan periksa berhasil dikirim.');
    }
}
