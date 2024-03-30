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

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $jurnal = Jurnal::join('penugasans', 'jurnals.penugasan_id', '=', 'penugasans.id')
                ->join('kaderisasis', 'penugasans.kaderisasi_id', '=', 'kaderisasis.id')
                ->join('karyawans', 'kaderisasis.id_karyawan_junior', '=', 'karyawans.id')
                ->join('users', 'karyawans.user_id', '=', 'users.id')
                ->where('users.id', $userId)
                ->select('jurnals.id', 'jurnals.file_jurnal', 'jurnals.status_jurnal', 'penugasans.tugas')
                ->get(); 
        // $jurnal = Jurnal::get();             

        return view('admin.jurnal.index', [
            'jurnal' => $jurnal,
            'title'  => 'PTDI|Jurnal'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();

        $penugasan = Penugasan::join('kaderisasis', 'penugasans.kaderisasi_id', '=', 'kaderisasis.id')
            ->join('karyawans', 'kaderisasis.id_karyawan_junior', '=', 'karyawans.id')
            ->join('users', 'karyawans.user_id', '=', 'users.id')
            ->where('users.id', $userId)
            ->select('penugasans.id', 'penugasans.tugas')
            ->get();

        // foreach ($penugasan as $item) {
        //     dd($item->id); // Akses properti id dari entri penugasan
        // }

        // dd($penugasan);

        return view('admin.jurnal.tambah', [
            'penugasan'    => $penugasan,
            'title'         => 'PTDI|Tambah Jurnal'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            $userId = Auth::id();
    
            $request->validate([
                'penugasan_id'      => 'required',
                'file_jurnal'       => 'required',
            ], [
                'penugasan_id.required'     => 'Pilih Penugasan',
                'file_jurnal.required'      => 'Masukan File Jurnal',
            ]);
    
            $file_jurnal = Jurnal::saveDokumen($request);

            $jurnal = Jurnal::create([
                'penugasan_id'         => $request->penugasan_id,
                'file_jurnal'          => $file_jurnal,
            ]);
    
            return redirect()->route('jurnal.index')->with('success', 'Data Berhasil Ditambah');
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
        $request->validate([
            'penugasan_id'      => 'required',
        ], [
            'penugasan_id.required'     => 'Pilih Penugasan',
        ]);

        $data = [
            'penugasan_id'         => $request->penugasan_id,
        ];

        $file_jurnal = Jurnal::saveDokumen($request);

        if ($file_jurnal) {
            $data['file_jurnal'] = $file_jurnal;

            Jurnal::deleteFile($id);
        }
        
        Jurnal::where('id', $id)->update($data);

        return redirect()->route('jurnal.index')->with('success', 'Data Berhasil Diubah');
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
