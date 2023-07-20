<?php

namespace App\Http\Controllers;

use App\Models\FotoProduk;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.produk', [
            'title'         => 'Daftar Produk',
            'produk'        => Produk::all(),
            'fotoProduk'    => FotoProduk::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ukuran = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
        return view('admin.produk_create', [
            'title'     => 'Tambah Produk',
            'kategori'  => Kategori::all(),
            'ukuran'    => $ukuran
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'name'      => 'required|max:255|unique:produks,name',
            'image'     => 'required|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024',
            'harga'     => 'required|numeric|min:1',
            'stok'      => 'required|numeric|min:1',
            'berat'     => 'required|numeric|min:1',
            'desc'      => 'required|string',
            'ukuran'    => 'required|array',
            'ukuran.*'   => 'in:XS,S,M,L,XL,XXL,XXXL',
            'id_kategori' => 'required'
        ]);

        $attr['slug']   = Str::slug($attr['name']);
        $attr['image']  = $request->file('image')->store('produk-image');
        $ukuranReady    = implode(',', $attr['ukuran']);
        $attr['ukuran'] = $ukuranReady;

        Produk::create($attr);

        return back()->with('message', 'Produk berhasil diinput');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        $ukuran = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
        return view('admin.produk_edit', [
            'title'     => 'Tambah Produk',
            'produk'    => Produk::find($produk->id),
            'kategori'  => Kategori::all(),
            'ukuran'    => $ukuran
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $attr = $request->validate([
            'name'         => 'required|max:255|unique:produks,name,' . $produk->id,
            'image'        => 'image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024',
            'harga'        => 'required|numeric|min:1',
            'stok'         => 'required|numeric|min:1',
            'berat'        => 'required|numeric|min:1',
            'desc'         => 'required|string',
            'ukuran'       => 'required|array',
            'ukuran.*'     => 'in:XS,S,M,L,XL,XXL,XXXL',
            'id_kategori'  => 'required'
        ]);

        $attr['slug'] = Str::slug($attr['name']);

        if ($request->hasFile('image')) {
            // Delete the previous image file
            Storage::delete($produk->image);

            // Store the new image file
            $attr['image'] = $request->file('image')->store('produk-image');
        }

        $ukuranReady = implode(',', $attr['ukuran']);
        $attr['ukuran'] = $ukuranReady;

        $produk->update($attr);

        return back()->with('message', 'Produk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $produk = Produk::find($produk->id);

        if (!empty($produk->image)) {
            Storage::delete($produk->image);
        }

        $produk->delete();

        return back()->with('message', 'Produk berhasil dihapus');
    }

    public function addFoto(Request $request, $id)
    {
        $attr = $request->validate([
            'image'     => 'required|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024',
        ]);

        $produk = Produk::find($id);

        $attr['produk_id']  = $produk->id;
        $attr['image']      = $request->file('image')->store('produk-foto-image');
        FotoProduk::create($attr);

        return back()->with('message', 'Foto Produk berhasil diinput');
    }

    public function deleteFoto($id)
    {
        $fotoProduk = FotoProduk::find($id);

        Storage::delete($fotoProduk->image);
        $fotoProduk->delete();

        return back()->with('message', 'Foto Produk berhasil dihapus');
    }
}
