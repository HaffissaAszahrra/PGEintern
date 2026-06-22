<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>

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

    --red-pale:#fde2e2;--red-ink:#dc2626;
    --amber-pale:#fdf1cf;--amber-ink:#c9970d;
    --blue-pale:#dbeafe;--blue-ink:#1d4ed8;

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
    max-width:560px;
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

/* ================= ACTIVITY CARD ================= */

.activity-card{
    background:var(--surface);

    padding:30px 32px;

    border-radius:var(--r-xl);

    box-shadow:var(--shadow-sm);
    border:1px solid var(--border);

    animation:riseIn .4s ease both;
}

.activity-card h2{
    color:var(--ink);
    margin-bottom:20px;
    font-size:19px;
    font-weight:700;
    display:flex;
    align-items:center;
    gap:10px;
}

.activity-card h2 i{
    color:var(--green-700);
    font-size:17px;
}

.activity{
    display:flex;
    gap:16px;
    padding:18px 0;
    border-bottom:1px solid var(--border);
}

.activity:last-child{
    border-bottom:none;
    padding-bottom:0;
}

.activity .act-icon{
    width:46px;
    height:46px;
    border-radius:50%;

    display:flex;
    justify-content:center;
    align-items:center;
    flex-shrink:0;
    font-size:17px;

    background:var(--green-50);
    color:var(--green-700);
}

.activity .act-icon.izin{
    background:var(--amber-pale);
    color:var(--amber-ink);
}

.activity .act-icon.sakit{
    background:var(--blue-pale);
    color:var(--blue-ink);
}

.activity .act-icon.alpha{
    background:var(--red-pale);
    color:var(--red-ink);
}

.activity strong{
    font-size:15px;
    color:var(--ink);
    font-weight:600;
}

.activity small{
    color:var(--muted);
    font-size:13px;
    line-height:1.6;
}

.empty-state{
    color:var(--muted);
    font-size:13.5px;
    padding:18px 0;
    text-align:center;
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

    .activity-card{
        padding:24px 18px;
        border-radius:24px;
    }

    .activity{
        gap:12px;
        padding:14px 0;
    }

    .activity .act-icon{
        width:40px;
        height:40px;
        font-size:15px;
    }

    .activity strong{
        font-size:14px;
    }

    .activity small{
        font-size:12px;
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

        <a href="/admin/dashboard" class="active">

            <i class="fa-solid fa-house"></i>
            Dashboard

        </a>

        <a href="/admin/intern_management">

            <i class="fa-solid fa-users"></i>
            Intern Management

        </a>

        <a href="/admin/rekapabsensi">

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

<!-- ================= MAIN ================= -->

<div class="main">

    <div class="topbar">

        <div class="title">

            <span class="eyebrow"><i class="fa-solid fa-grid-2"></i> Dashboard Admin</span>

            <h1>Selamat Datang, Admin HR 👋</h1>

            <p>
                Berikut adalah ringkasan aktivitas absensi peserta internship terkini. Pantau kehadiran, izin, dan laporan sakit dengan mudah melalui sistem ini.
            </p>

        </div>

        <div class="topbar-right">

            <div class="clock-box">
                <i class="fa-solid fa-clock"></i>
                <div>
                    <div class="clock-time" id="liveClock">00.00.00</div>
                    <div class="clock-date" id="liveDate">-</div>
                </div>
            </div>

            <div class="profile">
                <div class="avatar">A</div>
                <div class="profile-text">
                    <div class="profile-greet">Administrator HR</div>
                    <div class="profile-name">Admin HR</div>
                </div>
            </div>

        </div>

    </div>

    <!-- ACTIVITY -->

    <div class="activity-card">

        <h2><i class="fa-solid fa-bell"></i> Aktivitas Absensi Terbaru</h2>

        @forelse($recentAttendances ?? [] as $att)
        <div class="activity">
            <div class="act-icon
                @if($att->status == 'present') {{ '' }}
                @elseif($att->status == 'permit') izin
                @elseif($att->status == 'sick') sakit
                @else alpha
                @endif
            ">
                @if($att->status == 'present')
                    <i class="fa-solid fa-user-check"></i>
                @elseif($att->status == 'permit')
                    <i class="fa-solid fa-file-alt"></i>
                @else
                    <i class="fa-solid fa-notes-medical"></i>
                @endif
            </div>
            <div>
                <strong>{{ $att->intern->name ?? '-' }}</strong>
                <br>
                <small>
                    @if($att->status == 'present')
                        Melakukan absensi hadir — Check in {{ $att->check_in ?? '-' }}
                    @elseif($att->status == 'permit')
                        Mengajukan izin — {{ $att->reason ?? 'Tidak ada keterangan' }}
                    @elseif($att->status == 'sick')
                        Melaporkan sakit — {{ $att->reason ?? 'Tidak ada keterangan' }}
                    @else
                        Tidak hadir (Alpha)
                    @endif
                    &nbsp;·&nbsp; {{ $att->attendance_date }}
                </small>
            </div>
        </div>
        @empty
        <p class="empty-state">Belum ada aktivitas absensi hari ini.</p>
        @endforelse

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

/* ================= LIVE CLOCK ================= */

function updateLiveClock(){

    const now = new Date();
    const pad = n => String(n).padStart(2,'0');

    document.getElementById('liveClock').textContent = `${pad(now.getHours())}.${pad(now.getMinutes())}.${pad(now.getSeconds())}`;

    const hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'][now.getDay()];
    const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'][now.getMonth()];

    document.getElementById('liveDate').textContent = `${hari}, ${now.getDate()} ${bulan} ${now.getFullYear()}`;

}

updateLiveClock();
setInterval(updateLiveClock, 1000);

</script>

</body>
</html>