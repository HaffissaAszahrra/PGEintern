<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Intern — GeoIntern PGE</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',sans-serif;}

body{
  min-height:100vh;
  background:#eef2f7;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:20px;
  opacity:0;
  animation:fadeIn .4s ease forwards;
}
@keyframes fadeIn{to{opacity:1;}}

.login-card{
  background:white;
  border-radius:28px;
  box-shadow:0 8px 40px rgba(0,0,0,.10);
  display:flex;
  width:100%;
  max-width:960px;
  min-height:580px;
  overflow:hidden;
}

/* LEFT */
.panel-left{
  width:44%;
  background:#176f3d;
  padding:50px 44px;
  display:flex;
  flex-direction:column;
  justify-content:space-between;
  position:relative;
  overflow:hidden;
}
.panel-left::before{
  content:'';position:absolute;
  width:260px;height:260px;border-radius:50%;
  border:40px solid rgba(255,255,255,.06);
  bottom:-60px;left:-70px;
}
.panel-left::after{
  content:'';position:absolute;
  width:160px;height:160px;border-radius:50%;
  border:28px solid rgba(255,255,255,.07);
  top:30px;right:-50px;
}

.panel-left .logo img{width:160px;max-width:100%;}

.panel-left .tagline h2{
  color:white;font-size:26px;font-weight:700;
  margin-bottom:12px;line-height:1.3;
}
.panel-left .tagline p{
  color:rgba(255,255,255,.7);font-size:13.5px;line-height:1.7;
}

.steps{margin-top:24px;display:flex;flex-direction:column;gap:12px;}
.step-item{display:flex;align-items:center;gap:12px;}
.step-num{
  width:28px;height:28px;border-radius:50%;
  background:rgba(255,255,255,.15);color:white;
  font-size:12px;font-weight:700;
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.step-text{color:rgba(255,255,255,.75);font-size:13px;}

/* RIGHT */
.panel-right{
  width:56%;padding:52px 50px;
  display:flex;flex-direction:column;justify-content:center;
}

.panel-right .top-link{align-self:flex-end;margin-bottom:24px;margin-top:-20px;}
.panel-right .top-link a{
  font-size:13px;color:#176f3d;text-decoration:none;
  background:#edf7f1;padding:8px 18px;border-radius:20px;
  font-weight:600;transition:background .2s;
}
.panel-right .top-link a:hover{background:#d6eede;}

.role-badge{
  display:inline-block;background:#e8f5fe;color:#1565c0;
  font-size:12px;font-weight:600;padding:5px 14px;
  border-radius:20px;letter-spacing:.5px;
  margin-bottom:14px;text-transform:uppercase;
}

.panel-right h1{color:#111;font-size:30px;font-weight:700;margin-bottom:6px;}
.panel-right .subtitle{color:#888;font-size:14px;margin-bottom:30px;line-height:1.6;}

.error-box{
  background:#fff0f0;color:#c0392b;
  border:1px solid #f5c6c6;
  padding:12px 16px;border-radius:12px;
  font-size:13.5px;margin-bottom:18px;
}

.field{margin-bottom:16px;}
.field label{
  display:block;font-size:12.5px;font-weight:600;
  color:#555;margin-bottom:7px;letter-spacing:.3px;
}
.field input{
  width:100%;padding:14px 18px;
  border:1.5px solid #e2e5ea;border-radius:12px;
  font-size:14.5px;outline:none;color:#222;
  background:#fafbfc;transition:border .2s,background .2s;
}
.field input:focus{border-color:#176f3d;background:white;}
.field input::placeholder{color:#bbb;}

.btn-login{
  width:100%;padding:15px;
  background:#176f3d;color:white;border:none;
  border-radius:12px;font-size:15px;font-weight:600;
  cursor:pointer;margin-top:8px;transition:background .2s,transform .1s;
}
.btn-login:hover{background:#145c32;}
.btn-login:active{transform:scale(.99);}

.footer-note{text-align:center;font-size:12px;color:#bbb;margin-top:24px;}

@media(max-width:700px){
  .login-card{flex-direction:column;max-width:440px;}
  .panel-left{width:100%;padding:36px 28px 30px;min-height:auto;}
  .panel-right{width:100%;padding:32px 28px 36px;}
  .panel-right h1{font-size:24px;}
}
</style>
</head>
<body>

<div class="login-card">

  <!-- LEFT -->
  <div class="panel-left">
    <div class="logo">
      <img src="{{ asset('assets/lg.png') }}" alt="Logo PT Pertamina Geothermal Energy">
    </div>

    <div class="tagline">
      <h2>Absensi harian mudah, cepat, dan akurat</h2>
      <p>Catat kehadiranmu setiap hari kerja. Riwayat dan rekap tersedia otomatis untuk pembimbingmu.</p>

      <div class="steps">
        <div class="step-item">
          <div class="step-num">1</div>
          <div class="step-text">Login dengan email dan password yang diberikan HR</div>
        </div>
        <div class="step-item">
          <div class="step-num">2</div>
          <div class="step-text">Lakukan check-in saat tiba di kantor</div>
        </div>
        <div class="step-item">
          <div class="step-num">3</div>
          <div class="step-text">Check-out saat jam kerja selesai</div>
        </div>
      </div>
    </div>

    <div style="color:rgba(255,255,255,.4);font-size:11px;">
      PT Pertamina Geothermal Energy &copy; 2026
    </div>
  </div>

  <!-- RIGHT -->
  <div class="panel-right">

    <div class="top-link">
      <a href="/admin/login">Masuk sebagai Admin &rarr;</a>
    </div>

    <div class="role-badge">Peserta Internship</div>
    <h1>Halo, selamat datang!</h1>
    <p class="subtitle">Masuk untuk mencatat kehadiran dan melihat rekap absensimu selama program internship.</p>

    @if(session('error'))
    <div class="error-box">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/mahasiswa/login">
      @csrf
      <div class="field">
        <label>Email</label>
        <input type="email" name="email" placeholder="Masukkan Email" required>
      </div>
      <div class="field">
        <label>Password</label>
        <input type="password" name="password" placeholder="Password dari tim HR" required autocomplete="current-password">
      </div>
      <button type="submit" class="btn-login">Masuk &amp; Absen Sekarang</button>
    </form>

    <p class="footer-note">Lupa password? Hubungi HR di <strong>hr@pertamina-geo.co.id</strong></p>

  </div>
</div>

<script>
document.querySelectorAll('a[href]').forEach(link=>{
  const href=link.getAttribute('href');
  if(!href||href.startsWith('#')) return;
  link.addEventListener('click',function(e){
    e.preventDefault();
    document.body.style.animation='none';
    document.body.style.opacity='1';
    document.body.style.transition='opacity .25s ease';
    requestAnimationFrame(()=>{ document.body.style.opacity='0'; });
    setTimeout(()=>{ window.location.href=href; },280);
  });
});
</script>
</body>
</html>