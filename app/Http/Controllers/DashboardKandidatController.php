<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Pemilu;
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
            'kandidats' => Kandidat::filter(request(['search']))->orderBy('nomor', 'ASC')->paginate(10)->withQueryString(),
            'waktupemilu' => $this->cekWaktuPemilu()
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
            'title' => 'Tambah Data Kandidat',
            'kelas' => Kelas::orderBy('nama', 'ASC')->get()
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
            'jabatan' => 'required',
            'kelas_id' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'foto' => 'image',
            'visi' => 'required',
            'misi' => 'required'
        ]);

        $validateData['slug'] = SlugService::createSlug(Kandidat::class, 'slug', $validateData['nama']);

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
        return view('dashboard.kandidat.show', [
            'title' => 'Detail Kandidat',
            'kandidat' => $kandidat
        ]);
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
            'kandidat' => $kandidat,
            'kelas' => Kelas::orderBy('nama', 'ASC')->get()
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
            'jabatan' => 'required',
            'kelas_id' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'foto' => 'image',
            'visi' => 'required',
            'misi' => 'required'
        ];


        if ($request->nomor != $kandidat->nomor) {
            $rules['nomor'] = 'required|numeric|unique:kandidats';
        }

        $validateData = $request->validate($rules);
        $validateData['slug'] = SlugService::createSlug(Kandidat::class, 'slug', $validateData['nama']);

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

    public function cekWaktuPemilu()
    {
        $pemilu = Pemilu::first();
        $now = Carbon::now();
        $cekwaktupemilu = false;
        if ($pemilu) {
            $cekwaktupemilu = $now->isAfter($pemilu->mulai) && $now->isBefore($pemilu->selesai);
        }

        return $cekwaktupemilu;
    }
}
