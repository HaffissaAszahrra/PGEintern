@php
$nama = session('intern_name') ?? 'Intern';
$hadir = $riwayat->where('status','present')->count();
$izin  = $riwayat->where('status','permit')->count();
$sakit = $riwayat->where('status','sick')->count();
$alpha = $riwayat->where('status','alpha')->count();
$total = $hadir + $izin + $sakit + $alpha;
$persen = $total > 0 ? round(($hadir / $total) * 100) : 0;
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Rekap Absensi</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

html{
scroll-behavior:smooth;
}

:root{
--primary:#176f3d;
--primary-light:#2d8f57;
--primary-pale:#d8f3dc;
--primary-pale-2:#e8f5ee;
--text-dark:#1c2b22;
--text-gray:#667b71;
--bg:#f3f6f4;
--shadow:0 10px 25px rgba(23,111,61,0.07);
}

body{
background:var(--bg);
overflow-x:hidden;
color:var(--text-dark);
}

/* ================= PAGE TRANSITION ================= */

body{
animation:pageFadeIn .35s ease;
}

@keyframes pageFadeIn{
from{
opacity:0;
transform:translateY(8px);
}
to{
opacity:1;
transform:translateY(0);
}
}

a{
-webkit-tap-highlight-color:transparent;
}

/* ================= SIDEBAR ================= */

.sidebar{
position:fixed;
top:0;
left:0;

width:280px;
height:100vh;

background:linear-gradient(180deg,#176f3d 0%,#125c32 100%);

display:flex;
flex-direction:column;

z-index:1000;

transition:left 0.3s ease;
}

.logo{
padding:28px 20px;

display:flex;
justify-content:center;
align-items:center;

min-height:110px;

border-bottom:1px solid rgba(255,255,255,0.08);
}

.logo img{
width:185px;
object-fit:contain;
}

/* MENU */

.menu{
padding:25px 0;
}

.menu-title{
color:#b7e4c7;
font-size:13px;

text-transform:uppercase;
letter-spacing:.5px;

padding:0 25px 15px;
}

.menu a{
display:flex;
align-items:center;
gap:15px;

padding:16px 25px;
margin:0 14px 6px;

text-decoration:none;

color:white;

font-size:16px;
font-weight:500;

border-radius:14px;

transition:background .25s ease, padding-left .25s ease, color .25s ease;
}

.menu a:hover{
background:rgba(255,255,255,0.12);
padding-left:32px;
}

.menu a.active{
background:#d8f3dc;
color:#176f3d;
font-weight:600;
box-shadow:0 6px 14px rgba(0,0,0,0.12);
}

.menu a.active:hover{
padding-left:25px;
}

.menu a i{
width:20px;
text-align:center;
}

/* LOGOUT */

.logout-sidebar{
margin-top:auto;
padding:20px;
}

.logout-sidebar a{
display:flex;
justify-content:center;
align-items:center;
gap:10px;

text-decoration:none;

background:#d8f3dc;
color:#176f3d;

padding:15px;

border-radius:18px;

font-weight:600;

transition:background .25s ease, color .25s ease, transform .25s ease;
}

.logout-sidebar a:hover{
background:white;
transform:translateY(-2px);
}

/* MOBILE */

.mobile-toggle{
display:none;

position:fixed;

top:18px;
left:18px;

width:45px;
height:45px;

border:none;

border-radius:12px;

background:#176f3d;
color:white;

font-size:20px;

z-index:2000;

cursor:pointer;

box-shadow:0 5px 15px rgba(0,0,0,0.15);

transition:background .25s ease, transform .15s ease;
}

.mobile-toggle:active{
transform:scale(.94);
}

/* OVERLAY */

#overlay{
display:none;
position:fixed;
inset:0;
background:rgba(0,0,0,.45);
z-index:999;

opacity:0;
transition:opacity .3s ease;
}

#overlay.show{
display:block;
opacity:1;
}

/* CONTENT */

.content{
margin-left:280px;
padding:35px 40px 45px;
}

/* TOPBAR */

.topbar{
display:flex;
justify-content:space-between;
align-items:flex-start;
gap:20px;

margin-bottom:25px;
flex-wrap:wrap;
}

.eyebrow{
display:inline-flex;
align-items:center;
gap:8px;

color:var(--primary);
font-size:14px;
font-weight:600;

margin-bottom:10px;
}

.topbar h1{
color:var(--text-dark);
font-size:38px;
font-weight:700;
margin-bottom:8px;
}

.topbar p.subtitle{
color:var(--text-gray);
font-size:15.5px;
}

.topbar-right{
display:flex;
align-items:center;
gap:14px;
flex-wrap:wrap;
}

.info-chip{
display:flex;
align-items:center;
gap:12px;

background:white;
padding:12px 18px;
border-radius:18px;

box-shadow:var(--shadow);
}

.chip-icon{
width:38px;
height:38px;
flex-shrink:0;

display:flex;
align-items:center;
justify-content:center;

background:var(--primary-pale-2);
color:var(--primary);

border-radius:12px;
font-size:15px;
}

.avatar{
width:38px;
height:38px;
flex-shrink:0;

display:flex;
align-items:center;
justify-content:center;

background:var(--primary);
color:white;

border-radius:50%;

font-weight:700;
font-size:15px;
}

.chip-main{
font-size:15px;
font-weight:700;
color:var(--text-dark);
line-height:1.25;
}

.chip-sub{
font-size:12px;
color:var(--text-gray);
line-height:1.25;
}

/* STATS */

.stats{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
margin-bottom:25px;
}

.stat{
background:white;
padding:24px;
border-radius:24px;
box-shadow:var(--shadow);
display:flex;
align-items:center;
gap:16px;
transition:transform .25s ease, box-shadow .25s ease;
}

.stat:hover{
transform:translateY(-4px);
box-shadow:0 10px 22px rgba(23,111,61,0.1);
}

.stat .icon-badge{
width:52px;
height:52px;
flex-shrink:0;

display:flex;
align-items:center;
justify-content:center;

border-radius:16px;

font-size:21px;
}

.stat h4{
margin-bottom:6px;
color:var(--text-gray);
font-size:13.5px;
font-weight:500;
}

.stat h2{
font-size:30px;
font-weight:700;
}

.hadir .icon-badge{ background:#dcfce7; color:#16a34a; }
.izin  .icon-badge{ background:#fef9c3; color:#b58a05; }
.sakit .icon-badge{ background:#dbeafe; color:#2563eb; }
.alpha .icon-badge{ background:#fee2e2; color:#dc2626; }

.hadir h2{color:#16a34a;}
.izin h2{color:#b58a05;}
.sakit h2{color:#2563eb;}
.alpha h2{color:#dc2626;}

/* PROGRESS */

.progress-card{
background:white;
padding:28px;
border-radius:24px;
margin-bottom:25px;
box-shadow:var(--shadow);

display:flex;
align-items:center;
gap:22px;
}

.progress-card .icon-badge{
width:56px;
height:56px;
flex-shrink:0;

display:flex;
align-items:center;
justify-content:center;

background:var(--primary-pale);
color:var(--primary);

border-radius:18px;

font-size:23px;
}

.progress-card-body{
flex:1;
}

.progress-card-body h3{
font-size:16px;
font-weight:600;
color:var(--text-dark);
}

.progress-card-body .percent{
color:var(--primary);
font-size:26px;
font-weight:700;
margin-top:4px;
}

.progress{
width:100%;
height:14px;
background:#e5e7eb;
border-radius:50px;
overflow:hidden;
margin-top:12px;
}

.progress-fill{
height:100%;
background:linear-gradient(90deg,#176f3d,#2d8f57);
border-radius:50px;
transition:width 1s ease;
}

/* TABLE */

.table-card{
background:white;
padding:28px;
border-radius:24px;
box-shadow:var(--shadow);
overflow:auto;
}

.table-card-title{
font-size:17px;
font-weight:600;
color:var(--text-dark);
margin-bottom:18px;
display:flex;
align-items:center;
gap:10px;
}

.table-card-title i{
color:var(--primary);
}

table{
width:100%;
border-collapse:collapse;
}

th{
background:var(--primary);
color:white;
padding:14px;
text-align:left;
font-weight:600;
font-size:14px;
}

th:first-child{
border-radius:12px 0 0 12px;
}

th:last-child{
border-radius:0 12px 12px 0;
}

td{
padding:14px;
border-bottom:1px solid #eef2ef;
font-size:14.5px;
}

tr:last-child td{
border-bottom:none;
}

tr:hover td{
background:#f7faf8;
}

.badge{
padding:6px 14px;
border-radius:20px;
font-size:13px;
font-weight:600;
display:inline-block;
}

.badge-hadir{
background:#dcfce7;
color:#166534;
}

.badge-izin{
background:#fef9c3;
color:#854d0e;
}

.badge-sakit{
background:#dbeafe;
color:#1e40af;
}

.badge-alpha{
background:#fee2e2;
color:#991b1b;
}

/* MOBILE CARD */

.mobile-list{
display:none;
}

.absen-card{
background:white;
padding:20px;
border-radius:18px;
margin-bottom:15px;
box-shadow:var(--shadow);
transition:transform .25s ease, box-shadow .25s ease;
}

.absen-card:hover{
transform:translateY(-2px);
box-shadow:0 8px 18px rgba(23,111,61,0.08);
}

.absen-card .absen-date{
display:flex;
align-items:center;
justify-content:space-between;
margin-bottom:12px;
}

.absen-card strong{
font-size:15px;
color:var(--text-dark);
}

.absen-card .absen-row{
display:flex;
justify-content:space-between;
font-size:14px;
color:#555;
padding:4px 0;
}

/* RESPONSIVE */

@media(max-width:900px){

.mobile-toggle{
display:block;
}

.sidebar{
left:-100%;
}

.sidebar.active{
left:0;
}

.content{
margin-left:0;
padding:90px 18px 25px;
}

.topbar{
flex-direction:column;
align-items:flex-start;
gap:18px;
}

.topbar-right{
width:100%;
}

.info-chip{
flex:1;
min-width:150px;
}

.stats{
grid-template-columns:1fr 1fr;
}

.topbar h1{
font-size:30px;
}

.progress-card{
flex-direction:column;
align-items:flex-start;
}

table{
display:none;
}

.mobile-list{
display:block;
}

}
</style>
</head>
<body>

<button class="mobile-toggle" onclick="toggleSidebar()">
<i class="fa-solid fa-bars"></i>
</button>

<div id="overlay" onclick="toggleSidebar()"></div>

<div class="sidebar" id="sidebar">

<div class="logo">
<img src="{{ asset('assets/lg.png') }}">
</div>

<div class="menu">

<div class="menu-title">
Menu
</div>

<a href="/mahasiswa/dashboard">
<i class="fa-solid fa-house"></i>
Dashboard
</a>

<a href="/mahasiswa/absensi">
<i class="fa-solid fa-calendar-check"></i>
Absensi
</a>

<a href="/mahasiswa/riwayat" class="active">
<i class="fa-solid fa-clock-rotate-left"></i>
Riwayat
</a>

</div>

<div class="logout-sidebar">
<a href="/mahasiswa/login">
<i class="fa-solid fa-right-from-bracket"></i>
Logout
</a>
</div>

</div>

<div class="content">

<!-- TOPBAR -->

<div class="topbar">

    <div class="topbar-left">

        <div class="eyebrow">
            <i class="fa-solid fa-clock-rotate-left"></i>
            Riwayat Intern
        </div>

        <h1>Rekap Absensi</h1>

        <p class="subtitle">
            Lihat riwayat dan statistik kehadiran internship Anda.
        </p>

    </div>

    <div class="topbar-right">

        <div class="info-chip">
            <div class="chip-icon">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div>
                <div class="chip-main" id="liveClock">--:--:--</div>
                <div class="chip-sub" id="liveDate">Memuat tanggal...</div>
            </div>
        </div>

        <div class="info-chip">
            <div class="avatar">{{ strtoupper(substr($nama,0,1)) }}</div>
            <div>
                <div class="chip-sub">Intern</div>
                <div class="chip-main">{{ $nama }}</div>
            </div>
        </div>

    </div>

</div>

<div class="stats">

<div class="stat hadir">
<div class="icon-badge"><i class="fa-solid fa-circle-check"></i></div>
<div>
<h4>Hadir</h4>
<h2>{{ $hadir }}</h2>
</div>
</div>

<div class="stat izin">
<div class="icon-badge"><i class="fa-solid fa-file-circle-question"></i></div>
<div>
<h4>Izin</h4>
<h2>{{ $izin }}</h2>
</div>
</div>

<div class="stat sakit">
<div class="icon-badge"><i class="fa-solid fa-kit-medical"></i></div>
<div>
<h4>Sakit</h4>
<h2>{{ $sakit }}</h2>
</div>
</div>

<div class="stat alpha">
<div class="icon-badge"><i class="fa-solid fa-circle-xmark"></i></div>
<div>
<h4>Alpha</h4>
<h2>{{ $alpha }}</h2>
</div>
</div>

</div>

<div class="progress-card">

<div class="icon-badge">
<i class="fa-solid fa-chart-pie"></i>
</div>

<div class="progress-card-body">
<h3>Persentase Kehadiran</h3>
<div class="percent">{{ $persen }}%</div>
<div class="progress">
<div class="progress-fill" style="width:{{ $persen }}%;"></div>
</div>
</div>

</div>

<div class="table-card">

<div class="table-card-title">
<i class="fa-solid fa-table-list"></i>
Detail Riwayat Absensi
</div>

<table>
<thead>
<tr>
<th>Tanggal</th>
<th>Check In</th>
<th>Check Out</th>
<th>Status</th>
<th>Keterangan</th>
</tr>
</thead>
<tbody>
@foreach($riwayat as $item)
<tr>
<td>{{ date('d M Y', strtotime($item->attendance_date)) }}</td>
<td>{{ $item->check_in ?? '-' }}</td>
<td>{{ $item->check_out ?? '-' }}</td>
<td>
@if($item->status == 'present')
<span class="badge badge-hadir">Hadir</span>
@elseif($item->status == 'permit')
<span class="badge badge-izin">Izin</span>
@elseif($item->status == 'sick')
<span class="badge badge-sakit">Sakit</span>
@else
<span class="badge badge-alpha">Alpha</span>
@endif
</td>
<td style="color:#888;font-size:13px;">{{ $item->reason ?? '—' }}</td>
</tr>
@endforeach
</tbody>
</table>

</div>

<div class="mobile-list">

@foreach($riwayat as $item)
<div class="absen-card">

<div class="absen-date">
<strong>{{ date('d M Y', strtotime($item->attendance_date)) }}</strong>
@if($item->status == 'present')
<span class="badge badge-hadir">Hadir</span>
@elseif($item->status == 'permit')
<span class="badge badge-izin">Izin</span>
@elseif($item->status == 'sick')
<span class="badge badge-sakit">Sakit</span>
@else
<span class="badge badge-alpha">Alpha</span>
@endif
</div>

<div class="absen-row"><span>Check In</span><span>{{ $item->check_in ?? '-' }}</span></div>
<div class="absen-row"><span>Check Out</span><span>{{ $item->check_out ?? '-' }}</span></div>

@if($item->reason)
<small style="color:#888;margin-top:8px;display:block;">{{ $item->reason }}</small>
@endif

</div>
@endforeach

</div>

</div>

<script>

function toggleSidebar(){

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    sidebar.classList.toggle("active");
    overlay.classList.toggle("show");

}

/* LIVE CLOCK */

function updateClock(){

    const now = new Date();

    const time = now.toLocaleTimeString('id-ID', { hour:'2-digit', minute:'2-digit', second:'2-digit' });
    const date = now.toLocaleDateString('id-ID', { weekday:'long', day:'2-digit', month:'long', year:'numeric' });

    const clockEl = document.getElementById('liveClock');
    const dateEl = document.getElementById('liveDate');

    if(clockEl) clockEl.textContent = time;
    if(dateEl) dateEl.textContent = date;

}

updateClock();
setInterval(updateClock, 1000);

/* SMOOTH PAGE TRANSITION ON NAVIGATION */

document.querySelectorAll('a[href^="/"]').forEach(link => {

    link.addEventListener('click', function(e){

        const href = this.getAttribute('href');

        if(!href || href.startsWith('#')) return;

        e.preventDefault();

        document.body.style.transition = 'opacity .25s ease, transform .25s ease';
        document.body.style.opacity = '0';
        document.body.style.transform = 'translateY(8px)';

        setTimeout(() => {
            window.location.href = href;
        }, 220);

    });

});

</script>

</body>
</html>