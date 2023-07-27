<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DashboardLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.laporan.index', [
            'title' => 'Data Laporan',
            'laporans' => Laporan::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pemilu = Laporan::get();
        if (count($pemilu) > 0) {
            abort(403);
        }
        return view('dashboard.laporan.create', [
            'title' => 'Data Laporan'
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
            'ketua' => 'required',
            'sekretaris' => 'required',
            'kesiswaan' => 'required',
            'pembina' => 'required',
            'kepala_sekolah' => 'required'
        ]);
        $validateData['id'] = 1;
        $validateData['kode'] = Str::random(100);
        $generateKode = 'http://' . request()->getHttpHost() . '/verifikasi/' . $validateData['kode'];
        $validateData['qr_code'] = QrCode::size(300)->errorCorrection('M')->generate($generateKode);

        Laporan::create($validateData);
        return redirect('/dashboard/hasilPemilu/laporan')->with('success', 'Data Laporan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        return view('dashboard.laporan.edit', [
            'title' => 'Edit Data Laporan',
            'laporan' => $laporan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {

        $validateData = $request->validate([
            'ketua' => 'required',
            'sekretaris' => 'required',
            'kesiswaan' => 'required',
            'pembina' => 'required',
            'kepala_sekolah' => 'required'
        ]);

        $validateData['kode'] = Str::random(100);
        $generateKode = 'http://' . request()->getHttpHost() . '/verifikasi/' . $validateData['kode'];
        $validateData['qr_code'] = QrCode::size(300)->errorCorrection('M')->generate($generateKode);

        Laporan::where('id', $laporan->id)->update($validateData);

        return redirect('/dashboard/hasilPemilu/laporan')->with('success', 'Data laporan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        Laporan::destroy($laporan->id);

        return redirect('/dashboard/hasilPemilu/laporan')->with('success', 'Data laporan berhasil dihapus!');
    }
}
