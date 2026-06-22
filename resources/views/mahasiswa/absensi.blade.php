<?php

session_start();

$nama = session('intern_name') ?? 'Intern';

$inisial = strtoupper(substr($nama, 0, 1));

/* ===== Info tanggal & sapaan (server-side, ditampilkan modern di topbar) ===== */
$hariIndo = [
    'Sunday'    => 'Minggu',
    'Monday'    => 'Senin',
    'Tuesday'   => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday'  => 'Kamis',
    'Friday'    => 'Jumat',
    'Saturday'  => 'Sabtu',
];

$bulanIndo = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
];

$tanggalHariIni = $hariIndo[date('l')] . ', ' . date('d') . ' ' . $bulanIndo[(int) date('n')] . ' ' . date('Y');

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Absensi Intern</title>

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
    margin-top:auto;
    padding:20px;
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

    margin-bottom:32px;
}

.title span.eyebrow{
    display:inline-block;
    color:var(--green-700);
    font-weight:600;
    font-size:13px;
    letter-spacing:.4px;
    margin-bottom:6px;
}

.title h1{
    font-size:34px;
    font-weight:800;
    letter-spacing:-.5px;
    color:var(--ink);
    margin-bottom:8px;
}

.title p{
    color:var(--muted);
    font-size:15px;
}

.topbar-right{
    display:flex;
    align-items:center;
    gap:14px;
}

.clock-box{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:18px;
    padding:12px 20px;
    box-shadow:var(--shadow-sm);

    display:flex;
    align-items:center;
    gap:12px;
}

.clock-box i{
    color:var(--green-700);
    font-size:18px;
}

.clock-box .clock-time{
    font-size:18px;
    font-weight:700;
    color:var(--ink);
    font-variant-numeric:tabular-nums;
    line-height:1.1;
}

.clock-box .clock-date{
    font-size:12px;
    color:var(--muted);
    line-height:1.1;
}

.profile{
    display:flex;
    align-items:center;
    gap:12px;

    background:var(--surface);
    border:1px solid var(--border);
    border-radius:18px;
    padding:10px 18px 10px 10px;
    box-shadow:var(--shadow-sm);
}

.profile .avatar{
    width:42px;
    height:42px;
    border-radius:50%;
    background:linear-gradient(160deg,var(--green-600),var(--green-800));
    color:#fff;
    font-weight:700;
    font-size:16px;

    display:flex;
    align-items:center;
    justify-content:center;
}

.profile .profile-text{
    line-height:1.25;
}

.profile .profile-greet{
    font-size:11px;
    color:var(--muted);
}

.profile .profile-name{
    font-size:14px;
    font-weight:600;
    color:var(--ink);
}

/* ================= INFO CARD ================= */

.info-magang{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));

    gap:20px;

    margin-bottom:28px;
}

.info-card{
    background:var(--surface);

    padding:24px;

    border-radius:var(--r-lg);

    box-shadow:var(--shadow-sm);
    border:1px solid var(--border);

    display:flex;
    gap:16px;
    align-items:flex-start;

    animation:riseIn .4s ease both;

    transition:transform .25s ease, box-shadow .25s ease;
}

.info-card:hover{
    transform:translateY(-3px);
    box-shadow:var(--shadow-md);
}

.info-card .info-icon{
    flex-shrink:0;
    width:46px;
    height:46px;
    border-radius:14px;
    background:var(--green-50);
    color:var(--green-700);

    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}

.info-card h3{
    color:var(--ink);
    margin-bottom:6px;
    font-size:16px;
    font-weight:600;
}

.info-card p{
    color:var(--muted);
    line-height:1.6;
    font-size:14px;
}

/* ================= ABSENSI ================= */

.absensi-card{
    background:var(--surface);

    padding:38px;

    border-radius:var(--r-xl);

    box-shadow:var(--shadow-sm);
    border:1px solid var(--border);

    margin-bottom:28px;
}

.absensi-header{
    text-align:center;
    margin-bottom:32px;
}

.absensi-header h2{
    color:var(--ink);
    font-size:28px;
    font-weight:700;
    margin-bottom:8px;
}

.absensi-header p{
    color:var(--muted);
    font-size:14px;
}

/* BUTTON */

.absensi-buttons{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
}

.absen-btn{
    border:none;

    border-radius:var(--r-lg);

    padding:30px 22px;

    color:white;

    cursor:pointer;

    text-align:left;

    display:flex;
    flex-direction:column;
    align-items:flex-start;
    gap:2px;

    position:relative;
    overflow:hidden;

    box-shadow:0 10px 22px rgba(0,0,0,.10);

    transition:transform .25s ease, box-shadow .25s ease;
}

.absen-btn:hover{
    transform:translateY(-4px);
    box-shadow:var(--shadow-btn);
}

.absen-btn:active{
    transform:translateY(-1px) scale(.98);
}

.absen-btn .icon-wrap{
    width:52px;
    height:52px;
    border-radius:16px;
    background:rgba(255,255,255,.18);

    display:flex;
    align-items:center;
    justify-content:center;

    margin-bottom:16px;
}

.absen-btn i{
    font-size:24px;
}

.absen-btn h3{
    font-size:20px;
    font-weight:700;
    letter-spacing:.3px;
    margin-bottom:4px;
}

.absen-btn p{
    font-size:13px;
    opacity:0.85;
}

/* COLORS */

.checkin{
    background:linear-gradient(150deg,var(--green-600),var(--green-800));
}

.checkout{
    background:linear-gradient(150deg,#ef4060,var(--red));
}

.izin{
    background:linear-gradient(150deg,#ffb648,var(--amber));
}

.sakit{
    background:linear-gradient(150deg,#4d92ff,var(--blue));
}

/* ================= STATUS ================= */

.status-box{
    background:var(--surface);

    padding:30px 32px;

    border-radius:var(--r-lg);

    box-shadow:var(--shadow-sm);
    border:1px solid var(--border);
}

.status-title{
    font-size:18px;
    font-weight:700;
    color:var(--ink);

    margin-bottom:18px;

    display:flex;
    align-items:center;
    gap:10px;
}

.status-title i{
    color:var(--green-700);
    font-size:16px;
}

.status-item{
    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:16px 0;

    border-bottom:1px solid var(--border);
}

.status-item:last-child{
    border-bottom:none;
}

.status-label{
    display:flex;
    align-items:center;
    gap:10px;

    color:var(--muted);
    font-size:14px;
}

.status-label i{
    width:18px;
    text-align:center;
    color:var(--green-600);
    font-size:14px;
}

.status-value{
    color:var(--green-700);
    font-weight:700;
    font-size:14px;

    background:var(--green-50);
    padding:7px 16px;
    border-radius:999px;
}

/* ================= MODAL ================= */

.modal{
    display:none;

    position:fixed;

    left:0;
    top:0;

    width:100%;
    height:100%;

    background:rgba(11,30,20,.55);
    backdrop-filter:blur(4px);

    justify-content:center;
    align-items:center;

    z-index:5000;

    padding:20px;
}

.modal-content{
    background:white;

    width:100%;
    max-width:480px;

    border-radius:var(--r-xl);

    padding:32px;

    box-shadow:0 30px 60px rgba(0,0,0,.25);

    animation:popup 0.3s ease;
}

@keyframes popup{

    from{
        transform:scale(0.92);
        opacity:0;
    }

    to{
        transform:scale(1);
        opacity:1;
    }

}

.modal-content h2{
    color:var(--ink);
    font-size:20px;
    font-weight:700;
    margin-bottom:22px;
}

.modal-content input,
.modal-content textarea{
    width:100%;

    padding:14px 16px;

    border-radius:var(--r-sm);

    border:1.5px solid var(--border);

    outline:none;

    margin-bottom:18px;

    font-family:'Poppins',sans-serif;
    font-size:14px;

    background:var(--bg);

    transition:border-color .2s ease, background .2s ease;
}

.modal-content input:focus,
.modal-content textarea:focus{
    border-color:var(--green-600);
    background:#fff;
}

.modal-content textarea{
    height:110px;
    resize:none;
}

.modal-buttons{
    display:flex;
    gap:12px;
}

.modal-buttons button{
    flex:1;

    border:none;

    padding:14px;

    border-radius:var(--r-sm);

    font-weight:600;
    font-size:14px;

    cursor:pointer;

    font-family:'Poppins',sans-serif;

    transition:opacity .2s ease, transform .15s ease, box-shadow .2s ease;
}

.modal-buttons button:active{
    transform:scale(.97);
}

.submit-btn{
    background:var(--green-700);
    color:white;
    box-shadow:0 10px 20px rgba(23,111,61,.25);
}

.submit-btn:hover{
    background:var(--green-800);
}

.cancel-btn{
    background:var(--bg);
    color:var(--muted);
    border:1.5px solid var(--border);
}

.cancel-btn:hover{
    background:#eceeec;
}

/* CAMERA */

#camera,
#preview{
    width:100%;

    border-radius:18px;

    margin-bottom:18px;

    border:1.5px solid var(--border);

    display:none;
}

/* ================= TABLET ================= */

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

    .main{
        margin-left:0;
        padding:80px 18px 30px;
    }

    .topbar{
        flex-direction:column;
        align-items:stretch;
        gap:18px;
    }

    .topbar-right{
        position:fixed;
        top:14px;
        right:14px;
        z-index:1500;
        display:flex;
        flex-direction:column;
        align-items:flex-end;
        gap:6px;
        width:auto;
    }

    .profile{
        flex-direction:row;
        justify-content:flex-end;
        align-items:center;
        text-align:right;
        padding:7px 10px 7px 8px;
        gap:8px;
        border-radius:14px;
        background:var(--surface);
        border:1px solid var(--border);
        box-shadow:var(--shadow-sm);
        width:auto;
    }

    .profile .avatar{
        width:32px;
        height:32px;
        font-size:13px;
    }

    .profile .profile-text{
        text-align:right;
    }

    .profile .profile-greet{
        font-size:9px;
    }

    .profile .profile-name{
        font-size:12px;
    }

    .clock-box{
        flex-direction:row;
        justify-content:flex-end;
        align-items:center;
        text-align:right;
        padding:6px 10px;
        gap:7px;
        border-radius:12px;
        background:var(--surface);
        border:1px solid var(--border);
        box-shadow:var(--shadow-sm);
        width:auto;
    }

    .clock-box i{
        font-size:13px;
    }

    .clock-box .clock-time{
        font-size:13px;
    }

    .clock-box .clock-date{
        font-size:9px;
    }

    .info-magang{
        grid-template-columns:1fr 1fr 1fr;
        gap:10px;
        margin-bottom:24px;
    }

    .info-card{
        flex-direction:column;
        align-items:center;
        text-align:center;
        padding:16px 8px;
        gap:8px;
        border-radius:16px;
    }

    .info-card .info-icon{
        width:36px;
        height:36px;
        border-radius:11px;
        font-size:15px;
    }

    .info-card h3{
        font-size:11.5px;
        margin-bottom:2px;
        line-height:1.3;
    }

    .info-card p{
        font-size:10px;
        line-height:1.35;
    }

    .absensi-buttons{
        grid-template-columns:1fr 1fr;
        gap:16px;
    }

    .absen-btn{
        padding:24px 18px;
        border-radius:22px;
    }

    .absen-btn .icon-wrap{
        width:44px;
        height:44px;
        margin-bottom:12px;
    }

    .absen-btn i{
        font-size:20px;
    }

    .absen-btn h3{
        font-size:17px;
    }

    .absen-btn p{
        font-size:12px;
    }

}

/* ================= MOBILE ================= */

@media(max-width:768px){

    .title h1{
        font-size:26px;
    }

    .title p{
        font-size:13px;
        line-height:1.6;
    }

    .absensi-card{
        padding:24px 18px;
        border-radius:24px;
    }

    .absensi-header{
        margin-bottom:24px;
    }

    .absensi-header h2{
        font-size:21px;
        line-height:1.4;
    }

    .absensi-header p{
        font-size:13px;
    }

    .absensi-buttons{
        grid-template-columns:1fr 1fr;
        gap:14px;
    }

    .absen-btn{
        padding:20px 12px;
        border-radius:20px;
        min-height:160px;

        justify-content:center;
        align-items:center;
        text-align:center;
    }

    .absen-btn .icon-wrap{
        margin-bottom:10px;
    }

    .absen-btn h3{
        font-size:15px;
    }

    .absen-btn p{
        font-size:11px;
        line-height:1.4;
    }

    .info-card{
        padding:14px 6px;
    }

    .status-box{
        padding:22px 20px;
    }

    .status-item{
        flex-direction:column;
        align-items:flex-start;
        gap:8px;
    }

    .modal-content{
        padding:22px;
        border-radius:22px;
    }

}

/* ================= SMALL MOBILE ================= */

@media(max-width:480px){

    .absensi-buttons{
        gap:12px;
    }

    .absen-btn{
        min-height:140px;
    }

    .absen-btn h3{
        font-size:14px;
    }

    .clock-box .clock-time{
        font-size:12px;
    }

    .clock-box .clock-date{
        font-size:8.5px;
    }

    .profile .profile-name{
        font-size:11.5px;
    }

    .info-magang{
        gap:8px;
    }

    .info-card{
        padding:12px 4px;
        gap:6px;
        border-radius:14px;
    }

    .info-card .info-icon{
        width:32px;
        height:32px;
        font-size:13px;
    }

    .info-card h3{
        font-size:10.5px;
    }

    .info-card p{
        font-size:9px;
        line-height:1.3;
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

        <a href="/mahasiswa/absensi" class="active">

            <i class="fa-solid fa-calendar-check"></i>
            Absensi

        </a>

       <a href="/mahasiswa/riwayat">

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

<!-- ================= MAIN ================= -->

<div class="main">

    <div class="topbar">

        <div class="title">

            <span class="eyebrow"><?= htmlspecialchars($sapaan) ?>, <?= htmlspecialchars($nama) ?> 👋</span>

            <h1>Absensi Intern</h1>

            <p>
                Lakukan absensi sesuai kondisi kehadiran hari ini
            </p>

        </div>

        <div class="topbar-right">

            <div class="clock-box">
                <i class="fa-solid fa-clock"></i>
                <div>
                    <div class="clock-time" id="liveClock">--:--:--</div>
                    <div class="clock-date"><?= htmlspecialchars($tanggalHariIni) ?></div>
                </div>
            </div>

            <div class="profile">
                <div class="avatar"><?= htmlspecialchars($inisial) ?></div>
                <div class="profile-text">
                    <div class="profile-greet">Intern</div>
                    <div class="profile-name"><?= htmlspecialchars($nama) ?></div>
                </div>
            </div>

        </div>

    </div>

    <!-- INFO -->

    <div class="info-magang">

        <div class="info-card">

            <div class="info-icon"><i class="fa-solid fa-calendar-days"></i></div>

            <div>
                <h3>Tanggal Magang</h3>
                <p>
                    01 Mei 2026 - 31 Agustus 2026
                </p>
            </div>

        </div>

        <div class="info-card">

            <div class="info-icon"><i class="fa-solid fa-clock"></i></div>

            <div>
                <h3>Jam Kerja</h3>
                <p>
                    07:00 WIB - 16:00 WIB
                </p>
            </div>

        </div>

        <div class="info-card">

            <div class="info-icon"><i class="fa-solid fa-circle-check"></i></div>

            <div>
                <h3>Status Magang</h3>
                <p>
                    Aktif
                </p>
            </div>

        </div>

    </div>

    <!-- ABSENSI -->

    <div class="absensi-card">

        <div class="absensi-header">

            <h2>Status Kehadiran Hari Ini</h2>

            <p>
                Pilih jenis absensi yang ingin dilakukan
            </p>

        </div>

        <div class="absensi-buttons">

            <!-- CHECK IN -->

            <button class="absen-btn checkin"
            onclick="openModal('checkin')">

                <div class="icon-wrap"><i class="fa-solid fa-camera"></i></div>

                <h3>CHECK IN</h3>

                <p>Masuk kerja hari ini</p>

            </button>

            <!-- CHECK OUT -->

            <button class="absen-btn checkout"
            onclick="openModal('checkout')">

                <div class="icon-wrap"><i class="fa-solid fa-camera-rotate"></i></div>

                <h3>CHECK OUT</h3>

                <p>Selesai aktivitas kerja</p>

            </button>

            <!-- IZIN -->

            <button class="absen-btn izin"
            onclick="openModal('izin')">

                <div class="icon-wrap"><i class="fa-solid fa-envelope"></i></div>

                <h3>IZIN</h3>

                <p>Ajukan izin tidak hadir</p>

            </button>

            <!-- SAKIT -->

            <button class="absen-btn sakit"
            onclick="openModal('sakit')">

                <div class="icon-wrap"><i class="fa-solid fa-notes-medical"></i></div>

                <h3>SAKIT</h3>

                <p>Upload surat dokter</p>

            </button>

        </div>

    </div>

    <!-- STATUS -->

    <div class="status-box">

        <div class="status-title">
            <i class="fa-solid fa-list-check"></i>
            Informasi Kehadiran
        </div>

        <div class="status-item">

            <div class="status-label">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                Jam Masuk
            </div>

            <div class="status-value"
            id="jamMasuk">

                -

            </div>

        </div>

        <div class="status-item">

            <div class="status-label">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Jam Keluar
            </div>

            <div class="status-value"
            id="jamKeluar">

                -

            </div>

        </div>

        <div class="status-item">

            <div class="status-label">
                <i class="fa-solid fa-calendar-day"></i>
                Status Hari Ini
            </div>

            <div class="status-value"
            id="statusKehadiran">

                Belum Absensi

            </div>

        </div>

    </div>

</div>

<!-- ================= MODAL ================= -->

<div class="modal"
id="modalAbsensi">

    <div class="modal-content">

        <h2 id="modalTitle">
            Absensi
        </h2>

        <video id="camera"
        autoplay
        playsinline></video>

        <canvas id="canvas"
        style="display:none;"></canvas>

        <img id="preview">

        <input type="file"
        id="fileInput">

<textarea
id="reason"
placeholder="Masukkan alasan izin"
style="width:100%;height:100px;">
</textarea>

        <div class="modal-buttons">

            <button class="submit-btn"
            onclick="capturePhoto()"
            id="captureBtn"
            style="display:none;">

                Ambil Foto

            </button>

            <button class="submit-btn"
            onclick="submitAbsensi()">

                Submit

            </button>

            <button class="cancel-btn"
            onclick="closeModal()">

                Batal

            </button>

        </div>

    </div>

</div>

<script>

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

/* MODAL */

let currentAction = "";
let stream;

async function openModal(action){

    currentAction = action;

    document.getElementById("modalAbsensi")
    .style.display = "flex";

    document.getElementById("fileInput")
    .style.display = "block";

    document.getElementById("reason")
    .style.display = "none";

    document.getElementById("camera")
    .style.display = "none";

    document.getElementById("preview")
    .style.display = "none";

    document.getElementById("captureBtn")
    .style.display = "none";

    if(action == "checkin"){

        document.getElementById("modalTitle")
        .innerHTML = "Selfie Check In";

        document.getElementById("fileInput")
        .style.display = "none";

        startCamera();

    }

    else if(action == "checkout"){

        document.getElementById("modalTitle")
        .innerHTML = "Selfie Check Out";

        document.getElementById("fileInput")
        .style.display = "none";

        startCamera();

    }

    else if(action == "izin"){

        document.getElementById("modalTitle")
        .innerHTML = "Form Izin";

        document.getElementById("fileInput")
        .style.display = "none";

        document.getElementById("reason")
        .style.display = "block";

    }

    else if(action == "sakit"){

        document.getElementById("modalTitle")
        .innerHTML = "Upload Surat Dokter";

        document.getElementById("reason")
        .style.display = "block";

    }

}

/* CAMERA */

async function startCamera(){

    const video =
    document.getElementById("camera");

    try{

        stream =
        await navigator.mediaDevices.getUserMedia({

            video:{
                facingMode:"user"
            }

        });
        console.log(video);
        video.srcObject = stream;

        video.style.display = "block";

        document.getElementById("captureBtn")
        .style.display = "block";

    } catch(err){

        console.log(err);

        alert("Kamera tidak dapat diakses. Silakan unggah foto selfie secara manual.");

        // fallback: tampilkan input file agar user tetap bisa absen
        document.getElementById("fileInput")
        .style.display = "block";

    }

}

/* CAPTURE */

function capturePhoto(){

    const video =
    document.getElementById("camera");

    const canvas =
    document.getElementById("canvas");

    const preview =
    document.getElementById("preview");

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    const ctx = canvas.getContext("2d");

    ctx.drawImage(video,0,0);

    preview.src =
    canvas.toDataURL("image/png");

    preview.style.display = "block";

    video.style.display = "none";

    document.getElementById("captureBtn")
    .style.display = "none";

    stream.getTracks()
    .forEach(track => track.stop());

}

/* CLOSE */

function closeModal(){

    document.getElementById("modalAbsensi")
    .style.display = "none";

    if(stream){

        stream.getTracks()
        .forEach(track => track.stop());

    }

}

/* SUBMIT */

function submitAbsensi(){

    let now = new Date();

    let jam =
    now.getHours().toString().padStart(2,'0')
    + ":" +
    now.getMinutes().toString().padStart(2,'0');

if(currentAction == "checkin"){

    const canvas = document.getElementById("canvas");
    const preview = document.getElementById("preview");
    const fileInput = document.getElementById("fileInput");

    function kirimCheckin(photoData){

        fetch('/mahasiswa/checkin', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            },
            body: JSON.stringify({ foto: photoData, jam: jam })
        })
        .then(response => response.json())
        .then(data => {

            let now = new Date();

            let jam =
            now.getHours().toString().padStart(2,'0')
            + ":" +
            now.getMinutes().toString().padStart(2,'0');

            document.getElementById("jamMasuk")
            .innerHTML = jam + " WIB";

            document.getElementById("statusKehadiran")
            .innerHTML = "Hadir";

            alert(data.message);

            closeModal();

        })
        .catch(error => {
            alert("Gagal Check In");
            console.log(error);
        });

    }
console.log(fileInput.files);
console.log(fileInput.files[0]);
    if(preview.style.display === "block" && preview.src){

        // foto dari kamera
        kirimCheckin(canvas.toDataURL("image/png"));

    } else if(fileInput.files && fileInput.files[0]){

        // fallback: foto dari file upload
        const reader = new FileReader();
        reader.onload = function(e){
            kirimCheckin(e.target.result);
        };
        reader.readAsDataURL(fileInput.files[0]);

    } else {

        alert("Harap ambil foto selfie terlebih dahulu!");

    }

}

else if(currentAction == "checkout"){

    const canvas = document.getElementById("canvas");
    const preview = document.getElementById("preview");
    const fileInput = document.getElementById("fileInput");

    function kirimCheckout(photoData){

        fetch('/mahasiswa/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            },
            body: JSON.stringify({ foto: photoData, jam: jam })
        })
        .then(response => response.json())
        .then(data => {

            let now = new Date();

            let jam =
            now.getHours().toString().padStart(2,'0')
            + ":" +
            now.getMinutes().toString().padStart(2,'0');

            document.getElementById("jamKeluar")
                .innerHTML = jam + " WIB";

            document.getElementById("statusKehadiran")
                .innerHTML = "Check Out";

            alert("Check Out berhasil!");

            closeModal();

        })
        .catch(error => {
            alert("Gagal Check Out");
            console.log(error);
        });

    }

    if(preview.style.display === "block" && preview.src){

        // foto dari kamera
        kirimCheckout(canvas.toDataURL("image/png"));

    } else if(fileInput.files && fileInput.files[0]){

        // fallback: foto dari file upload
        const reader = new FileReader();
        reader.onload = function(e){
            kirimCheckout(e.target.result);
        };
        reader.readAsDataURL(fileInput.files[0]);

    } else {

        alert("Harap ambil foto selfie terlebih dahulu!");

    }

}

else if(currentAction == "izin"){

    let reason =
        document.getElementById("reason").value;

    fetch('/mahasiswa/izin', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        },
        body: JSON.stringify({
            reason: reason
        })
    })
    .then(response => response.json())
    .then(data => {

        document.getElementById("statusKehadiran")
            .innerHTML = "Izin";

        alert("Izin berhasil dikirim!");

        closeModal();

    })
    .catch(error => {
        console.log(error);
        alert("Gagal mengirim izin");
    });

}

   else if(currentAction == "sakit"){

    let reason =
        document.getElementById("reason").value;

    let file =
        document.getElementById("fileInput").files[0];

    let formData = new FormData();

    formData.append("reason", reason);
    formData.append("document", file);

    fetch('/mahasiswa/sakit', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {

        document.getElementById("statusKehadiran")
            .innerHTML = "Sakit";

        alert("Surat dokter berhasil dikirim!");

        closeModal();

    })
    .catch(error => {

        console.log(error);

        alert("Gagal mengirim data sakit");

    });

}

} // END submitAbsensi()

/* ================= LIVE CLOCK (kosmetik, tidak mengubah fungsi absensi) ================= */

function updateLiveClock(){

    const el = document.getElementById("liveClock");

    if(!el) return;

    const now = new Date();

    const jam =
    now.getHours().toString().padStart(2,'0') + ":" +
    now.getMinutes().toString().padStart(2,'0') + ":" +
    now.getSeconds().toString().padStart(2,'0');

    el.innerHTML = jam;

}

updateLiveClock();
setInterval(updateLiveClock, 1000);

</script>

</body>
</html>