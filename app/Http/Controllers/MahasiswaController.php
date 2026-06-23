<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        if(!session('intern_login')){
            return redirect('/mahasiswa/login');
        }

        return view('mahasiswa.dashboard');
    }

    public function login()
    {
        return view('mahasiswa.login');
    }

public function prosesLogin(Request $request)
{
    $intern = Intern::where('email', $request->email)->first();

    if (!$intern || !Hash::check($request->password, $intern->password)) {
        return back()->with('error', 'Email atau Password salah');
    }

    session([
        'intern_login' => true,
        'intern_id' => $intern->id,
        'intern_name' => $intern->name,
        'intern_email' => $intern->email
    ]);

    return redirect('/mahasiswa/dashboard');
}

    public function absensi()
    {
        if(!session('intern_login')){
            return redirect('/mahasiswa/login');
        }

        return view('mahasiswa.absensi');
    }

public function riwayat()
{
    $internId = session('intern_id');

    $riwayat = \App\Models\Attendance::where(
        'intern_id',
        $internId
    )
    ->latest('attendance_date')
    ->get();

    return view(
        'mahasiswa.riwayat',
        compact('riwayat')
    );
}
public function logout()
{
    Session::flush();

    return redirect('/mahasiswa/login');
}
}
