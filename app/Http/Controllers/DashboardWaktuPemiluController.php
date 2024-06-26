<?php

namespace App\Http\Controllers;

use App\Models\Pemilu;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardWaktuPemiluController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemilu = Pemilu::first();
        $pemilus = Pemilu::get();
        $now = Carbon::now();
        $waktuPemiluBerlangsung  = false;
        $status = '';

        if ($pemilu) {
            if ($now->isBefore($pemilu->mulai)) {
                $status = '<td class="text-danger">Belum Dimulai</td>';
            } elseif ($now->isAfter($pemilu->mulai) && $now->isBefore($pemilu->selesai)) {
                $waktuPemiluBerlangsung = true;
                $status = '<td class="text-primary">Berlangsung</td>';
            } elseif ($now->isAfter($pemilu->selesai)) {
                $status = '<td class="text-success">Selesai</td>';
            }
        }

        return view('dashboard.waktu_pemilu.index', [
            'title' => 'Waktu Pemilu',
            'pemilus' => Pemilu::get(),
            'WaktuPemiluMasihKosong' => count($pemilus) == 0 ? true : false,
            'waktuPemiluBerlangsung' => $waktuPemiluBerlangsung,
            'status' => $status
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
        return view('dashboard.waktu_pemilu.create', [
            'title' => 'Tambah Waktu Pemilu'
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
        return redirect('/dashboard/waktupemilu')->with('success', 'Data waktu pemilu berhasil ditambahkan!');
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
        return view('dashboard.waktu_pemilu.edit', [
            'title' => 'Edit Waktu Pemilu',
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

        return redirect('/dashboard/waktupemilu')->with('success', 'Data waktu pemilu berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemilu  $pemilu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemilu $pemilu)
    {
        //    
    }

    public function selesai()
    {
        Pemilu::where('id', 1)->update([
            'selesai' => Carbon::now()->format('Y-m-d H:i')
        ]);
        return redirect('/dashboard/waktupemilu')->with('success', 'Waktu selesai pemilu berhasil diupdate ke waktu sekarang!');
    }
}
