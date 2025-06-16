<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Admin',
            'admins' => User::where('role', 1)
                        ->where('id', '!=', Auth::id())
                        ->get(),
        ];

        return view('admin.admin.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Admin',
        ];

        return view('admin.admin.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 1, // Admin role
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Prevent editing the logged-in user
        if ($id == Auth::id()) {
            return redirect()->route('admin.index')->with('error', 'Anda tidak dapat mengedit akun Anda sendiri di sini');
        }

        $admin = User::where('role', 1)->findOrFail($id);

        $data = [
            'title' => 'Edit Admin',
            'admin' => $admin,
        ];

        return view('admin.admin.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Prevent updating the logged-in user
        if ($id == Auth::id()) {
            return redirect()->route('admin.index')->with('error', 'Anda tidak dapat mengubah akun Anda sendiri di sini');
        }

        $admin = User::where('role', 1)->findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
        ];

        // Only validate password if it's provided
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($rules);

        $admin->name = $request->name;
        $admin->email = $request->email;
        
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Data admin berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Prevent deleting the logged-in user
        if ($id == Auth::id()) {
            return redirect()->route('admin.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri');
        }

        $admin = User::where('role', 1)->findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus');
    }
}