<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ambil hanya user dengan role user
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->get();

        $data = [
            'title' => 'Data User',
            'subtitle' => 'Daftar data user',
            'users' => $users,
        ];

        return view('admin.pages.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data User',
            'subtitle' => 'Tambahkan data user baru',
            'url_action' => route('admin.user.store'),
        ];
        
        return view('admin.pages.users.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required|min:8',
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ],
        // custom pesan error
        [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'phone.required' => 'Nomor telepon harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'avatar.required' => 'Avatar harus diisi',
            'avatar.image' => 'Avatar harus berupa gambar',
            'avatar.mimes' => 'Avatar harus berupa gambar dengan format jpg, jpeg, png',
            'avatar.max' => 'Ukuran avatar maksimal 2MB',
        ]);

        // proses simpan data user
        try {
            // begin transaction (save point jika terjadi error)
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password), // enkripsi password
            ]);

            // upload avatar
            if ($request->hasFile('avatar')) {
                // upload avatar baru
                $user->addMedia($request->avatar)
                    ->toMediaCollection('avatar');
            }

            // assign role user
            $user->assignRole('user');

            // commit jika tidak terjadi error
            DB::commit();

            // flash message
            flash()->addSuccess('Data user berhasil disimpan');

            return redirect()->route('admin.user.index');
        } catch (\Throwable $th) {
            // jika terjadi error

            // batalkan simpan data user
            DB::rollBack();

            // kembalikan pesan error
            !app()->isProduction()
                ? flash()->addError($th->getMessage())
                : flash()->addError('Terjadi kesalahan pada server, coba lagi');

            return back()->withInput();
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
        $user = User::with(['media'])->findOrFail($id);

        $data = [
            'title' => 'Edit Data User',
            'subtitle' => 'Edit data user',
            'url_action' => route('admin.user.update', $id),
            'user' => $user,
        ];
        
        return view('admin.pages.users.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required',
            'password' => 'nullable|min:8',
        ];

        // cek apakah ada request avatar
        if ($request->hasFile('avatar')) {
            // jika ada, tambahkan rules avatar
            $rules['avatar'] = 'required|image|mimes:jpg,jpeg,png|max:2048';
        }

        // valiadasi data
        $request->validate($rules,[
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'phone.required' => 'Nomor telepon harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'avatar.required' => 'Avatar harus diisi',
            'avatar.image' => 'Avatar harus berupa gambar',
            'avatar.mimes' => 'Avatar harus berupa gambar dengan format jpg, jpeg, png',
            'avatar.max' => 'Ukuran avatar maksimal 2MB',
        ]);

        // proses update data user
        try {
            // begin transaction (save point jika terjadi error)
            DB::beginTransaction();

            $user = User::findOrFail($id);

            // update data user
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ];

            // jika ada request password
            if ($request->password) {
                $updateData['password'] = Hash::make($request->password); // enkripsi password
            }

            $user->update($updateData);

            // update password jika ada request password
            if ($request->password) {
                $user->update([
                    'password' => Hash::make($request->password), // enkripsi password
                ]);
            }

            // upload avatar
            if ($request->hasFile('avatar')) {
                // hapus avatar lama
                $user->clearMediaCollection('avatar');

                // upload avatar baru
                $user->addMedia($request->avatar)
                    ->toMediaCollection('avatar');
            }

            // commit jika tidak terjadi error
            DB::commit();

            // flash message
            flash()->addSuccess('Data user berhasil diupdate');

            return redirect()->route('admin.user.index');
        } catch (\Throwable $th) {
            // jika terjadi error

            // batalkan simpan data user
            DB::rollBack();

            // kembalikan pesan error
            !app()->isProduction()
                ? flash()->addError($th->getMessage())
                : flash()->addError('Terjadi kesalahan pada server, coba lagi');

            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // cari user
        $user = User::findOrFail($id);

        // proses hapus user
        try {
            // begin transaction (save point jika terjadi error)
            DB::beginTransaction();

            // hapus avatar
            $user->clearMediaCollection('avatar');

            // hapus role user
            $user->removeRole('user');

            // hapus user
            $user->delete();

            // commit jika tidak terjadi error
            DB::commit();

            // flash message
            flash()->addSuccess('Data user berhasil dihapus');

            return redirect()->route('admin.user.index');
        } catch (\Throwable $th) {
            // jika terjadi error

            // batalkan simpan data user
            DB::rollBack();

            // kembalikan pesan error
            !app()->isProduction()
                ? flash()->addError($th->getMessage())
                : flash()->addError('Terjadi kesalahan pada server, coba lagi');

            return back()->withInput();
        }
    }
}
