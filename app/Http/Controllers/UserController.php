<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $role = ['admin', 'customer'];

        return view('admin.user', [
            'title'     => 'Daftar User',
            'users'     => User::all(),
            'role'      => $role,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'name'          => 'required|max:255',
            'email'         => 'required|email:dns|max:150|unique:users,email',
            'role'          => 'required',
            'image'         => 'image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024',
            'contact'       => 'required|digits_between:10,13|unique:users,contact',
            'address'       => 'required|max:255',
            'tempat_lahir'  => 'required|max:255',
            'tgl_lahir'     => 'required',
            'password'      => 'required|string|min:8|max:255',
        ]);

        $attr['password'] = Hash::make($request->password);

        if ($request->file('image')) {
            $attr['image'] = $request->file('image')->store('user-image');
        }

        User::create($attr);

        return back()->with('message', 'Profil berhasil dibuat');
    }

    public function show(User $user)
    {
        // 
    }

    public function edit(User $user)
    {
        $role = ['admin', 'customer'];

        return view('admin.user_edit', [
            'title'     => 'Edit User ' . $user->name,
            'user'      => $user,
            'role'      => $role,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $attr = $request->validate([
            'name'          => 'required|max:255',
            'email'         => 'required|email:dns|max:150|unique:users,email,' . $user->id,
            'role'          => 'required',
            'image'         => 'image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024',
            'contact'       => 'required|digits_between:10,13|unique:users,contact,' . $user->id,
            'address'       => 'required|max:255',
            'tempat_lahir'  => 'required|max:255',
            'tgl_lahir'     => 'required',
        ]);

        if ($request->password) {
            $attr = $request->validate(['password'  => 'string|min:8|max:255']);
            $attr['password'] = Hash::make($request->password);
        }

        if ($request->file('image')) {
            if ($user->image !== null) {
                Storage::delete($user->image);
                $attr['image'] = $request->file('image')->store('user-image');
            } else {
                $attr['image'] = $request->file('image')->store('user-image');
            }
        } else {
            $attr['image'] = $user->image;
        }

        $user->update($attr);

        return back()->with('message', 'User Profil berhasil diupdate');
    }

    public function destroy(User $user)
    {
        if ($user->image) {
            Storage::delete($user->image);
        }
        $user->delete();
        return redirect()->back()->with('message', 'User Profil berhasil dihapus');
    }
}
