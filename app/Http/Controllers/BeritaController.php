<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use File;

class BeritaController extends Controller
{
    public function index()
    {
        $allBerita = Berita::get();
        $kategori = Kategori::get();
        $user     = User::get();
        return view('admin.berita.index', compact('allBerita', 'kategori', 'user'));
    }

    // public function create()
    // {
    //     $kategori = Kategori::get();
    //     $user     = User::get();
    //     return view('admin.berita.index', compact('kategori', 'user'));
    // }

    public function store(Request $request)
    {

        $request->validate([
            'user_id'       => '',
            'kategori_id'   => 'required',
            'judul'         => 'required',
            'cover'         => 'required|image|mimes:jpg,png,jpeg',
            'deskripsi'     => 'required'
        ]);


        $coverName = time() . '.' . $request->cover->extension();

        $request->cover->move(public_path('img/cover'), $coverName);

        $berita = new Berita;

        $berita->user_id     = auth()->user()->id;
        $berita->kategori_id = $request->kategori_id;
        $berita->judul       = $request->judul;
        $berita->cover       = $coverName;
        $berita->deskripsi   = $request->deskripsi;

        $berita->save();

        return redirect('/berita')->with('success', 'added data successfully');
    }

    public function edit($id)
    {
        $kategori = Kategori::get();
        $user     = User::get();
        $berita   = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita', 'kategori', 'user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id'       => '',
            'kategori_id'   => 'required',
            'judul'         => 'required',
            'cover'         => 'image|mimes:jpg,png,jpeg',
            'deskripsi'     => 'required'
        ]);


        if ($request->has('cover')) {
            $berita = Berita::find($id);

            $path = "img/cover/";
            File::delete($path . $berita->cover);

            $coverName = time() . '.' . $request->cover->extension();

            $request->cover->move(public_path('img/cover'), $coverName);

            $berita->judul       = $request->judul;
            $berita->cover       = $coverName;
            $berita->deskripsi   = $request->deskripsi;
            $berita->user_id     = auth()->user()->id;
            $berita->kategori_id = $request->kategori_id;

            $berita->save();

            return redirect('/berita');
        } else {
            $berita = Berita::find($id);

            $berita->judul       = $request->judul;
            $berita->deskripsi   = $request->deskripsi;
            $berita->user_id     = auth()->user()->id;
            $berita->kategori_id = $request->kategori_id;

            $berita->save();

            return redirect('/berita');
        }
    }


    public function destroy($id)
    {
        $berita = Berita::find($id);

        $path = "img/cover/";
        File::delete($path . $berita->cover);
        $berita->delete();

        return redirect('/berita')->with('success', 'success, data deleted');
    }
}
