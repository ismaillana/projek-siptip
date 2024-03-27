<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Karyawan;
use App\Models\User;
use App\Models\Kaderisasi;

class KaderisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $kaderisasi = DB::table('kaderisasis')
                    ->join('users', 'kaderisasis.id_manager', '=', 'users.id')
                    ->join('karyawans as junior', 'kaderisasis.id_karyawan_junior', '=', 'junior.id')
                    ->join('karyawans as senior', 'kaderisasis.id_karyawan_senior', '=', 'senior.id')
                    ->select('kaderisasis.*', 'users.name as manager_name', 'junior.nama_lengkap as junior_name', 'senior.nama_lengkap as senior_name')
                    ->get();

        return view('admin.kaderisasi.index', [
            'kaderisasi' => $kaderisasi,
            'title'      => 'Kaderisasi'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $managers = User::whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        })->get();

        $karyawanJunior = Karyawan::where('status', 'Junior')
        ->get();

        $karyawanSenior = Karyawan::where('status', 'Senior')
        ->get();

        return view('admin.kaderisasi.tambah', [
            'managers'            => $managers,
            'karyawanJunior'      => $karyawanJunior,
            'karyawanSenior'      => $karyawanSenior,
            'title'               => 'Tambah Karyawan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'id_karyawan_junior' => 'required',
            'id_karyawan_senior' => 'required',
            'id_manager'         => 'required',
            'uraian_keilmuan'    => 'required',
        ], [
            'id_karyawan_junior.required' => 'Pilih Karyawan Junior',
            'id_karyawan_senior.required' => 'Pilih Karyawan Senior',
            'id_manager.required'         => 'Pilih Manager',
            'uraian_keilmuan.required'    => 'Uraian Keilmuan Harus Diisi',
        ]);

        $kaderisasi = Kaderisasi::create([
            'id_karyawan_junior' => $request->id_karyawan_junior,
            'id_karyawan_senior' => $request->id_karyawan_senior,
            'id_admin_corporate' => $userId,
            'id_manager'         => $request->id_manager,
            'uraian_keilmuan'    => $request->uraian_keilmuan,
        ]);

        return redirect()->route('kaderisasi.index')->with('success', 'Data Berhasil Ditambah');
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
        $managers = User::whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        })->get();

        $karyawanJunior = Karyawan::where('status', 'Junior')
        ->get();

        $karyawanSenior = Karyawan::where('status', 'Senior')
        ->get();

        $kaderisasi = Kaderisasi::findOrFail($id);

        return view('admin.kaderisasi.edit', [
            'managers'            => $managers,
            'karyawanJunior'      => $karyawanJunior,
            'karyawanSenior'      => $karyawanSenior,
            'kaderisasi'          => $kaderisasi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = Auth::id();

        $kaderisasi = Kaderisasi::findOrFail($id);

        $request->validate([
            'id_karyawan_junior' => 'required',
            'id_karyawan_senior' => 'required',
            'id_manager'         => 'required',
            'uraian_keilmuan'    => 'required',
        ], [
            'id_karyawan_junior.required' => 'Pilih Karyawan Junior',
            'id_karyawan_senior.required' => 'Pilih Karyawan Senior',
            'id_manager.required'         => 'Pilih Manager',
            'uraian_keilmuan.required'    => 'Uraian Keilmuan Harus Diisi',
        ]);

        $data = [
            'id_karyawan_junior' => $request->id_karyawan_junior,
            'id_karyawan_senior' => $request->id_karyawan_senior,
            'id_admin_corporate' => $userId,
            'id_manager'         => $request->id_manager,
            'uraian_keilmuan'    => $request->uraian_keilmuan,
        ];

        $kaderisasi->update($data);

        return redirect()->route('kaderisasi.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kaderisasi = Kaderisasi::find($id);

        $kaderisasi->delete();

        return response()->json(['status' => 'Data Telah Dihapus']);
    }
}
