<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        return view('admin.banner', [
            'title'       => 'Daftar Banner',
            'banner'      => Banner::all(),
        ]);
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'keterangan'    => 'required',
            'image'         => 'required|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024',
        ]);

        $attr['image'] = $request->file('image')->store('banner');

        Banner::create($attr);

        return back()->with('message', 'Banner berhasil dibuat');
    }

    public function destroy(Banner $banner)
    {
        $banner = Banner::find($banner->id);

        if (!empty($banner->image)) {
            Storage::delete($banner->image);
        }

        $banner->delete();

        return back()->with('message', 'Banner berhasil dihapus');
    }
}
