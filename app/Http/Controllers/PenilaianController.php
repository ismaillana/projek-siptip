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

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $userRole = auth()->user();
        
        // dd($userRole->hasRole('karyawan-senior'));

        // if ($userRole->hasRole('karyawan-senior')) {
        //     $jurnal = Jurnal::join('penugasans', 'jurnals.penugasan_id', '=', 'penugasans.id')
        //             ->join('kaderisasis', 'penugasans.kaderisasi_id', '=', 'kaderisasis.id')
        //             ->join('karyawans', 'kaderisasis.id_karyawan_senior', '=', 'karyawans.id')
        //             ->join('users', 'karyawans.user_id', '=', 'users.id')
        //             ->where('users.id', $userId)
        //             ->select('jurnals.id', 'jurnals.file_jurnal', 'jurnals.file_revisi', 'jurnals.status_jurnal', 'penugasans.tugas')
        //             ->get(); 
        // } elseif ($userRole->hasRole('karyawan-junior')) {
        //     $jurnal = Jurnal::join('penugasans', 'jurnals.penugasan_id', '=', 'penugasans.id')
        //         ->join('kaderisasis', 'penugasans.kaderisasi_id', '=', 'kaderisasis.id')
        //         ->join('karyawans', 'kaderisasis.id_karyawan_junior', '=', 'karyawans.id')
        //         ->join('users', 'karyawans.user_id', '=', 'users.id')
        //         ->where('users.id', $userId)
        //         ->select('jurnals.id', 'jurnals.file_jurnal', 'jurnals.status_jurnal', 'penugasans.tugas')
        //         ->get(); 
        // }
        $kaderisasi = Kaderisasi()->get();
        // $jurnal = Jurnal::get();             

        return view('admin.penilaian.index', [
            'jurnal' => $jurnal,
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
        //
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
