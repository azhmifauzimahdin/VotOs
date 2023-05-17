<?php

namespace App\Http\Controllers;

use App\Models\Pemilih;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class DashboardPemilihController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pemilih.index', [
            'title' => 'Data Pemilih',
            'pemilihs' => Pemilih::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pemilih.create', [
            'title' => 'Tambah Data Pemilih'
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
            'nisn' => 'required|numeric|unique:pemilihs',
            'nama' => 'required|regex:/^[a-zA-Z\s]*$/',
            'slug' => 'required|unique:pemilihs',
            'kelas' => 'required',
            'jk' => 'required',
            'username' => 'required',
            'password' => 'required|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/'
        ]);

        $validateData['user_id'] = auth()->user()->id;
        $validateData['password'] = bcrypt($request->password);

        Pemilih::create($validateData);

        return redirect('/dashboard/pemilih')->with('success', 'Data pemilih berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemilih  $pemilih
     * @return \Illuminate\Http\Response
     */
    public function show(Pemilih $pemilih)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemilih  $pemilih
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemilih $pemilih)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemilih  $pemilih
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemilih $pemilih)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemilih  $pemilih
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemilih $pemilih)
    {
        //
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Pemilih::class, 'slug', $request->nama);
        $username = str_replace(' ', '', $request->nama) . substr($request->nisn, -2);
        return response()->json(['slug' => $slug, 'username' => $username]);
        // return response()->json(['slug' => $slug]);
    }
}
