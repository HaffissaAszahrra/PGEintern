<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
class AttendanceController extends Controller
{
    public function checkIn(Request $request)
{
    $internId = session('intern_id');

    $today = date('Y-m-d');

    $attendance = Attendance::where('intern_id', $internId)
        ->where('attendance_date', $today)
        ->first();

    if ($attendance) {
        return response()->json([
            'message' => 'Kamu sudah Check In hari ini'
        ]);
    }

    $selfiePath = null;

    if ($request->foto) {

        $image = $request->foto;

        $image = str_replace(
            'data:image/png;base64,',
            '',
            $image
        );

        $image = str_replace(' ', '+', $image);

        $imageName = 'selfie_' .
            time() .
            '_' .
            $internId .
            '.png';

        \Storage::disk('public')->put(
            'selfie/' . $imageName,
            base64_decode($image)
        );

        $selfiePath = 'selfie/' . $imageName;
    }

    Attendance::create([
        'intern_id' => $internId,
        'attendance_date' => $today,
        'check_in' => date('H:i:s'),
        'status' => 'present',
        'selfie_photo' => $selfiePath
    ]);

    return response()->json([
        'message' => 'Check In berhasil'
    ]);
}
    public function checkOut()
{
    $internId = session('intern_id');

    $today = date('Y-m-d');

    $attendance = Attendance::where('intern_id', $internId)
        ->where('attendance_date', $today)
        ->first();

    if (!$attendance) {
        return response()->json([
            'message' => 'Kamu belum Check In hari ini.'
        ]);
    }

    if ($attendance->check_out) {
        return response()->json([
            'message' => 'Kamu sudah Check Out.'
        ]);
    }

    $attendance->update([
        'check_out' => date('H:i:s')
    ]);

    return response()->json([
        'message' => 'Check Out berhasil!'
    ]);
}
public function izin(Request $request)
{
    $internId = session('intern_id');

    $today = date('Y-m-d');

    $attendance = Attendance::where('intern_id', $internId)
        ->where('attendance_date', $today)
        ->first();

    if ($attendance) {
        return response()->json([
            'message' => 'Data absensi hari ini sudah ada'
        ]);
    }

    Attendance::create([
        'intern_id' => $internId,
        'attendance_date' => $today,
        'status' => 'permit',
        'reason' => $request->reason
    ]);

    return response()->json([
        'message' => 'Izin berhasil'
    ]);
}
public function sakit(Request $request)
{
    $internId = session('intern_id');

    $today = date('Y-m-d');

    $attendance = Attendance::where('intern_id', $internId)
        ->where('attendance_date', $today)
        ->first();

    if ($attendance) {
        return response()->json([
            'message' => 'Data absensi hari ini sudah ada'
        ]);
    }

    $filePath = null;

    if ($request->hasFile('document')) {

        $filePath = $request->file('document')
            ->store('surat_dokter', 'public');
    }

    Attendance::create([
        'intern_id' => $internId,
        'attendance_date' => $today,
        'status' => 'sick',
        'reason' => $request->reason,
        'supporting_document' => $filePath
    ]);

    return response()->json([
        'message' => 'Data sakit berhasil dikirim'
    ]);
}
}