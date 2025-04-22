<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $obats = Obat::all();
    return view('dokter/obat.index', compact('obats')); // sesuaikan
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dokter/obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
        ]);
        Obat::create($request->all());
        return redirect()->route('obat.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obat $obat)
    {
        return view('dokter/obat.edit', compact('obat'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required'
        ]);
        $obat->update($request->all());
        return redirect()->route('obat.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('obat.index');

    }
}
