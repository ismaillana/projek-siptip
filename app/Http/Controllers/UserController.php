<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin-it', 'admin-corporate', 'manager']);
        })->get();

        return view('admin.user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::whereIn('name', ['admin-it', 'admin-corporate', 'manager'])->get();
    
        return view('admin.user.tambah', [
            'role'      => $role,
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
            'role'              => 'required'
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
            'role.required'         => 'Role Harus Dipilih',
        ]);

        $role = Role::findOrFail($request->role);

        $user = User::create([
            'name'          => $request->name,
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);

        $user->assignRole($role);

        return redirect()->route('user.index')->with('success', 'Data Berhasil Ditambah');
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
        $user   = User::findOrFail($id);
        $role = Role::whereIn('name', ['admin-it', 'admin-corporate', 'manager'])->get();
        $userRoles = $user->roles;

        return view('admin.user.edit', [
            'user'      => $user,
            'role'      => $role,
            'userRoles' => $userRoles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'              => 'required',
            'username'          => 'required',
            'email'             => 'required|email|unique:users,email,' . $id,
            'role'              => 'required'
        ], [
            'name.required'         => 'Nama Harus Diisi',
            'username.required'     => 'Username Harus Diisi',
            'email.required'        => 'Email Harus Diisi',
            'email.email'           => 'Format Email Harus Sesuai',
            'email.unique'          => 'Email Sudah Digunakan',
            'role.required'         => 'Role Harus Dipilih',
        ]);

        $role = Role::findOrFail($request->role);
        $user = User::findOrFail($id); 

        $data = [
            'name'          => $request->name,
            'username'      => $request->username,
            'email'         => $request->email,
        ];

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
                $data['password'] = Hash::make($request->password);
            }
        }

        $user->update($data);
        $user->roles()->sync($request->role);

        return redirect()->route('user.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();

        return response()->json(['status' => 'Data Telah Dihapus']);
    }
}
