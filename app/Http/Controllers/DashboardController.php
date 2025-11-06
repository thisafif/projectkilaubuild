<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::all();
        // $testimonials = [
        //     [
        //         'message' => 'Pekerjaan sangat rapi dan hasilnya melebihi ekspektasi. Tim Kilau Build benar-benar profesional.',
        //         'author' => 'Zafira Ryani',
        //         'meta' => 'CEO, Proyek VB-01',
        //     ],
        //     [
        //         'message' => 'Komunikasi lancar dari awal sampai akhir. Saya sangat merekomendasikan jasa mereka untuk renovasi rumah.',
        //         'author' => 'Budi Santoso',
        //         'meta' => 'Pemilik Rumah, Depok',
        //     ],
        //     [
        //         'message' => 'Desainnya modern dan fungsional. Terima kasih Kilau Build!',
        //         'author' => 'Citra Lestari',
        //         'meta' => 'Klien, Jakarta',
        //     ],
        //     [
        //         'message' => 'Proyeknya selesai tepat waktu dan sesuai budget. Highly recommended!',
        //         'author' => 'Ahmad Fauzi',
        //         'meta' => 'Developer, Bogor',
        //     ],
        // ];

        return view('dashboard', compact('testimonis'));
    }
}
