<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ✅ Single, secure prosesLogin (duplicate removed)
    public function prosesLogin(Request $request)
    {
        $admin = Admin::where('nip', $request->nip)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return redirect()->back()
                ->with('error', 'NIP atau Password salah');
        }

        session([
            'admin_login' => true,
            'admin_id'    => $admin->id,
            'admin_name'  => $admin->name,
        ]);

        return redirect('/admin/dashboard');
    }

    // ✅ Auth guard added
    public function rekapAbsensi()
    {
        if (!session('admin_login')) {
            return redirect('/admin/login');
        }

        $interns     = Intern::with('attendances')->get();
        $attendances = Attendance::with('intern')->latest()->get();

        return view('admin.rekapabsensi', compact('interns', 'attendances'));
    }

    public function intern_management()
    {
        if (!session('admin_login')) {
            return redirect('/admin/login');
        }

        $interns = Intern::all();

        return view('admin.intern_management', compact('interns'));
    }

    public function deleteIntern($id)
    {
        Intern::findOrFail($id)->delete();

        return redirect()->back()
            ->with('success', 'Intern berhasil dihapus');
    }

    // ✅ Uses injected Request
    public function storeIntern(Request $request)
    {
        Intern::create([
            'intern_code' => 'INT' . rand(1000, 9999),
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => $request->password,
            'phone'       => $request->phone,
            'institution' => $request->institution,
            'major'       => $request->major,
            'division'    => $request->division,
            'mentor'      => $request->mentor,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'status'      => 'active',
        ]);

        return redirect()->back();
    }

    // ✅ Password is now hashed
    public function resetPassword($id)
    {
        $intern = Intern::findOrFail($id);

        $intern->update([
            'password' => Hash::make('intern123'),
        ]);

        return redirect()->back()
            ->with('success', 'Password berhasil direset menjadi intern123');
    }

    // ✅ Auth guard added
    public function exportPdf()
    {
        if (!session('admin_login')) {
            return redirect('/admin/login');
        }

        $attendances = Attendance::with('intern')
            ->orderBy('attendance_date', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.pdf_absensi', compact('attendances'));

        return $pdf->download('Rekap_Absensi_Internship.pdf');
    }
}