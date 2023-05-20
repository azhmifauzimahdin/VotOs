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
            'nama' => 'required',
            'username' => 'required|unique:pemilihs',
            'email' => 'required|email:dns|unique:pemilihs',
            'slug' => 'required|unique:pemilihs',
            'kelas' => 'required',
            'jk' => 'required',
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
        return view('dashboard.pemilih.edit', [
            'title' => 'Edit Data Pemilih',
            'pemilih' => $pemilih
        ]);
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
        $rules = [
            'nama' => 'required',
            'kelas' => 'required',
            'jk' => 'required'
        ];

        if ($request->nisn != $pemilih->nisn) {
            $rules['nisn'] = 'required|numeric|unique:pemilihs';
        }
        if ($request->slug != $pemilih->slug) {
            $rules['slug'] = 'required|unique:pemilihs';
        }
        if ($request->username != $pemilih->username) {
            $rules['username'] = 'required|unique:pemilihs';
        }
        if ($request->email != $pemilih->email) {
            $rules['email'] = 'required|email:dns|unique:pemilihs';
        }

        $validateData = $request->validate($rules);
        if ($request->password) {
            $rules['password'] = 'required|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/';
            $validateData['password'] = bcrypt($request->password);
        }

        Pemilih::where('id', $pemilih->id)->update($validateData);

        return redirect('/dashboard/pemilih')->with('success', 'Data pemilih berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemilih  $pemilih
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemilih $pemilih)
    {
        Pemilih::destroy($pemilih->id);

        return redirect('/dashboard/pemilih')->with('success', 'Data pemilih berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Pemilih::class, 'slug', $request->nama);
        $temp = str_replace(' ', '', $request->nama);
        $username = preg_replace('/[^\p{L}\p{N}\s]/u', '', $temp) . substr($request->nisn, -2);
        return response()->json(['slug' => $slug, 'username' => $username]);
    }
}
