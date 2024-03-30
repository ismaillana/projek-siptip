<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use App\Models\Karyawan;
use App\Models\User;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $karyawan = Karyawan::all();

        return view('admin.karyawan.index', [
            'karyawan' => $karyawan,
            'title'    => 'PTDI|Karyawan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::whereIn('name', ['karyawan-senior', 'karyawan-junior'])->get();
    
        return view('admin.karyawan.tambah', [
            'role'      => $role,
            'title'    => 'PTDI|Tambah Karyawan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required',
            'username'          => 'required',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|min:3',
            'konfirmasi_password' => 'required|min:3|same:password',
            'alamat'            => 'required',
            'nik'               => 'required|max:16|unique:karyawans,nik',
            'organisasi'        => 'required',
            'kode_pekerjaan'    => 'required',
            'judul_pekerjaan'   => 'required',
            'tanggal_lahir'     => 'required',
            'status'            => 'required',
        ], [
            'name.required'         => 'Nama Harus Diisi',
            'username.required'     => 'Username Harus Diisi',
            'email.required'        => 'Email Harus Diisi',
            'email.email'           => 'Format Email Harus Sesuai',
            'email.unique'          => 'Email Sudah Digunakan',
            'password.required'     => 'Password Harus Diisi',
            'password.min'          => 'Password minimal 3 huruf/angka',
            'konfirmasi_password.required'=> 'Konfirmasi Password Harus Diisi',
            'konfirmasi_password.min'     => 'Konfirmasi Password minimal 3 huruf/angka',
            'konfirmasi_password.same'    => 'Data Password dan Konfirmasi Password Harus Sama',
            'alamat.required'       => 'Alamat Harus Diisi',
            'nik.required'          => 'NIK Harus Diisi',
            'nik.unique'            => 'NIK Sudah Digunakan Oleh Akun Lain',
            'organisasi.required'   => 'Organisasi Harus Diisi',
            'kode_pekerjaan.required'     => 'Kode Pekerjaan Harus Diisi',
            'judul_pekerjaan.required'    => 'Judul Pekerjaan Harus Diisi',
            'tanggal_lahir.required'      => 'Tanggal Lahir Harus Diisi',
            'status.required'       => 'Status Harus Diisi',
        ]);

        $roleName = $request->status == 'Senior' ? 'karyawan-senior' : 'karyawan-junior';
        $role = Role::where('name', $roleName)->firstOrFail();

        $user = User::create([
            'name'          => $request->name,
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);

        $data = [
            'user_id'           => $user->id,
            'nama_lengkap'      => $user->name,
            'nik'               => $request->nik,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'organisasi'        => $request->organisasi,
            'kode_pekerjaan'    => $request->kode_pekerjaan,
            'judul_pekerjaan'   => $request->judul_pekerjaan,
            'status'            => $request->status,
            'alamat'            => $request->alamat,
        ];

        $karyawan = Karyawan::create($data);

        $user->assignRole($role);

        return redirect()->route('karyawan.index')->with('success', 'Data Berhasil Ditambah');
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
        $karyawan = Karyawan::findOrFail($id); 
        $role = Role::whereIn('name', ['karyawan-senior', 'karyawan-junior'])->get();

        return view('admin.karyawan.edit', [
            'karyawan'  => $karyawan,
            'role'      => $role,
            'title'    => 'PTDI|Edit Karyawan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $user_id = $karyawan->user_id; 
        $user = User::findOrFail($user_id);

        $rules = [
            'name' => 'required',
            'username' => 'required',
            'email' => ['required', 'email'],
            'alamat' => 'required',
            'nik' => ['required', 'max:16'],
            'organisasi' => 'required',
            'kode_pekerjaan' => 'required',
            'judul_pekerjaan' => 'required',
            'tanggal_lahir' => 'required',
        ];

        if ($request->email != $user->email) {
            $rules['email'][] = Rule::unique('users', 'email')->ignore($user_id);
        }

        $rules['nik'][] = Rule::unique('karyawans', 'nik')->ignore($id);

        $request->validate($rules, [
            'name.required' => 'Nama Harus Diisi',
            'username.required' => 'Username Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'email.email' => 'Format Email Harus Sesuai',
            'email.unique' => 'Email Sudah Digunakan',
            'alamat.required' => 'Alamat Harus Diisi',
            'nik.required' => 'NIK Harus Diisi',
            'nik.unique' => 'NIK Sudah Digunakan Oleh Akun Lain',
            'organisasi.required' => 'Organisasi Harus Diisi',
            'kode_pekerjaan.required' => 'Kode Pekerjaan Harus Diisi',
            'judul_pekerjaan.required' => 'Judul Pekerjaan Harus Diisi',
            'tanggal_lahir.required' => 'Tanggal Lahir Harus Diisi',
        ]);

        $user = $karyawan->user;
        $user->update([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
        ]);

        if ($request->password || $request->konfirmasi_password) {
            $rules = [
                'password'              => 'nullable|min:3',
                'konfirmasi_password'   => 'nullable|min:3|same:password',
            ];
        
            $messages = [
                'password.min' => 'Password minimal 3 huruf/angka',
                'konfirmasi_password.min'  => 'Konfirmasi Password minimal 3 huruf/angka',
                'konfirmasi_password.same' => 'Data Password dan Konfirmasi Password Harus Sama',
            ];
        
            $request->validate($rules, $messages);
        
            if ($request->password) {
                $user['password'] = Hash::make($request->password);
            }
        }

        $roleName = $request->status == 'Senior' ? 'karyawan-senior' : 'karyawan-junior';
        $role = Role::where('name', $roleName)->firstOrFail();

        $user->roles()->sync([$role->id]);

        $karyawan->update([
            'nik'               => $request->nik,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'organisasi'        => $request->organisasi,
            'kode_pekerjaan'    => $request->kode_pekerjaan,
            'judul_pekerjaan'   => $request->judul_pekerjaan,
            'status'            => $request->status,
            'alamat'            => $request->alamat,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawan = Karyawan::find($id);
            
        $karyawan->delete();
        
        $user = User::where('id', $karyawan->user_id)->first();

        $user->delete();

        return response()->json(['status' => 'Data Berhasil Dihapus']);
    }
}
