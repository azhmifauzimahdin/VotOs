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
            'password' => 'required|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ]);

        $validateData['password'] = bcrypt($request->password);

        User::where('id', $user->id)->update($validateData);

        return redirect('/dashboard/ganti_password')->with('success', 'Password berhasil diganti!');
    }
}
