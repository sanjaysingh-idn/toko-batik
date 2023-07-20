<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function index()
    {
        return view('admin.kategori', [
            'title'         => 'Daftar Kategori',
            'kategori'      => Kategori::all(),
        ]);
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'name'      => 'required|max:255',
            'image'     => 'required|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024',
        ]);

        $attr['slug']   = Str::slug($request->name);
        $attr['image']  = $request->file('image')->store('kategori');

        Kategori::create($attr);

        return back()->with('message', 'Kategori berhasil dibuat');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $attr = $request->validate([
            'name'    => 'required|max:255',
            'image'   => 'image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024',
        ]);

        $attr['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            // Delete the previous image file
            Storage::delete($kategori->image);

            // Store the new image file
            $attr['image'] = $request->file('image')->store('kategori');
        }

        $kategori->update($attr);

        return back()->with('message', 'Kategori berhasil diupdate');
    }

    public function destroy(Kategori $kategori)
    {
        if (!empty($kategori->image)) {
            Storage::delete($kategori->image);
        }

        $kategori->delete();
        return redirect()->back()->with('message', 'Kategori berhasil dihapus');
    }
}
