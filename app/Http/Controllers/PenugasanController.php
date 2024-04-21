<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Kaderisasi;
use App\Models\User;
use App\Models\Penugasan;

class PenugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        
        $kaderisasi = Kaderisasi::where('kaderisasis.id_manager', $userId)
        ->with(['karyawanJunior', 'karyawanSenior']) // Eager load relasi
        ->leftJoin('penugasans', 'kaderisasis.id', '=', 'penugasans.kaderisasi_id')
        ->select('kaderisasis.*', 'penugasans.tugas')
        ->get();
        // dd($kaderisasi);

        return view('admin.penugasan.index', [
            'kaderisasi' => $kaderisasi,
            'title'     => 'PTDI|Penugasan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $userId = Auth::id();

        $kaderisasi = Kaderisasi::findOrFail($id);

        $penugasan = Penugasan::where('kaderisasi_id', $id)->first();

        return view('admin.penugasan.tambah', [
            'kaderisasi'    => $kaderisasi,
            'penugasan'     => $penugasan,
            'title'         => 'PTDI|Tambah Kaderisasi'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $userId = Auth::id();
        $request->validate([
            'tugas'             => 'required',
            'tanggal_awal'      => 'required',
            'tanggal_akhir'     => 'required',
            'uraian_penugasan'  => 'required',
        ], [
            'tugas.required'            => 'Pilih Karyawan Senior',
            'tanggal_awal.required'     => 'Pilih Manager',
            'tanggal_akhir.require'     => 'Pilih Manager',
            'uraian_penugasan.required' => 'Uraian Keilmuan Harus Diisi',
        ]);

        $data = [
            'kaderisasi_id'         => $id,
            'tugas'                 => $request->tugas,
            'tanggal_awal'          => $request->tanggal_awal,
            'tanggal_akhir'         => $request->tanggal_akhir,
            'id_manager'            => $userId,
            'uraian_penugasan'      => $request->uraian_penugasan,
        ];
    
        $penugasan = Penugasan::where('kaderisasi_id', $id)->first();
    
        if ($penugasan) {
            $penugasan->update($data);

            return redirect()->route('penugasan.index')->with('success', 'Data Berhasil Diubah');
        } else {
            Penugasan::create($data);

            return redirect()->route('penugasan.index')->with('success', 'Data Berhasil Ditambah');
        }

        
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
        
        $kaderisasi = Kaderisasi::where('id_manager', $userId)
            ->get();
        
        $penugasan = Penugasan::findOrFail($id);

        return view('admin.penugasan.edit', [
            'kaderisasi'    => $kaderisasi,
            'penugasan'     => $penugasan,
            'title'         => 'PTDI|Edit Penugasan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = Auth::id();

        $penugasan = Penugasan::findOrFail($id);

        $request->validate([
            'kaderisasi_id'     => 'required',
            'tugas'             => 'required',
            'tanggal_awal'      => 'required',
            'tanggal_akhir'     => 'required',
            'uraian_penugasan'  => 'required',
        ], [
            'kaderisasi_id.required'    => 'Pilih Karyawan Junior',
            'tugas.required'            => 'Pilih Karyawan Senior',
            'tanggal_awal.required'     => 'Pilih Manager',
            'tanggal_akhir.require'     => 'Pilih Manager',
            'uraian_penugasan.required' => 'Uraian Keilmuan Harus Diisi',
        ]);

        $data = [
            'kaderisasi_id'         => $request->kaderisasi_id,
            'tugas'                 => $request->tugas,
            'tanggal_awal'          => $request->tanggal_awal,
            'tanggal_akhir'         => $request->tanggal_akhir,
            'id_manager'            => $userId,
            'uraian_penugasan'      => $request->uraian_penugasan,
        ];

        $penugasan->update($data);

        return redirect()->route('penugasan.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penugasan = Penugasan::find($id);

        $penugasan->delete();

        return response()->json(['status' => 'Data Telah Dihapus']);
    }
}
