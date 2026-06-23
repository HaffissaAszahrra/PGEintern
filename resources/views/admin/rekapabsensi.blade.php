@php

$bulanDipilih = date('n');
$tahunDipilih = date('Y');

$totalHari = 31;
$namaBulan = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
];

@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Rekap Absensi Internship</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

/* ================= RESET & TOKENS ================= */

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
    --green-900:#0b4023;
    --green-800:#125c30;
    --green-700:#176f3d;
    --green-600:#1f8a4d;
    --green-500:#2d8f57;
    --green-100:#d8f3dc;
    --green-50:#eef9f1;

    --bg:#f3f7f5;
    --surface:#ffffff;
    --ink:#1c2a22;
    --muted:#6b7d74;
    --border:#e7eee9;

    --red:#e0274e;
    --amber:#f5a524;
    --blue:#2f7cf6;

    --green-pale:#dcfce7;--green-ink:#15803d;
    --amber-pale:#fef9c3;--amber-ink:#a16207;
    --blue-pale:#dbeafe;--blue-ink:#1d4ed8;
    --red-pale:#fee2e2;--red-ink:#b91c1c;

    --r-sm:14px;
    --r-md:20px;
    --r-lg:28px;
    --r-xl:32px;

    --shadow-sm:0 4px 14px rgba(15,61,38,.06);
    --shadow-md:0 10px 28px rgba(15,61,38,.10);
    --shadow-btn:0 14px 30px rgba(0,0,0,.14);
}

body{
    background:var(--bg);
    color:var(--ink);
    overflow-x:hidden;
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

@keyframes riseIn{
    from{
        opacity:0;
        transform:translateY(10px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

@media (prefers-reduced-motion: reduce){
    *{
        animation-duration:0.001ms !important;
        transition-duration:0.001ms !important;
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

    background:linear-gradient(175deg,var(--green-700) 0%,var(--green-900) 100%);

    display:flex;
    flex-direction:column;

    z-index:1000;

    box-shadow:6px 0 24px rgba(11,64,35,.12);

    transition:left 0.3s ease;
}

.logo{
    padding:30px 20px;

    display:flex;
    justify-content:center;
    align-items:center;

    min-height:110px;

    border-bottom:1px solid rgba(255,255,255,0.1);
}

.logo img{
    width:175px;
    object-fit:contain;
    filter:drop-shadow(0 4px 10px rgba(0,0,0,.15));
}

/* MENU */

.menu{
    padding:24px 0;
    display:flex;
    flex-direction:column;
    gap:4px;
    flex:1;
    min-height:0;
    overflow-y:auto;
}

.menu-title{
    color:rgba(216,243,220,.75);
    font-size:12px;
    font-weight:600;

    text-transform:uppercase;
    letter-spacing:1px;

    padding:0 28px 16px;
}

.menu a{
    display:flex;
    align-items:center;
    gap:14px;

    margin:0 16px;
    padding:14px 16px;

    border-radius:14px;

    text-decoration:none;

    color:rgba(255,255,255,.85);

    font-size:15px;
    font-weight:500;

    transition:background .25s ease, color .25s ease, transform .2s ease;
}

.menu a i{
    width:20px;
    text-align:center;
    font-size:16px;
}

.menu a:hover{
    background:rgba(255,255,255,.1);
    color:#fff;
    transform:translateX(3px);
}

.menu a.active{
    background:var(--green-50);
    color:var(--green-700);
    font-weight:600;
    box-shadow:var(--shadow-sm);
}

.menu a.active:hover{
    transform:none;
    background:#fff;
}

/* LOGOUT */

.logout-sidebar{
    flex-shrink:0;
    padding:20px;
    border-top:1px solid rgba(255,255,255,0.1);
}

.logout-sidebar a{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:10px;

    text-decoration:none;

    background:rgba(255,255,255,.95);
    color:var(--green-700);

    padding:15px;

    border-radius:16px;

    font-weight:600;
    font-size:15px;

    box-shadow:0 8px 18px rgba(0,0,0,.12);

    transition:background .25s ease, color .25s ease, transform .25s ease;
}

.logout-sidebar a:hover{
    background:#fff;
    transform:translateY(-2px);
}

/* ================= MOBILE BUTTON ================= */

.mobile-toggle{
    display:none;

    position:fixed;

    top:18px;
    left:18px;

    width:46px;
    height:46px;

    border:none;

    background:var(--green-700);
    color:white;

    border-radius:14px;

    font-size:19px;

    z-index:2000;

    cursor:pointer;

    box-shadow:0 8px 18px rgba(11,64,35,.25);

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
    background:rgba(11,30,20,.5);
    backdrop-filter:blur(2px);
    z-index:999;

    opacity:0;
    transition:opacity .3s ease;
}

#overlay.show{
    display:block;
    opacity:1;
}

/* ================= MAIN ================= */

.main{
    margin-left:280px;
    padding:36px 40px 50px;
    max-width:1280px;
}

/* ================= TOPBAR ================= */

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    flex-wrap:wrap;
    gap:20px;

    margin-bottom:28px;
}

.topbar-left h1{
    font-size:32px;
    font-weight:800;
    letter-spacing:-.5px;
    color:var(--ink);
    margin-bottom:10px;
}

.month-badge{
    background:var(--green-700);
    color:white;
    padding:7px 16px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
    letter-spacing:.3px;
    display:inline-block;
}

.top-right{
    display:flex;
    align-items:center;
    gap:12px;
    flex-wrap:wrap;
}

.filter-box{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:14px;
    padding:11px 18px;
    box-shadow:var(--shadow-sm);

    display:flex;
    align-items:center;
    gap:10px;
}

.filter-box i{
    color:var(--green-700);
    font-size:14px;
}

.filter-box select{
    border:none;
    outline:none;
    background:none;
    font-size:13.5px;
    cursor:pointer;
    color:var(--ink);
    font-weight:500;
    font-family:'Poppins',sans-serif;
}

.export-btn{
    background:var(--red);
    color:white;
    border:none;
    padding:13px 20px;
    border-radius:14px;
    font-weight:600;
    cursor:pointer;
    font-size:13.5px;
    font-family:'Poppins',sans-serif;
    text-decoration:none;

    display:flex;
    align-items:center;
    gap:9px;

    box-shadow:0 10px 20px rgba(224,39,78,.2);

    transition:background .25s ease, transform .15s ease, box-shadow .25s ease;
}

.export-btn:hover{
    background:#c61f42;
    transform:translateY(-2px);
    box-shadow:0 14px 26px rgba(224,39,78,.28);
}

/* ================= TABLE CARD ================= */

.table-wrapper{
    background:var(--surface);

    padding:30px 32px;

    border-radius:var(--r-xl);

    box-shadow:var(--shadow-sm);
    border:1px solid var(--border);

    animation:riseIn .4s ease both;
}

.table-header{
    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-bottom:20px;
    flex-wrap:wrap;
    gap:14px;
}

.table-header h2{
    font-size:19px;
    color:var(--ink);
    font-weight:700;

    display:flex;
    align-items:center;
    gap:10px;
}

.table-header h2 i{
    color:var(--green-700);
}

.search-box{
    display:flex;
    align-items:center;
    gap:10px;

    background:var(--bg);

    padding:11px 18px;

    border-radius:14px;

    border:1.5px solid var(--border);

    width:280px;

    transition:border-color .2s ease, background .2s ease;
}

.search-box:has(input:focus){
    border-color:var(--green-600);
    background:#fff;
}

.search-box input{
    border:none;
    outline:none;
    background:none;
    width:100%;
    font-size:13.5px;
    font-family:'Poppins',sans-serif;
}

.search-box i{
    color:var(--muted);
    font-size:13px;
}

/* ================= TABLE ================= */

table.main-table{
    width:100%;
    border-collapse:separate;
    border-spacing:0 8px;
    table-layout:fixed;
}

table.main-table th{
    background:var(--green-50);
    padding:13px 14px;
    font-size:11px;
    text-align:left;
    color:var(--green-700);
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.4px;
    white-space:nowrap;
}

table.main-table th:first-child{
    border-radius:12px 0 0 12px;
}

table.main-table th:last-child{
    border-radius:0 12px 12px 0;
}

table.main-table td{
    padding:13px 14px;
    background:var(--surface);
    border-bottom:1px solid var(--border);
    font-size:13px;
    color:var(--ink);
    vertical-align:middle;
}

table.main-table tbody tr{
    box-shadow:var(--shadow-sm);
    transition:transform .2s ease;
}

table.main-table tbody tr:hover{
    transform:translateY(-1px);
}

table.main-table tbody tr:hover td{
    background:var(--green-50);
}

/* Column widths */
.col-no{width:46px;text-align:center;}
.col-id{width:90px;}
.col-nama{width:22%;}
.col-divisi{width:80px;text-align:center;}
.col-tanggal{width:110px;text-align:center;}
.col-checkin{width:88px;text-align:center;}
.col-checkout{width:88px;text-align:center;}
.col-status{width:90px;text-align:center;}
.col-selfie{width:72px;text-align:center;}
.col-surat{width:72px;text-align:center;}
.col-ket{width:auto;}

/* ===== USER CELL ===== */
.user-info{
    display:flex;
    align-items:center;
    gap:11px;
}

.avatar{
    width:38px;
    height:38px;
    border-radius:50%;
    background:linear-gradient(160deg,var(--green-600),var(--green-800));

    display:flex;
    align-items:center;
    justify-content:center;

    color:white;
    font-weight:700;
    font-size:14px;
    flex-shrink:0;
}

.user-detail strong{
    display:block;
    font-size:13px;
    color:var(--ink);
    font-weight:600;
}

.user-detail small{
    color:var(--muted);
    font-size:11.5px;
}

/* ===== STATUS BADGE ===== */
.badge{
    display:inline-block;
    padding:5px 13px;
    border-radius:999px;
    font-size:11.5px;
    font-weight:700;
    letter-spacing:.2px;
}

.badge-hadir{background:var(--green-pale);color:var(--green-ink);}
.badge-izin{background:var(--amber-pale);color:var(--amber-ink);}
.badge-sakit{background:var(--blue-pale);color:var(--blue-ink);}
.badge-alpha{background:var(--red-pale);color:var(--red-ink);}

/* ===== ACTION LINKS ===== */
.link-photo{
    display:inline-flex;
    align-items:center;
    gap:6px;

    background:var(--green-700);
    color:white;

    padding:6px 12px;

    border-radius:10px;

    text-decoration:none;

    font-size:11.5px;
    font-weight:600;
    font-family:'Poppins',sans-serif;

    border:none;
    cursor:pointer;

    transition:background .2s ease;
}

.link-photo:hover{
    background:var(--green-800);
}

.link-doc{
    display:inline-flex;
    align-items:center;
    gap:6px;

    background:var(--blue);
    color:white;

    padding:6px 12px;

    border-radius:10px;

    text-decoration:none;

    font-size:11.5px;
    font-weight:600;

    transition:background .2s ease;
}

.link-doc:hover{
    background:#1d63d6;
}

.text-muted{
    color:#cbd5d1;
    font-size:13px;
}

/* ================= MODAL ================= */

.attendance-modal,
.selfie-modal{
    position:fixed;
    inset:0;

    background:rgba(11,30,20,.55);
    backdrop-filter:blur(4px);

    display:none;

    justify-content:center;
    align-items:center;

    z-index:99999;

    padding:20px;
}

.attendance-modal.active,
.selfie-modal.active{
    display:flex;
}

.attendance-content{
    background:white;
    width:100%;
    max-width:480px;
    border-radius:var(--r-xl);
    overflow:hidden;
    box-shadow:0 30px 60px rgba(0,0,0,.25);
    animation:popup .3s ease;
}

@keyframes popup{
    from{transform:scale(.92);opacity:0;}
    to{transform:scale(1);opacity:1;}
}

.attendance-header{
    padding:20px 24px;
    background:linear-gradient(135deg,var(--green-700),var(--green-900));
    color:white;

    display:flex;
    justify-content:space-between;
    align-items:center;
}

.attendance-header h2{
    font-size:17px;
    font-weight:700;
}

.close-modal{
    background:rgba(255,255,255,.15);
    border:none;
    width:32px;
    height:32px;
    border-radius:50%;
    font-size:20px;
    color:white;
    cursor:pointer;
    line-height:1;
    transition:background .2s ease;
}

.close-modal:hover{
    background:rgba(255,255,255,.28);
}

.attendance-body{
    padding:24px;
}

.detail-card{
    background:var(--bg);
    padding:18px;
    border-radius:16px;
    margin-bottom:10px;
}

.detail-card h3{
    margin-bottom:10px;
    font-size:15px;
    font-weight:700;
}

.detail-card p{
    font-size:13px;
    color:var(--muted);
    margin-bottom:5px;
}

.documentation{
    width:100%;
    border-radius:14px;
    margin-top:12px;
}

/* ===== SELFIE MODAL ===== */
.selfie-content{
    background:white;
    width:100%;
    max-width:460px;

    border-radius:var(--r-xl);
    overflow:hidden;

    box-shadow:0 30px 60px rgba(0,0,0,.3);

    animation:popup .3s ease;
}

.selfie-header{
    padding:20px 24px;
    background:linear-gradient(135deg,var(--green-700),var(--green-900));
    color:white;

    display:flex;
    justify-content:space-between;
    align-items:center;
}

.selfie-body{
    padding:22px 24px 12px;
}

/* ================= TABLET ================= */

@media(max-width:960px){

    .mobile-toggle{
        display:block;
    }

    .sidebar{
        left:-100%;
    }

    .sidebar.active{
        left:0;
    }

    .main{
        margin-left:0;
        padding:80px 16px 28px;
    }

    .topbar{
        flex-direction:column;
        align-items:flex-start;
    }

    .topbar-left h1{
        font-size:24px;
    }

    .top-right{
        width:100%;
        flex-direction:column;
        align-items:stretch;
    }

    .filter-box,
    .export-btn{
        width:100%;
        justify-content:center;
    }

    .search-box{
        width:100%;
    }

    .table-wrapper{
        padding:20px 16px;
        border-radius:24px;
    }

    table.main-table{
        display:block;
        overflow-x:auto;
    }

    table.main-table th,
    table.main-table td{
        white-space:nowrap;
    }

}

</style>
</head>
<body>

<!-- MOBILE BUTTON -->

<button class="mobile-toggle"
onclick="toggleSidebar()">

<i class="fa-solid fa-bars"></i>

</button>

<div id="overlay" onclick="toggleSidebar()"></div>

<!-- ================= SIDEBAR ================= -->

<div class="sidebar" id="sidebar">

    <div class="logo">
        <img src="{{ asset('assets/lg.png') }}" alt="Logo PGE">
    </div>

    <div class="menu">

        <div class="menu-title">
            Main Menu
        </div>

        <a href="/admin/dashboard">

            <i class="fa-solid fa-house"></i>
            Dashboard

        </a>

        <a href="/admin/intern_management">

            <i class="fa-solid fa-users"></i>
            Intern Management

        </a>

        <a href="/admin/rekapabsensi" class="active">

            <i class="fa-solid fa-calendar-check"></i>
            Rekap Absensi

        </a>

    </div>

    <div class="logout-sidebar">

        <a href="/admin/login">

            <i class="fa-solid fa-right-from-bracket"></i>
            Logout

        </a>

    </div>

</div>

<div class="main">

  {{-- TOPBAR --}}
  <div class="topbar">
    <div class="topbar-left">
      <h1>Rekap Absensi Internship</h1>
      <div class="month-badge">
        Bulan Aktif : <?= $namaBulan[$bulanDipilih] . ' ' . $tahunDipilih ?>
      </div>
    </div>
    <div class="top-right">
      <div class="filter-box">
        <i class="fas fa-calendar-alt"></i>
        <select onchange="window.location.href='?bulan='+this.value">
          @foreach($namaBulan as $key => $bulan)
          <option value="{{ $key }}" {{ $bulanDipilih == $key ? 'selected' : '' }}>{{ $bulan }}</option>
          @endforeach
        </select>
      </div>
<a href="/admin/export-pdf" class="export-btn">
    <i class="fas fa-file-pdf"></i> Download PDF
</a>
    </div>
  </div>

  {{-- TABLE --}}
  <div class="table-wrapper">
    <div class="table-header">
      <h2><i class="fa-solid fa-calendar-check"></i> Rekap Kehadiran Peserta Internship</h2>
      <div class="search-box">
        <i class="fas fa-magnifying-glass"></i>
        <input type="text" id="searchInput" placeholder="Cari peserta internship...">
      </div>
    </div>

    <table class="main-table">
      <thead>
        <tr>
          <th class="col-no">No</th>
          <th class="col-id">ID Intern</th>
          <th class="col-nama">Nama Intern</th>
          <th class="col-divisi">Divisi</th>
          <th class="col-tanggal">Tanggal</th>
          <th class="col-checkin">Check In</th>
          <th class="col-checkout">Check Out</th>
          <th class="col-status">Status</th>
          <th class="col-selfie">Selfie</th>
          <th class="col-surat">Surat</th>
          <th class="col-ket">Keterangan</th>
        </tr>
      </thead>
      <tbody>

        @foreach($attendances as $index => $attendance)
        <tr class="intern-row">

          <td class="col-no" style="text-align:center;color:#9ca3af;font-weight:600;">{{ $index + 1 }}</td>

          <td class="col-id">
            <span style="font-family:monospace;font-size:12px;background:var(--bg);padding:4px 10px;border-radius:8px;color:var(--ink);">
              {{ $attendance->intern->intern_code ?? '-' }}
            </span>
          </td>

          <td class="col-nama">
            <div class="user-info">
              <div class="avatar">
                {{ strtoupper(substr($attendance->intern->name ?? 'A', 0, 1)) }}
              </div>
              <div class="user-detail">
                <strong>{{ $attendance->intern->name ?? '-' }}</strong>
                <small>Mentor : {{ $attendance->intern->mentor ?? '-' }}</small>
              </div>
            </div>
          </td>

          <td class="col-divisi" style="text-align:center;">
            <span style="font-size:12px;font-weight:600;color:var(--ink);">{{ $attendance->intern->division ?? '-' }}</span>
          </td>

          <td class="col-tanggal" style="text-align:center;font-size:12.5px;color:var(--muted);">
            {{ $attendance->attendance_date }}
          </td>

          <td class="col-checkin" style="text-align:center;font-size:12.5px;font-weight:600;color:var(--ink);">
            {{ $attendance->check_in ?? '-' }}
          </td>

          <td class="col-checkout" style="text-align:center;font-size:12.5px;font-weight:600;color:var(--ink);">
            {{ $attendance->check_out ?? '-' }}
          </td>

          <td class="col-status" style="text-align:center;">
            @if($attendance->status == 'present')
              <span class="badge badge-hadir">Hadir</span>
            @elseif($attendance->status == 'permit')
              <span class="badge badge-izin">Izin</span>
            @elseif($attendance->status == 'sick')
              <span class="badge badge-sakit">Sakit</span>
            @else
              <span class="badge badge-alpha">Alpha</span>
            @endif
          </td>

          <td class="col-selfie" style="text-align:center;">
            @if($attendance->selfie_photo)
              <button onclick="openSelfieModal('{{ asset('storage/'.$attendance->selfie_photo) }}','{{ $attendance->intern->name ?? '' }}','{{ $attendance->check_in ?? '' }}')" class="link-photo" style="border:none;cursor:pointer;">
                <i class="fas fa-camera"></i> Lihat
              </button>
            @else
              <span class="text-muted">—</span>
            @endif
          </td>

          <td class="col-surat" style="text-align:center;">
            @if($attendance->supporting_document)
              <button onclick="openDocModal('{{ asset('storage/'.$attendance->supporting_document) }}','{{ $attendance->intern->name ?? '' }}')" class="link-doc" style="border:none;cursor:pointer;">
                <i class="fas fa-file-alt"></i> Buka
              </button>
            @else
              <span class="text-muted">—</span>
            @endif
          </td>

          <td class="col-ket" style="font-size:12.5px;color:var(--muted);">
            {{ $attendance->reason ?? '—' }}
          </td>

        </tr>
        @endforeach

      </tbody>
    </table>

  </div>
</div>

<!-- MODAL -->
<div class="attendance-modal" id="attendanceModal">
  <div class="attendance-content">
    <div class="attendance-header">
      <h2>Detail Kehadiran</h2>
      <button class="close-modal" onclick="closeModal()">×</button>
    </div>
    <div class="attendance-body" id="attendanceBody"></div>
  </div>
</div>

<!-- SELFIE MODAL -->
<div class="selfie-modal" id="selfieModal">
  <div class="selfie-content">
    <div class="selfie-header">
      <div>
        <span style="font-size:11px;opacity:.7;text-transform:uppercase;letter-spacing:1px;">Bukti Dokumentasi Kehadiran</span>
        <h2 id="selfieModalName" style="font-size:17px;margin-top:2px;"></h2>
      </div>
      <button class="close-modal" onclick="closeSelfieModal()">×</button>
    </div>
    <div class="selfie-body">
      <!-- Info jam masuk & status telat -->
      <div id="selfieAttendanceInfo" style="display:flex;align-items:center;gap:12px;background:var(--bg);border-radius:14px;padding:14px 16px;margin-bottom:14px;">
        <div style="flex:1;">
          <div style="font-size:11px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Jam Masuk</div>
          <div id="selfieCheckIn" style="font-size:22px;font-weight:800;color:var(--ink);font-variant-numeric:tabular-nums;margin-top:2px;">—</div>
        </div>
        <div id="selfieBadgeTelat" style="padding:8px 16px;border-radius:999px;font-size:12px;font-weight:700;letter-spacing:.3px;"></div>
      </div>
      <img id="selfieModalImg" src="" alt="Foto Selfie" style="width:100%;border-radius:14px;display:block;">
    </div>
    <div style="padding:16px 24px 22px;">
      <button onclick="closeSelfieModal()" style="width:100%;padding:13px;background:var(--green-700);color:white;border:none;border-radius:14px;font-size:14px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:background .2s ease;">
        <i class="fas fa-arrow-left"></i> Kembali ke Rekap Absensi
      </button>
    </div>
  </div>
</div>

<!-- DOCUMENT MODAL (Surat Dokter) -->
<div class="selfie-modal" id="docModal">
  <div class="selfie-content" style="max-width:520px;">
    <div class="selfie-header">
      <div>
        <span style="font-size:11px;opacity:.7;text-transform:uppercase;letter-spacing:1px;">Surat Dokter</span>
        <h2 id="docModalName" style="font-size:17px;margin-top:2px;"></h2>
      </div>
      <button class="close-modal" onclick="closeDocModal()">×</button>
    </div>
    <div class="selfie-body" style="padding:22px 24px 12px;">
      <div id="docPreviewWrap" style="width:100%;min-height:340px;border-radius:14px;overflow:hidden;background:#f3f4f6;display:flex;align-items:center;justify-content:center;">
        <!-- iframe for PDF, img for image -->
      </div>
    </div>
    <div style="padding:16px 24px 22px;display:flex;gap:10px;">
      <a id="docDownloadLink" href="#" target="_blank" style="flex:1;padding:13px;background:var(--blue);color:white;border:none;border-radius:14px;font-size:13px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;text-decoration:none;transition:background .2s ease;">
        <i class="fas fa-external-link-alt"></i> Buka di Tab Baru
      </a>
      <button onclick="closeDocModal()" style="flex:1;padding:13px;background:var(--green-700);color:white;border:none;border-radius:14px;font-size:13px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:background .2s ease;">
        <i class="fas fa-arrow-left"></i> Kembali ke Rekap Absensi
      </button>
    </div>
  </div>
</div>

<script>
// ----- SEARCH -----
document.getElementById('searchInput').addEventListener('keyup',function(){
  const kw=this.value.toLowerCase();
  document.querySelectorAll('.intern-row').forEach(row=>{
    row.style.display=row.innerText.toLowerCase().includes(kw)?'':'none';
  });
});

// ----- MODAL (attendance detail - legacy) -----
function openModal(status){
  document.getElementById('attendanceModal').classList.add('active');
}
function closeModal(){
  document.getElementById('attendanceModal').classList.remove('active');
}

// ----- SELFIE MODAL -----
function openSelfieModal(url, name, checkIn){
  document.getElementById('selfieModal').classList.add('active');
  document.getElementById('selfieModalImg').src = url;
  document.getElementById('selfieModalName').textContent = name;

  // Jam masuk & status telat
  const checkInEl = document.getElementById('selfieCheckIn');
  const badgeEl   = document.getElementById('selfieBadgeTelat');

  if(checkIn && checkIn !== ''){
    checkInEl.textContent = checkIn + ' WIB';

    // Parse jam & menit dari format HH:MM atau HH:MM:SS
    const parts = checkIn.split(':');
    const jam   = parseInt(parts[0], 10);
    const menit = parseInt(parts[1], 10);
    const totalMenit = jam * 60 + menit;

    // Tidak telat: 07:15 s/d 07:59 (07:60 tidak valid, jadi 07:59)
    // Telat: >= 08:00
    const batasTelat = 8 * 60; // 08:00

    if(totalMenit < batasTelat){
      badgeEl.textContent = '✓ Tidak Telat';
      badgeEl.style.background = 'var(--green-pale)';
      badgeEl.style.color = 'var(--green-ink)';
    } else {
      badgeEl.textContent = '⚠ Telat';
      badgeEl.style.background = 'var(--red-pale)';
      badgeEl.style.color = 'var(--red-ink)';
    }
  } else {
    checkInEl.textContent = '—';
    badgeEl.textContent = '';
    badgeEl.style.background = 'transparent';
  }
}

function closeSelfieModal(){
  document.getElementById('selfieModal').classList.remove('active');
  document.getElementById('selfieModalImg').src = '';
}

// ----- DOCUMENT MODAL (Surat Dokter) -----
function openDocModal(url, name){
  document.getElementById('docModal').classList.add('active');
  document.getElementById('docModalName').textContent = name;
  document.getElementById('docDownloadLink').href = url;

  const wrap = document.getElementById('docPreviewWrap');
  wrap.innerHTML = '';

  const ext = url.split('?')[0].split('.').pop().toLowerCase();

  if(ext === 'pdf'){
    // Tampilkan PDF dalam iframe
    const iframe = document.createElement('iframe');
    iframe.src = url;
    iframe.style.cssText = 'width:100%;height:420px;border:none;border-radius:14px;';
    wrap.appendChild(iframe);
  } else if(['jpg','jpeg','png','gif','webp'].includes(ext)){
    // Tampilkan gambar
    const img = document.createElement('img');
    img.src = url;
    img.alt = 'Surat Dokter';
    img.style.cssText = 'width:100%;border-radius:14px;display:block;';
    wrap.appendChild(img);
  } else {
    // Fallback: tampilkan link
    wrap.innerHTML = '<div style="text-align:center;padding:40px;"><i class="fas fa-file-alt" style="font-size:48px;color:var(--muted);margin-bottom:16px;display:block;"></i><p style="color:var(--muted);font-size:14px;">Format file tidak dapat dipreview.<br>Gunakan tombol "Buka di Tab Baru".</p></div>';
  }
}

function closeDocModal(){
  document.getElementById('docModal').classList.remove('active');
  document.getElementById('docPreviewWrap').innerHTML = '';
}

/* SIDEBAR */
function toggleSidebar(){
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    sidebar.classList.toggle("active");
    overlay.classList.toggle("show");
}

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