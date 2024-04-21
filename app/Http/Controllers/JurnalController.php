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

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $penugasan = Penugasan::leftJoin('jurnals', 'penugasans.id', '=', 'jurnals.penugasan_id')
        ->whereHas('kaderisasi.karyawanJunior.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })
        ->select('penugasans.*', 'jurnals.status_jurnal', 'jurnals.file_jurnal')
        ->get();

        return view('admin.jurnal.index', [
            'penugasan' => $penugasan,
            'title'  => 'PTDI|Jurnal'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $userId = Auth::id();

        $penugasan = Penugasan::find($id);

        $jurnal = Jurnal::where('penugasan_id', $id)->first();

        // Jika penugasan sudah memiliki jurnal, ambil data jurnal tersebut.
        // Jika belum, buat data jurnal baru dengan nilai default.
        if ($jurnal) {
            return view('admin.jurnal.edit', [
                'penugasan'    => $penugasan,
                'jurnal'       => $jurnal,
                'title'        => 'PTDI|Unggah Jurnal'
            ]);
        } else {
            return view('admin.jurnal.tambah', [
                'penugasan'    => $penugasan,
                'title'        => 'PTDI|Unggah Jurnal'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $userId = Auth::id();

        $request->validate([
            'file_jurnal'       => 'required',
        ], [
            'file_jurnal.required'      => 'Masukan File Jurnal',
        ]);

        $file_jurnal = Jurnal::saveDokumen($request);

        $jurnal = Jurnal::create([
            'penugasan_id'         => $id,
            'file_jurnal'          => $file_jurnal,
            'status_jurnal'        => 'Review'
        ]);

        Penugasan::find($id)
            ->update([
            'status'    => 'Review'
        ]);

        return redirect()->route('jurnal.index')->with('success', 'Data Berhasil Ditambah');
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
        
        $jurnal = Jurnal::findOrFail($id);

        return view('admin.jurnal.edit', [
            'penugasan'    => $penugasan,
            'jurnal'       => $jurnal,
            'title'        => 'PTDI|Edit Jurnal'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $penugasan = Penugasan::findOrFail($id);
        $jurnal = Jurnal::where('penugasan_id', $id)->first();
        // dd($jurnal);

        if ($request->hasFile('file_jurnal')) {
            $file_jurnal = Jurnal::saveDokumen($request);

            if ($file_jurnal) {
                $data['file_jurnal'] = $file_jurnal;

                Jurnal::deleteFile($jurnal->id);
            }

            $jurnal->update(['file_jurnal' => $file_jurnal]);

            Penugasan::find($id)->update([
                'status'    => 'Review'
            ]);

            return redirect()->route('jurnal.index')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect()->route('jurnal.index')->with('success', 'Tidak Ada Data Yang Diubah');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function nilaiSenior(string $id)
    {
        $kaderisasi = Kaderisasi::findOrFail($id);
        $soal = Soal::where('to', 'Junior')->get();

        return view('admin.penilaian.tambah', [
            'kaderisasi'   => $kaderisasi,
            'soal'         => $soal,
            'title'        => 'PTDI|Tambah Penilaian Untuk Senior'
        ]);
    }

    public function nilaiSeniorStore(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nilai_angka' => 'required|array', // Nilai harus berupa array
            'nilai_angka.*' => 'required|in:1,2,3,4', // Nilai harus antara 1-4
        ]);

        // Ambil ID karyawan junior
        $userId = Auth::id();
        $kaderisasi = Kaderisasi::findOrFail($id);
        $id_karyawan_junior = $kaderisasi->id_karyawan_junior;

        // Ambil ID karyawan senior dan ID penilai
        $id_karyawan_senior = $kaderisasi->id_karyawan_senior;

        // Array untuk mengonversi nilai angka ke nilai huruf
        $nilai_huruf_map = [
            '1' => 'Kurang Sekali',
            '2' => 'Kurang',
            '3' => 'Baik',
            '4' => 'Baik Sekali',
        ];

        // Looping untuk menyimpan data penilaian
        foreach ($request->nilai_angka as $key => $nilai_angka) {
            Penilaian::create([
                'kaderisasi_id' => $kaderisasi->id,
                'soal' => $request->soal[$key], // Ambil teks soal dari form
                'nilai_angka' => $nilai_angka,
                'nilai_huruf' => $nilai_huruf_map[$nilai_angka], // Konversi nilai angka ke nilai huruf
                'id_penilai' => $id_karyawan_junior,
                'id_dinilai' => $id_karyawan_senior,
            ]);
        }


        return redirect()->route('jurnal.index')->with('success', 'Data penilaian berhasil disimpan.');
    }


    /**
     * Display a listing of the resource.
     */
    public function verifikasiJurnal()
    {
        $userId = Auth::id();

        $penugasan = Penugasan::leftJoin('jurnals', 'penugasans.id', '=', 'jurnals.penugasan_id')
            ->whereNotNull('jurnals.penugasan_id') // Hanya ambil penugasan yang memiliki relasi dengan jurnal
            ->where(function ($query) {
                $query->where('jurnals.status_jurnal', 'Selesai')
                    ->orWhere('jurnals.status_jurnal', 'Revisi Manager')
                    ->orWhere('jurnals.status_jurnal', 'Review Manager');
            })
            ->select('penugasans.*', 'jurnals.status_jurnal', 'jurnals.file_jurnal')
            ->get();

        return view('admin.verifikasi_jurnal.index', [
            'penugasan' => $penugasan,
            'title'  => 'PTDI|Verifikasi Jurnal'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function cekVerifikasi(string $id)
    {
        $userId = Auth::id();

        $penugasan = Penugasan::find($id);

        $evaluasi = Jurnal::where('penugasan_id', $id)->first();

        // Jika penugasan sudah memiliki jurnal, ambil data jurnal tersebut.
        // Jika belum, buat data jurnal baru dengan nilai default.

        return view('admin.verifikasi_jurnal.edit', [
            'penugasan'    => $penugasan,
            'evaluasi'     => $evaluasi,
            'title'        => 'PTDI|Verifikasi Jurnal'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateVerifikasi(Request $request, string $id)
    {
        $evaluasi = Jurnal::where('penugasan_id', $id)->first();

        $rules = [
            'status_jurnal' => 'required',
        ];

        $messages = [
            'status_jurnal.required' => 'Status Harus Dipilih',
        ];

        // Jika status adalah Revisi, tambahkan validasi untuk uraian_revisi dan file_revisi
        if ($request->input('status_jurnal') === 'Revisi Manager') {
            // Cek apakah file_revisi masih kosong
            if (!$evaluasi->file_revisi_manager) {
                // Tambahkan aturan validasi required hanya jika file_revisi masih kosong
                $rules['file_revisi_manager'] = 'required';
                // Ubah pesan validasi untuk file_revisi
                $messages['file_revisi_manager.required'] = 'Mohon unggah file revisi jika status jurnal adalah Revisi.';
            }
        }

        $request->validate($rules, $messages);

        $status = $request->input('status_jurnal');
        $data = ['status_jurnal' => $status];

        // Jika status adalah Revisi, simpan juga uraian_revisi
        if ($status === 'Revisi Manager') {
            $data['uraian_revisi_manager'] = $request->input('uraian_revisi_manager');
        }

        // Jika ada file yang diunggah, simpan file_revisi
        if ($request->hasFile('file_revisi_manager')) {
            $file_revisi_manager = Jurnal::saveDokumenRevisiManager($request);
            if ($file_revisi_manager) {
                $data['file_revisi_manager'] = $file_revisi_manager;
                // Hapus file lama jika ada
                Jurnal::deleteFileRevisiManager($evaluasi->id);
            }
        }

        // Update data jurnal dengan data baru
        Jurnal::where('penugasan_id', $id)->update($data);

        // Update status penugasan
        Penugasan::find($id)->update(['status' => $status]);

        if ($status === 'Selesai') {
            JurnalFinal::create([
                'penugasan_id' => $id,
                'jurnal_id'    => $evaluasi->id,
                'status'       => $status,
            ]);
        }

        return redirect()->route('verifikasi-jurnal.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Display a listing of the resource.
     */
    public function jurnalPublish()
    {
        $userId = Auth::id();

        $jurnal = JurnalFinal::get();

        return view('admin.jurnal.index_jurnal_publish', [
            'jurnal' => $jurnal,
            'title'  => 'PTDI|Jurnal Publish',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Jurnal::deleteFile($id);

        $jurnal = Jurnal::find($id);
        
        $jurnal->delete();

        return response()->json(['status' => 'Data Telah Dihapus']);
    }
}
