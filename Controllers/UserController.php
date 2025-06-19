<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('updated_at', 'desc')->get();
        return view('backend.dashboard', [
            'judul' => 'Data User',
            'index' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_user.create', [
        'judul' => 'Tambah User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama'     => 'required|max:255',
            'email'    => 'required|max:255|email|unique:users',
            'role'     => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        // Validasi kekuatan password
        $password = $request->input('password');
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';
        // harus mengandung huruf kecil, huruf besar, angka, dan simbol

        if (preg_match($pattern, $password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);

            User::create($validatedData);

            return redirect()
                ->route('backend.dashboard')
                ->with('success', 'Data berhasil tersimpan');
        } else {
            return redirect()
                ->back()
                ->withErrors([
                    'password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.'
                ]);
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
        $user = User::findOrFail($id);
        return view('backend.v_user.edit', [
            'judul' => 'Ubah User',
            'edit' => $user
        ]);
    }
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable|min:6', 
        ]);

        $user = User::findOrFail($id);

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->role = $request->role;

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('backend.dashboard')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Langsung hapus data user tanpa menghapus file foto
        $user->delete();

        return redirect()
            ->route('backend.dashboard')
            ->with('success', 'Data berhasil dihapus');
    }
}
