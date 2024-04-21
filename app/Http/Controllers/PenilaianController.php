<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use File;

use App\Models\User;
use App\Models\Penugasan;
use App\Models\Kaderisasi;
use App\Models\Jurnal;
use App\Models\Soal;
use App\Models\Penilaian;
use App\Models\JurnalFinal;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $user = auth()->user();

        if ($user->hasRole('karyawan-junior')){
            $kaderisasi = Kaderisasi::whereHas('karyawanJunior.user', function ($query) use ($userId) {
                $query->where('id', $userId);
            })->get();
        } elseif ($user->hasRole('karyawan-senior')) {
            $kaderisasi = Kaderisasi::whereHas('karyawanSenior.user', function ($query) use ($userId) {
                $query->where('id', $userId);
            })->get();
        } else {
            // Jika peran pengguna tidak valid, lakukan penanganan di sini
            // Misalnya, lemparkan pengecualian atau tampilkan pesan kesalahan
        }

        return view('admin.hasil_penilaian.index', [
            'kaderisasi' => $kaderisasi,
            'title'        => 'PTDI|Hasil penilaian'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userId = Auth::id();
        $kaderisasi = Kaderisasi::find($id);
        $penilaianJunior = Penilaian::where('kaderisasi_id', $id)
            ->where('id_penilai', $kaderisasi->id_karyawan_junior)
            ->get();

        $penilaianSenior = Penilaian::where('kaderisasi_id', $id)
            ->where('id_penilai', $kaderisasi->id_karyawan_senior)
            ->get();

        // $penilaianDariJunior = Penilaian::where($penilaian)
        //     ->where('id_penilai', )
        return view('admin.hasil_penilaian.detail', [
            'penilaianJunior' => $penilaianJunior,
            'penilaianSenior' => $penilaianSenior,
            'kaderisasi' => $kaderisasi,
            'title'     => 'PTDI|Detail Hasil penilaian'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
