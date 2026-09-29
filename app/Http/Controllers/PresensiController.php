<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $presensi = Presensi::latest()->get();
        return view('presensi.index', compact('presensi'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        return view('presensi.create', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
        ]);

        Presensi::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'jam_masuk' => now()->toTimeString(),
            'status' => $request->status,
        ]);

        return redirect()->route('presensi.index')
                         ->with('success', '✅ Absen berhasil dicatat!');
    }
}