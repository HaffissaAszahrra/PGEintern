@php
$nama = session('intern_name') ?? 'Intern';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Mahasiswa</title>

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

@keyframes wave{
    0%,60%,100%{ transform:rotate(0deg); }
    10%{ transform:rotate(14deg); }
    20%{ transform:rotate(-8deg); }
    30%{ transform:rotate(14deg); }
    40%{ transform:rotate(-4deg); }
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

    transition:background .25s ease, padding-left .25s ease, color .25s ease, transform .2s ease;
}

.menu a:hover{
    background:rgba(255,255,255,0.12);
    padding-left:30px;
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

/* MOBILE BUTTON */

.mobile-toggle{
    display:none;

    position:fixed;

    top:18px;
    left:18px;

    width:45px;
    height:45px;

    border:none;

    background:#176f3d;
    color:white;

    border-radius:12px;

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

/* MAIN */

.main{
    margin-left:280px;
    padding:35px 40px 45px;
}

/* TOPBAR */

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:20px;

    margin-bottom:28px;
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

.topbar h1 .wave{
    display:inline-block;
    animation:wave 2.2s infinite;
    transform-origin:70% 70%;
}

.topbar > .topbar-left > p.subtitle{
    color:var(--text-gray);
    font-size:15.5px;
}

/* TOPBAR RIGHT - INFO CHIPS */

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

/* ================= WELCOME ================= */

.welcome-card{
    background:white;

    border-radius:30px;

    padding:42px;

    box-shadow:var(--shadow);

    position:relative;

    overflow:hidden;
}

.welcome-card::before{
    content:'';

    position:absolute;

    width:300px;
    height:300px;

    background:radial-gradient(circle,rgba(23,111,61,0.06),rgba(23,111,61,0) 70%);

    border-radius:50%;

    top:-130px;
    right:-130px;
}

.welcome-content{
    position:relative;
    z-index:2;
}

.welcome-badge{
    display:inline-flex;
    align-items:center;
    gap:10px;

    background:var(--primary-pale-2);

    color:var(--primary);

    padding:10px 18px;

    border-radius:50px;

    font-size:14px;
    font-weight:600;

    margin-bottom:25px;
}

.welcome-content h2{
    color:var(--primary);
    font-size:34px;
    font-weight:700;

    margin-bottom:18px;

    line-height:1.3;
}

.welcome-content p{
    color:#555;

    font-size:16px;

    line-height:1.9;

    max-width:850px;
}

/* MINI INFO */

.quick-info{
    margin-top:35px;

    display:grid;
    grid-template-columns:repeat(3,1fr);

    gap:20px;
}

.quick-card{
    background:#f7faf8;

    border:1px solid #edf2ef;

    padding:24px;

    border-radius:22px;

    display:flex;
    flex-direction:column;
    gap:14px;

    transition:transform .25s ease, box-shadow .25s ease, border-color .25s ease;
}

.quick-card:hover{
    transform:translateY(-4px);
    box-shadow:0 10px 22px rgba(23,111,61,0.1);
    border-color:transparent;
}

.quick-card .icon-badge{
    width:48px;
    height:48px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:var(--primary-pale);
    color:var(--primary);

    border-radius:14px;

    font-size:20px;
}

.quick-card h4{
    color:var(--text-dark);
    font-size:17px;
    font-weight:600;
}

.quick-card p{
    color:var(--text-gray);
    font-size:14px;
    line-height:1.8;
}

/* ================= RESPONSIVE ================= */

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

    .quick-info{
        grid-template-columns:1fr;
    }

}

@media(max-width:768px){

    .topbar h1{
        font-size:30px;
    }

    .topbar p.subtitle{
        font-size:14px;
        line-height:1.7;
    }

    .welcome-card{
        padding:26px 22px;
        border-radius:25px;
    }

    .welcome-content h2{
        font-size:25px;
        line-height:1.5;
    }

    .welcome-content p{
        font-size:14px;
        line-height:1.9;
    }

    .quick-card{
        padding:20px;
    }

}

</style>
</head>

<body>

<!-- MOBILE TOGGLE -->

<button class="mobile-toggle" onclick="toggleSidebar()">
<i class="fa-solid fa-bars"></i>
</button>

<div id="overlay" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->

<div class="sidebar" id="sidebar">

    <div class="logo">
        <img src="{{ asset('assets/lg.png') }}">
    </div>

    <div class="menu">

        <div class="menu-title">
            Menu 
        </div>

        <a href="/mahasiswa/dashboard" class="active">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="/mahasiswa/absensi">
            <i class="fa-solid fa-calendar-check"></i>
            Absensi
        </a>

        <a href="/mahasiswa/riwayat">
            <i class="fa-solid fa-clock-rotate-left"></i>
            Riwayat
        </a>

    </div>

    <div class="logout-sidebar">

<a href="/mahasiswa/logout">
    <i class="fa-solid fa-right-from-bracket"></i>
    Logout
</a>

    </div>

</div>

<!-- MAIN -->

<div class="main">


<!-- TOPBAR -->

    <div class="topbar">

        <div class="topbar-left">

            <div class="eyebrow">
                <i class="fa-solid fa-house"></i>
                Dashboard Intern
            </div>

            <h1>Halo, {{ $nama }} <span class="wave">👋</span></h1>

            <p class="subtitle">
                Semoga harimu menyenangkan dan produktif
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

    <!-- WELCOME -->


    <div class="welcome-card">

        <div class="welcome-content">

            <div class="welcome-badge">

                <i class="fa-solid fa-building"></i>
                Pertamina Geothermal Energy

            </div>

            <h2>
                Selamat Datang di Dashboard Internship 👋
            </h2>

            <p>
                Dashboard ini digunakan untuk membantu proses absensi,
                monitoring kehadiran, serta aktivitas internship harian Anda
                selama program magang berlangsung.
                <br><br>

                Pastikan melakukan check-in dan check-out tepat waktu,
                serta gunakan menu riwayat untuk melihat data kehadiran
                yang telah tercatat di sistem.
            </p>

            <!-- QUICK INFO -->

            <div class="quick-info">

                <div class="quick-card">

                    <div class="icon-badge">
                        <i class="fa-solid fa-clock"></i>
                    </div>

                    <h4>Jam Kerja</h4>

                    <p>
                        Senin - Jumat<br>
                        07:00 WIB - 16:00 WIB
                    </p>

                </div>

                <div class="quick-card">

                    <div class="icon-badge">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>

                    <h4>Absensi Harian</h4>

                    <p>
                        Lakukan check-in dan check-out
                        setiap hari kerja sesuai jadwal.
                    </p>

                </div>

                <div class="quick-card">

                    <div class="icon-badge">
                        <i class="fa-solid fa-user-check"></i>
                    </div>

                    <h4>Status Internship</h4>

                    <p>
                        Internship aktif dan berjalan
                        sesuai periode magang perusahaan.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

/* SIDEBAR MOBILE */

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