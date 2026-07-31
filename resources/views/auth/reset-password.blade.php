<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password - FIKOM UNIKA</title>

    <link rel="stylesheet" href="{{ asset('login.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
      .alert-error { background: #fbeceb; color: #b3261e; padding: 12px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; font-weight: 500; text-align: center; border: 1px solid #f0c4c1; }

      /* Body login.css sudah flex+center, jadi card ini otomatis di tengah layar
         tanpa perlu left-panel/right-panel — sesuai gaya "card sederhana" */
      .reset-card {
        width: 440px;
        max-width: 92%;
      }

      .reset-card .input-box input[readonly] {
        color: var(--muted);
        background: var(--paper);
      }

      .hint {
        font-size: 12px;
        color: var(--muted);
        margin-top: 6px;
      }

      .back-to-login {
        text-align: center;
        margin-top: 22px;
        font-size: 13px;
        color: var(--ink-soft);
      }
      .back-to-login a {
        color: var(--maroon-700);
        text-decoration: none;
        font-weight: 600;
      }
      .back-to-login a:hover {
        text-decoration: underline;
      }
    </style>
  </head>

  <body>
    <div class="login-card reset-card">
      <img src="{{ asset('Logo_UNIKA.png') }}" class="logo" alt="Logo" />

      <h2>Buat Password Baru</h2>
      <p class="subtitle">Masukkan password baru untuk akun Anda</p>

      @if($errors->any())
        <div class="alert-error">
          {{ $errors->first() }}
        </div>
      @endif

      <form id="resetPasswordForm" action="{{ url('/reset-password') }}" method="POST">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="input-group">
          <label>Email</label>
          <div class="input-box">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" name="email" value="{{ old('email', $email) }}" readonly required />
          </div>
        </div>

        <div class="input-group">
          <label>Password Baru</label>
          <div class="input-box">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Minimal 5 karakter" required autofocus />
          </div>
        </div>

        <div class="input-group">
          <label>Konfirmasi Password Baru</label>
          <div class="input-box">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password_confirmation" placeholder="Ulangi password baru" required />
          </div>
          <div class="hint">Pastikan sama persis dengan password di atas.</div>
        </div>

        <button type="submit" class="btn-login">Simpan Password Baru</button>
      </form>

      <div class="back-to-login">
        <a href="{{ url('/') }}">Batal, kembali ke Login</a>
      </div>
    </div>
  </body>
</html>