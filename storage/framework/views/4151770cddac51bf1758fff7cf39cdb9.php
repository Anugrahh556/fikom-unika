<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Sistem Penjadwalan - FIKOM UNIKA</title>

    <link rel="stylesheet" href="<?php echo e(asset('register.css')); ?>" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
      .alert-error { background: #fbeceb; color: #b3261e; padding: 12px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; font-weight: 500; text-align: center; border: 1px solid #f0c4c1; }
    </style>
  </head>

  <body>
    <div class="container">
      <div class="left-panel">
        <img class="hero-image" src="<?php echo e(asset('background.png.png')); ?>" alt="Ilustrasi sistem penjadwalan" />
      </div>

      <div class="right-panel">
        <div class="register-card">
          <h2>Register</h2>
          <p class="subtitle">Silahkan daftar untuk melanjutkan</p>

          <?php if($errors->any()): ?>
            <div class="alert-error">
              <?php echo e($errors->first()); ?>

            </div>
          <?php endif; ?>

          <form action="<?php echo e(url('/register')); ?>" method="POST">
            <?php echo csrf_field(); ?> 

            <div class="input-group">
              <label>Nama Lengkap</label>
              <div class="input-box">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="name" placeholder="Masukkan Nama Lengkap" value="<?php echo e(old('name')); ?>" required />
              </div>
            </div>

            <div class="input-group">
              <label>Email</label>
              <div class="input-box">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" placeholder="Masukkan Email" value="<?php echo e(old('email')); ?>" required />
              </div>
            </div>

            <div class="input-group">
              <label>NIDN/NIM</label>
              <div class="input-box no-icon">
                <input type="text" name="username" placeholder="Masukkan NIDN/NIM" value="<?php echo e(old('username')); ?>" required autocomplete="off" />
              </div>
            </div>

            <div class="input-group">
              <label>Password</label>
              <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Masukkan Password" required />
              </div>
            </div> 

            <div class="input-group">
              <label>Konfirmasi Password</label>
              <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required />
              </div>
            </div> 

            <button type="submit" class="btn-register">Daftar</button>
          </form>

          <div class="divider">
            <span></span>
            <p>Sudah punya akun?</p>
            <span></span>
          </div>

          <button type="button" class="btn-login" id="go-login">Masuk</button>
        </div>
      </div>
    </div>

    <script>
      const loginButton = document.getElementById("go-login");
      const registerCard = document.querySelector(".register-card");

      if (loginButton && registerCard) {
        loginButton.addEventListener("click", () => {
          registerCard.classList.add("slide-out-left");
          setTimeout(() => {
            window.location.href = "<?php echo e(url('/')); ?>";
          }, 450);
        });
      }
    </script>
  </body>
</html><?php /**PATH C:\laragon\www\fikom-unika\resources\views/auth/register.blade.php ENDPATH**/ ?>