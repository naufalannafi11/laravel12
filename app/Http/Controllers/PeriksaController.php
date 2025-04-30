<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\User;

class PeriksaController extends Controller
{
    public function index()
    {
        $periksas = Periksa::with(['pasien', 'dokter'])->get();
        return view('dokter.periksa.index', compact('periksas'));
    }

    public function create()
    {
        $pasiens = User::where('role', 'pasien')->get();
        return view('dokter.periksa.create', compact('pasiens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:users,id',
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'biaya_periksa' => 'nullable|integer',
        ]);

        Periksa::create([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => auth()->id(),
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
        ]);

        return redirect()->route('dokter.periksa.index')->with('success', 'Periksa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $periksa = Periksa::findOrFail($id);
        $pasiens = User::where('role', 'pasien')->get();
        return view('dokter.periksa.edit', compact('periksa', 'pasiens'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pasien' => 'required|exists:users,id',
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'biaya_periksa' => 'nullable|integer',
        ]);

        $periksa = Periksa::findOrFail($id);
        $periksa->update([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => auth()->id(),
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
        ]);

        return redirect()->route('dokter.periksa.edit', $id)->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Periksa::destroy($id);
        return redirect()->route('dokter.periksa.index')->with('success', 'Data berhasil dihapus.');
    }
}
