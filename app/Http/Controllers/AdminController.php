<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Admin;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function dashboard()
    {
        if (!session('admin_login')) {
            return redirect('/admin/login');
        }

        return view('admin.dashboard');
    }

public function rekapAbsensi()
{
    $interns = Intern::with('attendances')->get();

    $attendances = Attendance::with('intern')
        ->latest()
        ->get();

    return view(
        'admin.rekapabsensi',
        compact('interns','attendances')
    );
}
    public function intern_management()
    {
        if (!session('admin_login')) {
            return redirect('/admin/login');
        }

        $interns = Intern::all();

        return view('admin.intern_management', compact('interns'));
    }

    public function prosesLogin(Request $request)
    {
        $admin = Admin::where('nip', $request->nip)
                      ->where('password', $request->password)
                      ->first();

        if (!$admin) {
            return redirect()->back()
                ->with('error', 'NIP atau Password salah');
        }

        session([
            'admin_login' => true,
            'admin_id' => $admin->id,
            'admin_name' => $admin->name
        ]);

        return redirect('/admin/dashboard');
    }

    public function deleteIntern($id)
    {
        Intern::findOrFail($id)->delete();

        return redirect()->back()
            ->with('success', 'Intern berhasil dihapus');
    }

    public function storeIntern()
    {
        Intern::create([
            'intern_code' => 'INT'.rand(1000,9999),
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password'),
            'phone' => request('phone'),
            'institution' => request('institution'),
            'major' => request('major'),
            'division' => request('division'),
            'mentor' => request('mentor'),
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
            'status' => 'active'
        ]);

        return redirect()->back();
    }

    public function resetPassword($id)
    {
        $intern = Intern::findOrFail($id);

        $intern->update([
            'password' => 'intern123'
        ]);

        return redirect()->back()->with(
            'success',
            'Password berhasil direset menjadi intern123'
        );
    }
    public function exportPdf()
{
    $attendances = Attendance::with('intern')
        ->orderBy('attendance_date','desc')
        ->get();

    $pdf = Pdf::loadView(
        'admin.pdf_absensi',
        compact('attendances')
    );

    return $pdf->download(
        'Rekap_Absensi_Internship.pdf'
    );
}
}