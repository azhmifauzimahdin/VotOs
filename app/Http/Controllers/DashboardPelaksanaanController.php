<?php

namespace App\Http\Controllers;

use App\Models\Pemilu;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardPelaksanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemilu = Pemilu::first();
        $now = Carbon::now();
        $cek = false;
        if ($pemilu && $now->isAfter($pemilu->mulai) && $now->isBefore($pemilu->selesai)) {
            $cek = true;
        }

        return view('dashboard.pelaksanaan.index', [
            'title' => 'Waktu Pelaksanaan',
            'pemilus' => Pemilu::get(),
            'cek' => $cek
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pemilu = Pemilu::get();
        if (count($pemilu) > 0) {
            abort(403);
        }
        return view('dashboard.pelaksanaan.create', [
            'title' => 'Tambah Waktu Pelaksanaan'
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
            'mulai' => 'required|date|after_or_equal:now',
            'selesai' => 'required|date|after:mulai',
        ]);
        $validateData['id'] = 1;

        Pemilu::create($validateData);
        return redirect('/dashboard/pelaksanaan')->with('success', 'Data waktu pelaksanaan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemilu  $pemilu
     * @return \Illuminate\Http\Response
     */
    public function show(Pemilu $pemilu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemilu  $pemilu
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemilu $pemilu)
    {
        return view('dashboard.pelaksanaan.edit', [
            'title' => 'Edit Waktu Pelaksanaan',
            'pemilu' => $pemilu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemilu  $pemilu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemilu $pemilu)
    {
        $validateData = $request->validate([
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai',
        ]);

        Pemilu::where('id', $pemilu->id)->update($validateData);

        return redirect('/dashboard/pelaksanaan')->with('success', 'Data waktu pelaksanaan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemilu  $pemilu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemilu $pemilu)
    {
        Pemilu::destroy($pemilu->id);

        return redirect('/dashboard/pelaksanaan')->with('success', 'Data waktu pelaksanaan berhasil dihapus!');
    }

    public function selesai()
    {
        Pemilu::where('id', 1)->update([
            'selesai' => Carbon::now()->format('Y-m-d H:i')
        ]);
        return redirect('/dashboard/pelaksanaan')->with('success', 'Waktu selesai pelaksanaan berhasil diupdate ke waktu sekarang!');
    }
}
