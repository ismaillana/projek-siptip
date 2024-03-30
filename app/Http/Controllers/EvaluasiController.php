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

class EvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $evaluasi = Jurnal::join('penugasans', 'jurnals.penugasan_id', '=', 'penugasans.id')
                ->join('kaderisasis', 'penugasans.kaderisasi_id', '=', 'kaderisasis.id')
                ->join('karyawans', 'kaderisasis.id_karyawan_senior', '=', 'karyawans.id')
                ->join('users', 'karyawans.user_id', '=', 'users.id')
                ->where('users.id', $userId)
                ->select('jurnals.id', 'jurnals.file_jurnal', 'jurnals.file_revisi', 'jurnals.status_jurnal', 'penugasans.tugas')
                ->get(); 
        // $jurnal = Jurnal::get();             

        return view('admin.evaluasi.index', [
            'evaluasi' => $evaluasi,
            'title'    => 'PTDI|Evaluasi'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();

        $penugasan = Penugasan::join('kaderisasis', 'penugasans.kaderisasi_id', '=', 'kaderisasis.id')
            ->join('karyawans', 'kaderisasis.id_karyawan_senior', '=', 'karyawans.id')
            ->join('users', 'karyawans.user_id', '=', 'users.id')
            ->where('users.id', $userId)
            ->select('penugasans.id', 'penugasans.tugas')
            ->get();

        // foreach ($penugasan as $item) {
        //     dd($item->id); // Akses properti id dari entri penugasan
        // }

        // dd($penugasan);

        return view('admin.evaluasi.tambah', [
            'penugasan'    => $penugasan,
            'title'         => 'PTDI|Tambah Evaluasi'
        ]);
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
        $penugasan = Penugasan::get();
        
        $evaluasi = Jurnal::findOrFail($id);

        return view('admin.evaluasi.edit', [
            'penugasan'    => $penugasan,
            'evaluasi'     => $evaluasi,
            'title'        => 'PTDI|Edit Evaluasi'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $evaluasi = Jurnal::findOrFail($id);

        $rules = [
            'uraian_revisi' => 'required_if:status_jurnal,Revisi',
            'file_revisi'   => 'required_if:status_jurnal,Revisi',
            'status_jurnal' => 'required',
        ];

        $messages = [
            'uraian_revisi.required_if' => 'Masukkan Uraian Revisi',
            'file_revisi.required_if'   => 'Masukkan File Jurnal',
            'status_jurnal.required'    => 'Status Harus Dipilih',
        ];

        $request->validate($rules, $messages);

        $status = $request->input('status_jurnal');

        $data = [];

        if ($status === 'Revisi') {
            $file_revisi = Jurnal::saveDokumenRevisi($request);

            if ($file_revisi) {
                $data['file_revisi'] = $file_revisi;
                Jurnal::deleteFileRevisi($id);
            }

            $data['status_jurnal'] = 'Revisi';
        }
        elseif ($status === 'Selesai') {
            $data['status_jurnal'] = 'Selesai';
        }

        Jurnal::where('id', $id)->update($data);

        Penugasan::where('id', $evaluasi->penugasan_id)->update(['status' => $status]);

        return redirect()->route('evaluasi.index')->with('success', 'Data Berhasil Diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
