<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;
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
            'kandidats' => Kandidat::all()
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
            'nama' => 'required|regex:/^[a-zA-Z\s]*$/',
            'jk' => 'required',
            'slug' => 'required|unique:kandidats',
            'visi' => 'required',
            'misi' => 'required'
        ]);

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
            'nama' => 'required|regex:/^[a-zA-Z\s]*$/',
            'jk' => 'required',
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
        Kandidat::destroy($kandidat->id);

        return redirect('/dashboard/kandidat')->with('success', 'Data kandidat berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kandidat::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
