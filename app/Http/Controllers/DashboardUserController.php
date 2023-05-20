<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

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
            'title' => 'Data User',
            'users' => User::all()
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
            'title' => 'Tambah Data User'
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
            'username' => 'required|unique:users',
            'slug' => 'required|unique:users',
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

        $validateData['password'] = bcrypt($request->password);

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
            'title' => 'Edit Data User',
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
            'level' => 'required',
            'foto' => 'image',
        ];


        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:users';
        }
        if ($request->slug != $user->slug) {
            $rules['slug'] = 'required|unique:users';
        }
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

        if ($request->password) {
            $validateData['password'] = bcrypt($request->password);
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
        $username = str_replace(' ', '', $request->nama) . mt_rand(1, 100);
        return response()->json(['slug' => $slug, 'username' => $username]);
    }
}
