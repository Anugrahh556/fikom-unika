<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lupa Password - FIKOM UNIKA</title>

    <link rel="stylesheet" href="<?php echo e(asset('login.css')); ?>" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
      .alert-error { background: #fbeceb; color: #b3261e; padding: 12px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; font-weight: 500; text-align: center; border: 1px solid #f0c4c1; }
      .alert-success { background: #eaf5ef; color: #1f7a4d; padding: 12px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; font-weight: 500; text-align: center; border: 1px solid #bfe3d1; }

      /* Sedikit tambahan khusus halaman ini, tidak mengubah login.css */
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
    <div class="container">
      <div class="left-panel">
        <img class="hero-image" src="<?php echo e(asset('background.png.png')); ?>" alt="Background" />
      </div>

      <div class="right-panel">
        <div class="login-card">
          <img src="<?php echo e(asset('Logo_UNIKA.png')); ?>" class="logo" alt="Logo" />

          <h2>Lupa Password</h2>
          <p class="subtitle">Masukkan Email atau NIDN/NIM akun Anda</p>

          <?php if(session('successMessage')): ?>
            <div class="alert-success">
              <?php echo e(session('successMessage')); ?>

            </div>
          <?php endif; ?>

          <?php if($errors->has('identifier')): ?>
            <div class="alert-error">
              <?php echo e($errors->first('identifier')); ?>

            </div>
          <?php endif; ?>

          <form id="forgotPasswordForm" action="<?php echo e(url('/forgot-password')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="input-group">
              <label>Email/NIDN/NIM</label>
              <div class="input-box">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="identifier" placeholder="Masukkan Email/NIDN/NIM" value="<?php echo e(old('identifier')); ?>" required autocomplete="off" autofocus />
              </div>
            </div>

            <button type="submit" class="btn-login">Kirim Link Reset Password</button>
          </form>

          <div class="back-to-login">
            Sudah ingat password? <a href="<?php echo e(url('/')); ?>">Kembali ke Login</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html><?php /**PATH C:\laragon\www\fikom-unika\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>