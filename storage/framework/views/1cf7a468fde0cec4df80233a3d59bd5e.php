<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Sistem Penjadwalan - FIKOM UNIKA</title>

    <link rel="stylesheet" href="<?php echo e(asset('login.css')); ?>" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    <style>
      .alert-error { background: #fbeceb; color: #b3261e; padding: 12px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; font-weight: 500; text-align: center; border: 1px solid #f0c4c1; }
      .alert-success { background: #eaf5ef; color: #1f7a4d; padding: 12px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; font-weight: 500; text-align: center; border: 1px solid #bfe3d1; }
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

          <h2>Selamat Datang</h2>
          <p class="subtitle">Silahkan masuk untuk melanjutkan</p>

          <?php if(session('successMessage')): ?>
            <div class="alert-success">
              <?php echo e(session('successMessage')); ?>

            </div>
          <?php endif; ?>

          <?php if($errors->has('loginError')): ?>
            <div class="alert-error">
              <?php echo e($errors->first('loginError')); ?>

            </div>
          <?php endif; ?>

          <form id="loginForm" action="<?php echo e(url('/login')); ?>" method="POST">
            <?php echo csrf_field(); ?> 

            <div class="input-group">
              <label>Email/NIDN/NIM</label>
              <div class="input-box">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="username" placeholder="Masukkan Email/NIDN/NIM" value="<?php echo e(old('username')); ?>" required autocomplete="off" />
              </div>
            </div>

            <div class="input-group">
              <label>Password</label>
              <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Masukkan Password" required />
              </div>
            </div>

            <div class="options">
              <div class="remember">
                <input type="checkbox" name="remember" />
                <span>Ingat saya</span>
              </div>
              <a href="<?php echo e(url('/forgot-password')); ?>">Lupa password?</a>
            </div>

            <button type="submit" class="btn-login">Masuk</button>
          </form>

          <div class="divider">
            <span></span>
            <p>Belum punya akun?</p>
            <span></span>
          </div>

          <button type="button" class="btn-register" id="go-register">
            Register
          </button>
        </div>
      </div>
    </div>

    <script>
      const registerButton = document.getElementById("go-register");
      const loginCard = document.querySelector(".login-card");

      if (registerButton && loginCard) {
        registerButton.addEventListener("click", () => {
          loginCard.classList.add("slide-out-left");
          setTimeout(() => {
            window.location.href = "<?php echo e(url('/register')); ?>";
          }, 450);
        });
      }
    </script>
  </body>
</html><?php /**PATH C:\laragon\www\fikom-unika\resources\views/auth/login.blade.php ENDPATH**/ ?>