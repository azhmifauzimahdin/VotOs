<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemilu;
use App\Models\Jabatan;
use App\Models\Pemilih;
use Illuminate\Support\Str;
use App\Jobs\SendAccountJob;
use Illuminate\Http\Request;
use App\Exports\GuruKaryawanExport;
use App\Imports\GuruKaryawanImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

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
            'pemilihs' => Pemilih::latest()->whereNotNull('jabatan_id')->filter(request(['search']))->paginate(10)->withQueryString(),
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
        $validateData = $request->validate([
            'nama' => 'required',
            'jabatan_id' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required|email:dns|unique:pemilihs'
        ]);

        $validateData['slug'] = SlugService::createSlug(Pemilih::class, 'slug', $validateData['nama']);
        $validateData['user_id'] = auth()->user()->id;
        $password = Str::random(6);
        $validateData['password'] = Hash::make($password);

        $details = [
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => $password,
            'url' => 'http://' . request()->getHttpHost() . '/loginPemilih'
        ];

        Pemilih::create($validateData);

        dispatch(new SendAccountJob($details));

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

        if ($request->email != $pemilih->email) {
            $rules['email'] = 'required|email:dns|unique:pemilihs';
        }

        $validateData = $request->validate($rules);
        $validateData['slug'] = SlugService::createSlug(Pemilih::class, 'slug', $validateData['nama']);

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

    public function importGuruKaryawan()
    {
        return view('dashboard.pemilih.import', [
            'title' => 'Data Guru & Karyawan',
            'objek' => 'Guru & Karyawan',
            'role' => 'gurukaryawan'
        ]);
    }

    public function fileImport(Request $request)
    {
        Excel::import(new GuruKaryawanImport, $request->file('file'));
        return redirect('/dashboard/pemilih/gurukaryawan')->with('success', 'Data pemilih berhasil ditambahkan!');
    }

    public function fileExport()
    {
        return Excel::download(new GuruKaryawanExport, 'DataGuruKaryawan.xlsx');
    }

    public function downloadTemplate()
    {
        return Storage::download('template/TemplateDataGuruKaryawan.xlsx');
    }
}
