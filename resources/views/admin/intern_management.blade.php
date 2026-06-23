<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Intern Management</title>

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

.title span.eyebrow{
    display:inline-block;
    color:var(--green-700);
    font-weight:600;
    font-size:13px;
    letter-spacing:.4px;
    margin-bottom:6px;
}

.title h1{
    font-size:32px;
    font-weight:800;
    letter-spacing:-.5px;
    color:var(--ink);
    margin-bottom:8px;
}

.title p{
    color:var(--muted);
    font-size:14.5px;
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

/* ================= DATA CARD ================= */

.data-card{
    background:var(--surface);

    padding:30px 32px;

    border-radius:var(--r-xl);

    box-shadow:var(--shadow-sm);
    border:1px solid var(--border);

    animation:riseIn .4s ease both;
}

.data-card .top{
    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-bottom:22px;
    gap:12px;
    flex-wrap:wrap;
}

.data-card .top h2{
    color:var(--ink);
    font-size:19px;
    font-weight:700;

    display:flex;
    align-items:center;
    gap:10px;
}

.data-card .top h2 i{
    color:var(--green-700);
}

.btn-primary{
    background:var(--green-700);
    color:white;

    border:none;

    padding:13px 22px;

    border-radius:14px;

    cursor:pointer;

    font-size:14px;
    font-weight:600;
    font-family:'Poppins',sans-serif;

    display:flex;
    align-items:center;
    gap:9px;

    box-shadow:0 10px 20px rgba(23,111,61,.2);

    transition:background .25s ease, transform .15s ease, box-shadow .25s ease;
}

.btn-primary:hover{
    background:var(--green-800);
    transform:translateY(-2px);
    box-shadow:0 14px 26px rgba(23,111,61,.28);
}

.btn-primary:active{
    transform:translateY(0) scale(.98);
}

/* ================= TABLE ================= */

.table-wrap{
    overflow-x:auto;
    border-radius:var(--r-md);
}

table{
    width:100%;
    border-collapse:separate;
    border-spacing:0 10px;
    min-width:820px;
}

th{
    background:var(--green-50);
    color:var(--green-700);

    padding:13px 18px;

    text-align:left;

    font-size:12px;
    font-weight:700;
    letter-spacing:.4px;
    text-transform:uppercase;
}

th:first-child{
    border-radius:14px 0 0 14px;
}

th:last-child{
    border-radius:0 14px 14px 0;
}

td{
    padding:15px 18px;
    background:var(--surface);
    font-size:13.5px;
    color:var(--ink);
    vertical-align:middle;
    border-bottom:1px solid var(--border);
}

tbody tr{
    box-shadow:var(--shadow-sm);
    transition:transform .2s ease, box-shadow .2s ease;
}

tbody tr:hover{
    transform:translateY(-1px);
}

tbody tr:hover td{
    background:var(--green-50);
}

.badge{
    background:var(--green-50);
    color:var(--green-700);
    padding:6px 16px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
}

.action{
    border:none;
    padding:9px 16px;
    color:white;
    border-radius:12px;
    cursor:pointer;
    font-size:12px;
    font-weight:600;
    margin-right:6px;
    font-family:'Poppins',sans-serif;
    transition:background .2s ease, transform .15s ease;
}

.action:active{
    transform:scale(.96);
}

.reset{
    background:var(--amber);
}

.delete{
    background:var(--red);
}

.reset:hover{
    background:#d6860a;
}

.delete:hover{
    background:#c4202f;
}

/* ================= MODAL ================= */

.modal{
    display:none;

    position:fixed;

    inset:0;

    background:rgba(11,30,20,.55);
    backdrop-filter:blur(4px);

    z-index:5000;

    align-items:center;
    justify-content:center;

    padding:20px;
}

.modal.active{
    display:flex;
}

.modal-box{
    background:white;
    width:100%;
    max-width:680px;

    padding:32px;

    border-radius:var(--r-xl);

    box-shadow:0 30px 60px rgba(0,0,0,.25);

    animation:popup .3s ease;
}

.modal-box h3{
    color:var(--ink);
    margin-bottom:22px;
    font-size:20px;
    font-weight:700;

    display:flex;
    align-items:center;
    gap:10px;
}

.modal-box h3 i{
    color:var(--green-700);
}

.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:14px;
}

.grid input{
    padding:13px 16px;

    border:1.5px solid var(--border);

    border-radius:var(--r-sm);

    font-size:14px;
    font-family:'Poppins',sans-serif;

    outline:none;

    background:var(--bg);

    transition:border-color .2s ease, background .2s ease;
}

.grid input:focus{
    border-color:var(--green-600);
    background:#fff;
}

.modal-actions{
    margin-top:22px;
    display:flex;
    gap:12px;
}

.modal-actions button{
    flex:1;

    border:none;

    padding:14px;

    border-radius:var(--r-sm);

    font-weight:600;
    font-size:14px;
    font-family:'Poppins',sans-serif;

    cursor:pointer;

    transition:opacity .2s ease, transform .15s ease, box-shadow .2s ease;
}

.modal-actions button:active{
    transform:scale(.97);
}

.modal-actions .btn-primary{
    flex:1;
    justify-content:center;
}

.btn-cancel{
    background:var(--bg);
    color:var(--muted);
    border:1.5px solid var(--border);
}

.btn-cancel:hover{
    background:#eceeec;
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

    .data-card .top{
        flex-direction:column;
        align-items:stretch;
    }

    .grid{
        grid-template-columns:1fr;
    }

}

/* ================= MOBILE ================= */

@media(max-width:768px){

    .title h1{
        font-size:25px;
    }

    .title p{
        font-size:13px;
    }

    .data-card{
        padding:22px 16px;
        border-radius:24px;
    }

    .modal-box{
        padding:22px;
        border-radius:22px;
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

        <a href="/admin/intern_management" class="active">

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

            <span class="eyebrow"><i class="fa-solid fa-users"></i> Manajemen Peserta</span>

            <h1>Intern Management</h1>

            <p>
                Kelola peserta internship PT Pertamina Geothermal Energy.
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

    <!-- DATA TABLE -->

    <div class="data-card">

        <div class="top">
            <h2><i class="fa-solid fa-id-card"></i> Data Internship</h2>
            <button class="btn-primary" onclick="openModal()">
                <i class="fa-solid fa-plus"></i> Tambah Intern Baru
            </button>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Nama</th><th>Instansi</th><th>Divisi</th>
                        <th>Pembimbing</th><th>Email</th><th>Status</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
@foreach($interns as $intern)
<tr>
    <td>{{ $intern->intern_code }}</td>
    <td>{{ $intern->name }}</td>
    <td>{{ $intern->institution }}</td>
    <td>{{ $intern->division }}</td>
    <td>{{ $intern->mentor }}</td>
    <td>{{ $intern->email }}</td>
    <td>
        <span class="badge">
            {{ $intern->status }}
        </span>
    </td>
   <td>
    <a href="{{ url('/admin/intern/reset/'.$intern->id) }}"
       onclick="return confirm('Reset password menjadi intern123?')">
        <button class="action reset">
            Reset
        </button>
    </a>

    <a href="{{ url('/admin/intern/delete/'.$intern->id) }}"
       onclick="return confirm('Yakin ingin menghapus intern ini?')">
        <button class="action delete">
            Hapus
        </button>
    </a>
</td>
</tr>
@endforeach
</tbody>
            </table>
        </div>

    </div>

</div>

<!-- MODAL -->
<!-- MODAL -->

<div class="modal" id="modal">
  <div class="modal-box">

```
<h3>
  <i class="fas fa-user-plus"></i>
  Tambah Intern Baru
</h3>

<form action="{{ url('/admin/intern/store') }}" method="POST">
  @csrf

  <div class="grid">

    <input
      type="text"
      name="name"
      placeholder="Nama Lengkap"
      required>

    <input
      type="text"
      name="institution"
      placeholder="Instansi"
      required>

    <input
      type="text"
      name="major"
      placeholder="Jurusan">

    <input
      type="text"
      name="division"
      placeholder="Divisi">

    <input
      type="text"
      name="mentor"
      placeholder="Pembimbing">

    <input
      type="text"
      name="phone"
      placeholder="Nomor HP">

    <input
      type="email"
      name="email"
      placeholder="Email"
      required>

    <input
      type="password"
      name="password"
      placeholder="Password"
      required>

    <input
      type="date"
      name="start_date">

    <input
      type="date"
      name="end_date">

  </div>

  <div class="modal-actions">

    <button type="submit" class="btn-primary">
      <i class="fas fa-save"></i> Simpan
    </button>

    <button
      type="button"
      class="btn-cancel"
      onclick="closeModal()">
      Batal
    </button>

  </div>

</form>
```

  </div>
</div>


<script>
function openModal(){
    document.getElementById('modal').classList.add('active');
}

function closeModal(){
    document.getElementById('modal').classList.remove('active');
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