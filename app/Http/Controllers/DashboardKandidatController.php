<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardKandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kandidat.index', [
            'title' => 'Data Kandidat',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kandidat.create', [
            'title' => 'Tambah Data Kandidat'
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
        $validateData = $request->validate([
            'nomor' => 'required|numeric|unique:kandidats',
            'nama' => 'required',
            'jk' => 'required',
            'foto' => 'image',
            'slug' => 'required|unique:kandidats',
            'visi' => 'required',
            'misi' => 'required'
        ]);

        if ($request->file('foto')) {
            $validateData['foto'] = $request->file('foto')->store('foto-kandidat');
        }

        Kandidat::create($validateData);

        return redirect('/dashboard/kandidat')->with('success', 'Data kandidat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function show(Kandidat $kandidat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function edit(Kandidat $kandidat)
    {
        return view('dashboard.kandidat.edit', [
            'title' => 'Edit Data Kandidat',
            'kandidat' => $kandidat
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kandidat $kandidat)
    {
        $rules = [
            'nama' => 'required',
            'jk' => 'required',
            'foto' => 'image',
            'visi' => 'required',
            'misi' => 'required'
        ];


        if ($request->nomor != $kandidat->nomor) {
            $rules['nomor'] = 'required|numeric|unique:kandidats';
        }

        if ($request->slug != $kandidat->slug) {
            $rules['slug'] = 'required|unique:kandidats';
        }

        $validateData = $request->validate($rules);

        if ($request->file('foto')) {
            if ($request->fotoLama) {
                Storage::delete($request->fotoLama);
            }
            $validateData['foto'] = $request->file('foto')->store('foto-kandidat');
        }

        Kandidat::where('id', $kandidat->id)->update($validateData);

        return redirect('/dashboard/kandidat')->with('success', 'Data kandidat berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kandidat $kandidat)
    {
        if ($kandidat->foto) {
            Storage::delete($kandidat->foto);
        }
        Kandidat::destroy($kandidat->id);

        return redirect('/dashboard/kandidat')->with('success', 'Data kandidat berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kandidat::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
