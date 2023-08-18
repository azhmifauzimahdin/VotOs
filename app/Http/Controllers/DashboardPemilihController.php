<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemilu;
use App\Models\Laporan;
use App\Models\Pemilih;
use Illuminate\Support\Str;
use App\Jobs\SendAccountJob;
use Illuminate\Http\Request;
use App\Exports\PemilihExport;
use App\Imports\PemilihImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

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
            'pemilihs' => Pemilih::orderBy('updated_at', 'DESC')->filter(request(['search']))->paginate(10)->withQueryString(),
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
            'title' => 'Tambah Pemilih'
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
            'kelas_jabatan' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required|email:dns|unique:pemilihs'
        ]);

        $validateData['slug'] = SlugService::createSlug(Pemilih::class, 'slug', $validateData['nama']);
        $password = Str::random(6);
        $validateData['password'] = Hash::make($password);

        $details = [
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => $password,
            'url' => 'http://' . request()->getHttpHost() . '/loginPemilih'
        ];

        Pemilih::create($validateData);
        $laporan = Laporan::where('id', 1)->first();
        if ($laporan) {
            $laporan->increment('jumlah_pemilih');
            $laporan->increment('jumlah_belum_memilih');
        } else {
            Laporan::create(['id' => 1, 'user_id' => auth()->user()->id, 'jumlah_pemilih' => 1, 'jumlah_belum_memilih' => 1]);
        }

        dispatch(new SendAccountJob($details));

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
            'kelas_jabatan' => 'required',
            'jenis_kelamin' => 'required'
        ];

        if ($request->email != $pemilih->email) {
            $rules['email'] = 'required|unique:pemilihs';
        }

        $validateData = $request->validate($rules);
        $validateData['slug'] = SlugService::createSlug(Pemilih::class, 'slug', $validateData['nama']);

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
        $laporan = Laporan::where('id', 1)->first();
        $laporan->increment('jumlah_pemilih', -1);
        $laporan->increment('jumlah_belum_memilih', -1);

        return redirect('/dashboard/pemilih')->with('success', 'Data pemilih berhasil dihapus!');
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

    public function importPemilih()
    {
        return view('dashboard.pemilih.import', [
            'title' => 'Import Data Pemilih'
        ]);
    }

    public function downloadTemplate()
    {
        return Storage::download('template/TemplateDataPemilih.xlsx');
    }

    public function fileImport(Request $request)
    {
        Excel::import(new PemilihImport, $request->file('file'));
        return redirect('/dashboard/pemilih')->with('success', 'Data pemilih berhasil ditambahkan!');
    }
    public function fileExport()
    {
        return Excel::download(new PemilihExport, 'DataPemilih.xlsx');
    }
}
