<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('konsultasi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'no_wa' => 'required|string|max:20',
            'provinsi' => 'required|string|max:100',
            'kabupatenkota' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'jenis_konsultasi' => 'required|string|max:100',
            'detil_konsultasi' => 'required|string|max:1000',
        ]);

        Konsultasi::create($validated);

        return redirect()->back()->with('success', 'Konsultasi berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
