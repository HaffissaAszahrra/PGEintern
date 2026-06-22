<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

body{
    font-family: DejaVu Sans;
    font-size:12px;
}

h2{
    text-align:center;
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th,
table td{
    border:1px solid #000;
    padding:6px;
    text-align:left;
}

table th{
    background:#e5e5e5;
}

</style>

</head>
<body>

<h2>
REKAP ABSENSI INTERNSHIP
</h2>

<table>

<thead>

<tr>
<th>No</th>
<th>Nama</th>
<th>Tanggal</th>
<th>Check In</th>
<th>Check Out</th>
<th>Status</th>
</tr>

</thead>

<tbody>

@foreach($attendances as $index => $attendance)

<tr>

<td>{{ $index+1 }}</td>

<td>
{{ $attendance->intern->name ?? '-' }}
</td>

<td>
{{ $attendance->attendance_date }}
</td>

<td>
{{ $attendance->check_in ?? '-' }}
</td>

<td>
{{ $attendance->check_out ?? '-' }}
</td>

<td>
{{ ucfirst($attendance->status) }}
</td>

</tr>

@endforeach

</tbody>

</table>

</body>
</html>