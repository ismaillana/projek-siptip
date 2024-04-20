<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Soal;
use App\Models\User;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $soal = Soal::get();

        return view('admin.soal.index', [
            'soal'      => $soal,
            'title'     => 'PTDI|Soal'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();

        return view('admin.soal.tambah', [
            'title'         => 'PTDI|Tambah Soal'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'soal'          => 'required',
            'to'   => 'required',
        ], [
            'soal.required'         => 'Masukan Pertanyaan',
            'to.required'  => 'Pilih Status Soal',
        ]);

        $soal = Soal::create([
            'soal'         => $request->soal,
            'to'  => $request->to,
        ]);

        return redirect()->route('soal.index')->with('success', 'Data Berhasil Ditambah');
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
        
        $soal = Soal::findOrFail($id);

        return view('admin.soal.edit', [
            'soal'          => $soal,
            'title'         => 'PTDI|Edit Soal'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = Auth::id();

        $soal = Soal::findOrFail($id);

        $request->validate([
            'soal'          => 'required',
            'to'   => 'required',
        ], [
            'soal.required'         => 'Masukan Pertanyaan',
            'to.required'  => 'Pilih Status Soal',
        ]);

        $data = [
            'soal'         => $request->soal,
            'to'  => $request->to,
        ];

        $soal->update($data);

        return redirect()->route('soal.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $soal = Soal::find($id);

        $soal->delete();

        return response()->json(['status' => 'Data Telah Dihapus']);
    }
}
