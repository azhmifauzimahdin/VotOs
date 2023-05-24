<?php

namespace App\Http\Controllers;

use App\Models\Voting;
use App\Models\Kandidat;
use Illuminate\Http\Request;

class UserVotingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth('pemilih')->check()){
            $id = auth('pemilih')->user()->id;
        }else{
            $id = 0;
        }

        return view('voting', [
            'title' => 'Voting',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get(),
            'votings' => Voting::get(),
            'status' => Voting::vote($id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'kandidat_id' => 'required'
            ]
        );

        $validateData['user_id'] = auth('pemilih')->user()->id;

        return redirect('/dashboard/pemilih')->with('success', 'Data pemilih berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voting  $voting
     * @return \Illuminate\Http\Response
     */
    public function show(Voting $voting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voting  $voting
     * @return \Illuminate\Http\Response
     */
    public function edit(Voting $voting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voting  $voting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voting $voting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voting  $voting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voting $voting)
    {
        //
    }
}
