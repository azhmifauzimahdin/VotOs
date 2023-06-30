<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardGantiPasswordController extends Controller
{
    public function index()
    {
        return view('dashboard.ganti_password.index', [
            'title' => 'Ganti Password',
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validateData = $request->validate([
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
        ]);

        $validateData['password'] = bcrypt($request->password);

        User::where('id', $user->id)->update($validateData);

        return redirect('/dashboard/ganti_password')->with('success', 'Password berhasil diganti!');
    }
}
