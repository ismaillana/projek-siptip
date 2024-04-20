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

        // $evaluasi = Jurnal::join('penugasans', 'jurnals.penugasan_id', '=', 'penugasans.id')
        //         ->join('kaderisasis', 'penugasans.kaderisasi_id', '=', 'kaderisasis.id')
        //         ->join('karyawans', 'kaderisasis.id_karyawan_senior', '=', 'karyawans.id')
        //         ->join('users', 'karyawans.user_id', '=', 'users.id')
        //         ->where('users.id', $userId)
        //         ->select('jurnals.id', 'jurnals.file_jurnal', 'jurnals.file_revisi', 'jurnals.status_jurnal', 'penugasans.tugas')
        //         ->get(); 
        $penugasan = Penugasan::leftJoin('jurnals', 'penugasans.id', '=', 'jurnals.penugasan_id')
            ->whereHas('kaderisasi.karyawanSenior.user', function ($query) use ($userId) {
                $query->where('id', $userId);
            })
            ->select('penugasans.*', 'jurnals.status_jurnal', 'jurnals.file_jurnal')
            ->get();
        // $jurnal = Jurnal::get();             

        return view('admin.evaluasi.index', [
            'penugasan' => $penugasan,
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
        $userId = Auth::id();

        $penugasan = Penugasan::find($id);

        $evaluasi = Jurnal::where('penugasan_id', $id)->first();

        // Jika penugasan sudah memiliki jurnal, ambil data jurnal tersebut.
        // Jika belum, buat data jurnal baru dengan nilai default.

        return view('admin.evaluasi.edit', [
            'penugasan'    => $penugasan,
            'evaluasi'     => $evaluasi,
            'title'        => 'PTDI|Evaluasi Jurnal'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $evaluasi = Jurnal::where('penugasan_id', $id)->first();

        $rules = [
            'status_jurnal' => 'required',
        ];

        $messages = [
            'status_jurnal.required' => 'Status Harus Dipilih',
        ];

        // Jika status adalah Revisi, tambahkan validasi untuk uraian_revisi dan file_revisi
        // if ($request->input('status_jurnal') === 'Revisi Senior') {
        //     $rules['file_revisi'] = 'required';
        //     // Jika tidak ada file yang diunggah, atur aturan validasi untuk file_revisi menjadi nullable
        //     if (!$request->hasFile('file_revisi')) {
        //         $rules['file_revisi'] = 'nullable';
        //     }
        // }

        // Jika status adalah Revisi, tambahkan validasi untuk uraian_revisi dan file_revisi
        if ($request->input('status_jurnal') === 'Revisi Senior') {
            // Cek apakah file_revisi masih kosong
            if (!$evaluasi->file_revisi) {
                // Tambahkan aturan validasi required hanya jika file_revisi masih kosong
                $rules['file_revisi'] = 'required';
                // Ubah pesan validasi untuk file_revisi
                $messages['file_revisi.required'] = 'Mohon unggah file revisi jika status jurnal adalah Revisi.';
            }
        }

        $request->validate($rules, $messages);

        $status = $request->input('status_jurnal');
        $data = ['status_jurnal' => $status];

        // Jika status adalah Revisi, simpan juga uraian_revisi
        if ($status === 'Revisi Senior') {
            $data['uraian_revisi'] = $request->input('uraian_revisi');
        }

        // Jika ada file yang diunggah, simpan file_revisi
        if ($request->hasFile('file_revisi')) {
            $file_revisi = Jurnal::saveDokumenRevisi($request);
            if ($file_revisi) {
                $data['file_revisi'] = $file_revisi;
                // Hapus file lama jika ada
                Jurnal::deleteFileRevisi($evaluasi->id);
            }
        }

        // Update data jurnal dengan data baru
        Jurnal::where('penugasan_id', $id)->update($data);

        // Update status penugasan
        Penugasan::find($id)->update(['status' => $status]);

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
