<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Hash;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user.index', [
            'title' => 'Data Admin & Panitia',
            'users' => User::latest()->filter(request(['search']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create', [
            'title' => 'Tambah Data Admin & Panitia'
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
            'jenis_kelamin' => 'required',
            'email' => 'required|email:dns|unique:users',
            'level' => 'required',
            'password' => [
                'required',
                'min:6',
                function ($attribute, $value, $fail) {
                    if (!preg_match("/[a-z]/", $value)) {
                        $fail('Harus berisi setidaknya satu huruf kecil.');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (!preg_match("/[A-Z]/", $value)) {
                        $fail('Harus berisi setidaknya satu huruf besar.');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (!preg_match("/[0-9]/", $value)) {
                        $fail('Harus berisi setidaknya satu angka.');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (!preg_match("/[@$!%*#?&]/", $value)) {
                        $fail('Harus berisi setidaknya satu karakter khusus.');
                    }
                },
            ],
            'foto' => 'image'
        ]);

        $validateData['slug'] = SlugService::createSlug(User::class, 'slug', $validateData['nama']);
        $validateData['password'] = Hash::make($request->password);

        if ($request->file('foto')) {
            $validateData['foto'] = $request->file('foto')->store('foto-user');
        }

        User::create($validateData);

        return redirect('/dashboard/user')->with('success', 'Data user berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.user.edit', [
            'title' => 'Edit Data Admin & Panitia',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'level' => 'required',
            'foto' => 'image',
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }
        if ($request->password) {
            $rules['password'] = [
                'required',
                'min:6',
                function ($attribute, $value, $fail) {
                    if (!preg_match("/[a-z]/", $value)) {
                        $fail('Harus berisi setidaknya satu huruf kecil.');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (!preg_match("/[A-Z]/", $value)) {
                        $fail('Harus berisi setidaknya satu huruf besar.');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (!preg_match("/[0-9]/", $value)) {
                        $fail('Harus berisi setidaknya satu angka.');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (!preg_match("/[@$!%*#?&]/", $value)) {
                        $fail('Harus berisi setidaknya satu karakter khusus.');
                    }
                },
            ];
        }

        $validateData = $request->validate($rules);
        $validateData['slug'] = SlugService::createSlug(User::class, 'slug', $validateData['nama']);

        if ($request->password) {
            $validateData['password'] = Hash::make($request->password);
        }

        if ($request->file('foto')) {
            if ($request->fotoLama) {
                Storage::delete($request->fotoLama);
            }
            $validateData['foto'] = $request->file('foto')->store('foto-user');
        }

        User::where('id', $user->id)->update($validateData);

        return redirect('/dashboard/user')->with('success', 'Data user berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect('/dashboard/user')->with('success', 'Data user berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(User::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
