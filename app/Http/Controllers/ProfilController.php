<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user    =   auth()->user();
        
        return view ('admin.profil.index', [
            'user'   =>  $user,
            'title'     => 'PTDI|Profil'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProfil(Request $request, $id)
    {
        $request->validate([
            'name'              => 'required',
            'email'             => 'required|email|unique:users,email,'  . $id,
            'username'                => 'required',
        ], [
            'name.required'         => 'Nama Wajib Diisi',
            'email.required'        => 'Email Wajib Diisi',
            'email.email'           => 'Format Email Harus Sesuai',
            'username.required'     => 'Username Wajib Diisi',
            'email.unique'          => 'Email Sudah Digunakan',
        ]);

        $data = [
            'name'        => $request->name,
            'username'    => $request->username,
            'email'       => $request->email,
        ];

        User::where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Data Berhasil Diedit');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function password()
    {
        $user    =   auth()->user();
        
        return view ('admin.profil.password', [
            'user'   =>  $user,
            'title'     => 'Password'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password'          => 'required|min:3',
            'password_confirmation' => 'required|min:3|same:password'
        ], [
            'password.required'     => 'Password Wajib Diisi',
            'password.min'          => 'Password minimal 3 huruf/angka',
            'password_confirmation.required'=> 'Konfirmasi Password Wajib Diisi',
            'password_confirmation.min'     => 'Konfirmasi Password minimal 3 huruf/angka',
            'password_confirmation.same'    => 'Data Password dan Konfirmasi Password Harus Sama',
        ]);

        $data = [
            'password'    => Hash::make($request->password)
        ];

        User::where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Data Berhasil Diedit');
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
