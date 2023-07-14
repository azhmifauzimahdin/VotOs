<?php

namespace App\Http\Controllers;

use App\Jobs\SendAccountJob;
use App\Mail\SendAccount;
use App\Models\Jabatan;
use App\Models\Pemilih;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class DashboardPemilihGuruKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pemilih.index', [
            'title' => 'Data Guru & Karyawan',
            'objek' => 'Guru & Karyawan',
            'role' => 'gurukaryawan',
            'pemilihs' => Pemilih::latest()->whereNotNull('jabatan_id')->filter(request(['search']))->paginate(10)->withQueryString()
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
            'title' => 'Tambah Data Guru & Karyawan',
            'objek' => 'Guru & Karyawan',
            'role' => 'gurukaryawan',
            'jabatan' => Jabatan::orderBy('nama', 'ASC')->get()
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
        $validateData = $request->validate(
            [
                'nama' => 'required',
                'jabatan_id' => 'required',
                'jenis_kelamin' => 'required',
                'email' => 'required|email:dns|unique:pemilihs',
                'slug' => 'required|unique:pemilihs'
            ]
        );

        $validateData['user_id'] = auth()->user()->id;
        $password = Str::random(6);
        $validateData['password'] = Hash::make($password);

        $details = [
            'email' => $request->email,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $password,
            'url' => 'http://' . request()->getHttpHost() . '/loginPemilih'
        ];


        Pemilih::create($validateData);

        // dispatch(new SendAccountJob($details));

        return redirect('/dashboard/pemilih/gurukaryawan')->with('success', 'Data pemilih berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemilih  $pemilih
     * @return \Illuminate\Http\Response
     */
    public function show(Pemilih $pemilih)
    {
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
            'title' => 'Edit Data Guru & Karyawan',
            'objek' => 'Guru & Karyawan',
            'role' => 'gurukaryawan',
            'pemilih' => $pemilih,
            'jabatan' => Jabatan::orderBy('nama', 'ASC')->get()
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
            'jabatan_id' => 'required',
            'jenis_kelamin' => 'required'
        ];

        if ($request->slug != $pemilih->slug) {
            $rules['slug'] = 'required|unique:pemilihs';
        }
        if ($request->email != $pemilih->email) {
            $rules['email'] = 'required|email:dns|unique:pemilihs';
        }

        $validateData = $request->validate($rules);

        Pemilih::where('id', $pemilih->id)->update($validateData);

        return redirect('/dashboard/pemilih/gurukaryawan')->with('success', 'Data pemilih berhasil diupdate!');
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

        return redirect('/dashboard/pemilih/gurukaryawan')->with('success', 'Data pemilih berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Pemilih::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
