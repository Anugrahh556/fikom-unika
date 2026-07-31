<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manajemen Ruangan - UNIKA Santo Thomas</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('Dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('ruangan.css') }}" />
  </head>
  <body>
    <aside class="sidebar">
      <div class="sidebar-top">
        <img src="{{ asset('Logo_UNIKA.png') }}" alt="Logo UNIKA" />
        <div class="logo-text">
          <h2>UNIVERSITAS KATOLIK SANTO THOMAS</h2>
          <p>SISTEM PENJADWALAN MATAKULIAH</p>
        </div>
      </div>

      <ul class="menu">
  <li onclick="window.location.href = '{{ url('/dashboard') }}'">
    <i class="fa-solid fa-columns"></i> Dashboard
  </li>
  <li onclick="window.location.href = '{{ url('/jadwal') }}'">
    <i class="fa-regular fa-calendar"></i> Jadwal
  </li>
  <li onclick="window.location.href = '{{ url('/dosen') }}'">
    <i class="fa-solid fa-user-group"></i> Dosen
  </li>
  
  <li class="active" onclick="window.location.href = '{{ url('/ruangan') }}'">
    <i class="fa-solid fa-door-open"></i> Ruangan
  </li>
</ul>
    </aside>

    <main class="main-content">
      <header class="topbar">
        <div class="topbar-left">
          <i class="fa-solid fa-bars" id="burgerIcon"></i>
          <h1>Manajemen Ruangan</h1>
        </div>

        <div class="topbar-right">
          @include('partials.notification_bell', ['jadwalTerbaru' => $jadwalTerbaru ?? []])
          @include('partials.profile_dropdown')
        </div>
      </header>

      <section class="dashboard-grid">
        <div class="left-content">
          <div class="content-box">
            <div class="daftar-status-header">
              <div>
                <h2>Daftar Status Ruangan Kampus</h2>
                <p>Memantau aktivitas durasi kelas aktif dan alokasi ruang darurat.</p>
              </div>
              <input type="text" id="searchInput" class="ruangan-search-input" placeholder="Cari nama ruangan..." />
            </div>

            <div class="filter-ruangan-wrapper">
              <select id="filterHari" style="padding: 8px; border-radius: 6px; border: 1px solid var(--line-strong); font-family: var(--font-sans); font-size: 13px;">
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Minggu">Minggu</option>
              </select>

              <select id="filterJurusan" style="padding: 8px; border-radius: 6px; border: 1px solid var(--line-strong); font-family: var(--font-sans); font-size: 13px;">
                <option value="Semua">Semua Jurusan</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
                <option value="Sains Data">Sains Data</option>
              </select>

              <select id="filterStatus" style="padding: 8px; border-radius: 6px; border: 1px solid var(--line-strong); font-family: var(--font-sans); font-size: 13px;">
                <option value="Semua">Semua Status</option>
                <option value="Dipakai">Dipakai</option>
                <option value="Kosong">Kosong</option>
              </select>

              <button id="btnFilter" style="background: var(--maroon-700); color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-family: var(--font-sans); font-weight: 500; font-size: 13px;">
                Terapkan
              </button>
            </div>

            <div id="ruanganGrid"></div>
          </div>
        </div>

        <div class="right-content">
          <div class="content-box mb-20">
            <div class="ruangan-header-title">
              <h2>Ringkasan Status</h2>
            </div>
            <div class="stat-wrapper">
              <div class="stat-item bg-gray">
                <span><i class="fa-solid fa-building"></i> Total Kapasitas</span>
                <strong>16 Kelas</strong>
              </div>
              <div class="stat-item bg-green">
                <span><i class="fa-solid fa-circle-check"></i> Ruangan Kosong</span>
                <strong id="statKosong">4 Ruang</strong>
              </div>
              <div class="stat-item bg-red">
                <span><i class="fa-solid fa-circle-exclamation"></i> Sedang Digunakan</span>
                <strong id="statDipakai">4 Ruang</strong>
              </div>
            </div>
          </div>

          <div class="content-box">
            <div class="ruangan-header-title">
              <h2>Log Aktivitas Admin</h2>
            </div>
            <div id="logAktivitasContainer" class="log-container">
              <div class="log-item border-gray">
                <span class="log-title text-muted">Sistem Siap</span>
                <p class="log-text">Master denah operasional cerdas ruangan berhasil dimuat.</p>
                <small class="log-time"><i class="fa-regular fa-clock"></i> Baru saja</small>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <script>
      // --- LOGIKA DROPDOWN INTERAKTIF (PROFIL & NOTIFIKASI) ---
      document.addEventListener("DOMContentLoaded", () => {

        const profileBtn = document.getElementById('profileDropdownBtn');
        const dropdownMenu = document.getElementById('myDropdown');
        const notifBtn = document.getElementById('notification-icon');
        const notifDropdown = document.getElementById('notification-dropdown');

        const toggleDropdown = (menu, otherMenu) => {
            const isOpen = menu.classList.contains('show');
            menu.classList.toggle('show', !isOpen);
            if (otherMenu) otherMenu.classList.remove('show');
        };

        if (profileBtn && dropdownMenu) {
          profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleDropdown(dropdownMenu, notifDropdown);
          });
        }

        if(notifBtn && notifDropdown) {
          notifBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleDropdown(notifDropdown, dropdownMenu);
          });
        }

        // Listener global untuk menutup semua dropdown saat klik di luar
        document.addEventListener('click', () => {
            if (dropdownMenu) dropdownMenu.classList.remove('show');
            if (notifDropdown) notifDropdown.classList.remove('show');
        });

        // Mencegah dropdown tertutup saat diklik di dalamnya
        if(notifDropdown) notifDropdown.addEventListener('click', (e) => e.stopPropagation());
        if(dropdownMenu) dropdownMenu.addEventListener('click', (e) => e.stopPropagation());
      });
    </script>
    <script>
      
      window.masterJadwalServer = @json($masterJadwal);
      window.daftarRuanganServer = @json($ruangan);
      window.userRole = "{{ auth()->check() ? auth()->user()->role : 'guest' }}";
      window.daftarDosenServer = @json($dosens);
     
      console.log("CEK DATA SERVER: ", window.masterJadwalServer);
    </script>
    {{-- Dashboard.js (data mock lama) TIDAK di-include lagi di sini — ruangan.js
         sekarang murni memakai window.masterJadwalServer (data asli dari
         RuanganController), jadi tidak butuh Dashboard.js sama sekali. --}}
    <script src="{{ asset('ruangan.js') }}"></script>
  </body>
</html>