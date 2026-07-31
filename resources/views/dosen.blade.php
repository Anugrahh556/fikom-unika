<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Dosen</title>

    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

    <link rel="stylesheet" href="{{ asset('dosen.css') }}" />
    <style>
      .profile { position: relative; cursor: pointer; }
      .dropdown-content {
          display: block;
          position: absolute;
          top: 55px;
          right: 0px;
          background-color: #ffffff;
          min-width: 170px;
          box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
          border-radius: 10px;
          border: 1px solid #ece5e3;
          z-index: 999999 !important;
          overflow: hidden;

          opacity: 0;
          visibility: hidden;
          transform: translateY(-8px) scale(0.97);
          transform-origin: top right;
          transition: opacity 0.18s ease, transform 0.18s ease, visibility 0.18s;
          pointer-events: none;
      }
      .dropdown-content.show {
          opacity: 1;
          visibility: visible;
          transform: translateY(0) scale(1);
          pointer-events: auto;
      }
      .dropdown-content a:hover { background: #fff5f5; }

      /* CSS untuk Dropdown Notifikasi */
      .notification-dropdown {
          display: block;
          position: absolute;
          top: 52px;
          right: 0;
          width: 360px;
          background-color: #ffffff;
          box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
          border-radius: 10px;
          border: 1px solid #ece5e3;
          z-index: 9999;
          overflow: hidden;
          font-family: "Inter", sans-serif;

          opacity: 0;
          visibility: hidden;
          transform: translateY(-8px) scale(0.97);
          transform-origin: top right;
          transition: opacity 0.18s ease, transform 0.18s ease, visibility 0.18s;
          pointer-events: none;
      }
      .notification-dropdown.show {
          opacity: 1;
          visibility: visible;
          transform: translateY(0) scale(1);
          pointer-events: auto;
      }
      .notification-header {
          padding: 12px 16px;
          border-bottom: 1px solid #f1f1f1;
          display: flex;
          align-items: center;
          justify-content: space-between;
          gap: 12px;
      }
      .notification-header h4 {
          margin: 0;
          font-size: 1rem;
          font-weight: 600;
          color: #1c1517;
      }
      .btn-hapus-notif {
          border: none;
          background: none;
          color: #641021;
          font-family: "Inter", sans-serif;
          font-size: 0.75rem;
          font-weight: 600;
          cursor: pointer;
          padding: 4px 6px;
          border-radius: 6px;
          transition: background-color 0.2s ease;
          white-space: nowrap;
      }
      .btn-hapus-notif:hover {
          background-color: #fbeeee;
      }
      .notification-body {
          max-height: 350px;
          overflow-y: auto;
      }
      .notification-item {
          display: flex;
          gap: 12px;
          padding: 12px 16px;
          border-bottom: 1px solid #f8f9fa;
          transition: background-color 0.2s;
      }
      .notification-item:hover { background-color: #f9fafb; }
      .notif-icon-wrapper {
          width: 36px;
          height: 36px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          background-color: #eff8ff;
          color: #175cd3;
          flex-shrink: 0;
      }
      .notif-content p { margin: 0; font-size: 0.875rem; line-height: 1.4; color: #4a4144; }
      .notif-content small { font-size: 0.75rem; color: #8c8386; }
      .notification-empty {
          text-align: center;
          padding: 40px 20px;
          color: #8c8386;
      }
      .notification-empty i {
          font-size: 2rem;
          margin-bottom: 8px;
          display: block;
          opacity: 0.7;
      }
    </style>
  </head>

  <body>
    <aside class="sidebar">
      <div class="sidebar-top">
        <img src="{{ asset('Logo_UNIKA.png') }}" alt="Logo" />
        <div class="logo-text">
          <h2>UNIVERSITAS KATOLIK SANTO THOMAS</h2>
          <p>SISTEM PENJADWALAN MATAKULIAH</p>
        </div>
      </div>

      <ul class="menu">
        <li onclick="window.location.href = '{{ url('/dashboard') }}'">
          <i class="fa-solid fa-table-cells-large"></i>
          Dashboard
        </li>
        <li onclick="window.location.href = '{{ url('/jadwal') }}'">
          <i class="fa-regular fa-calendar"></i>
          Jadwal
        </li>
        <li class="active" onclick="window.location.href = '{{ url('/dosen') }}'">
          <i class="fa-solid fa-user-group"></i>
          Dosen
        </li>
        <li onclick="window.location.href = '{{ url('/ruangan') }}'">
          <i class="fa-solid fa-door-open"></i>
          Ruangan
        </li>
      </ul>
    </aside>

    <main class="main-content">
      <div class="top-header">
        <div class="header-left">
          <h1>Dosen</h1>
          <p>Kelola data dosen Universitas Katolik Santo Thomas</p>
        </div>

        <div class="topbar-right">
          @include('partials.notification_bell', ['jadwalTerbaru' => $jadwalTerbaru ?? []])
          @include('partials.profile_dropdown')
        </div>
      </div>

      <section class="stats-grid">
        <div class="stats-card">
          <div>
            <h2 id="statTotalDosen">26</h2>
            <p>Dosen aktif</p>
          </div>
          <div class="stats-icon maroon-bg">
            <i class="fa-solid fa-users"></i>
          </div>
        </div>

        <div class="stats-card maroon-card">
          <div>
            <h2 id="statDosenTetap">20</h2>
            <p>Dosen tetap</p>
          </div>
          <div class="stats-icon white-bg">
            <i class="fa-solid fa-user-check"></i>
          </div>
        </div>
      </section>

      <div class="section-header">
        <div>
          <h2>Daftar Dosen</h2>
          <p>Universitas Katolik Santo Thomas</p>
        </div>
        @if(Auth::user()->role == 'admin')
        <button class="btn-tambah" id="btnTambah">
          <i class="fa-solid fa-plus"></i>
          Tambah Dosen
        </button>
        @endif
      </div>

      <div class="dosen-layout-wrapper">
        <div class="kolom-tabel-container">
          <div class="search-container">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input
              type="text"
              id="searchDosenInput"
              placeholder="Cari Nama..."
            />
          </div>

          <div class="table-responsive-wrapper">
            <table class="dosen-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIDN</th>
            <th>Prodi</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="dosenTableBody">
        </tbody>
</table>
          </div>

          <div class="pagination-container">
            <p id="paginationInfo">Showing 1 to 5 of 26 entries</p>
            <div class="pagination-buttons"></div>
          </div>
        </div>

        <div class="kolom-preview-container" id="profilPreviewPanel">
          <div class="preview-sticky-card">
            <h3>Profil</h3>

            <div class="preview-avatar-circle">
              <img src="" id="prevFoto" alt="Foto Profil Dosen" />
            </div>

            <h4 id="prevNama">Nama Dosen Beserta Gelar</h4>
            <div id="prevBadgeContainer"></div>

            <div class="preview-body-info">
              <h5 class="instansi-tag">FAKULTAS ILMU KOMPUTER</h5>
              <p class="prodi-subtag" id="prevProdi">Nama Program Studi</p>

              <div class="divider-line"></div>

              <div class="info-contact-list">
                <div class="contact-item">
                  <i class="fa-regular fa-envelope"></i>
                  <span id="prevEmail">email@gmail.com</span>
                </div>
                <div class="contact-item">
                  <i class="fa-solid fa-phone"></i>
                  <span id="prevPhone">+62 813-6206-9808</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    @if(Auth::user()->role == 'admin')
    <div class="modal" id="modalTambah">
      <div class="modal-content">
        <h2>Tambah Dosen</h2>
        <input
          type="text"
          id="namaInput"
          placeholder="Nama lengkap beserta gelar"
        />
        <input type="text" id="nidnInput" placeholder="NIDN" />
        <input type="text" id="prodiInput" placeholder="Program Studi" />
        <input
          type="text"
          id="jabatanInput"
          placeholder="Jabatan Structural (Opsional)"
        />
        <input type="email" id="emailInput" placeholder="Alamat Email" />
        <input type="text" id="phoneInput" placeholder="Nomor Telepon" />
        <div class="modal-action-btns">
          <button onclick="tambahDosen()" class="btn-simpan">Simpan</button>
          <button id="closeTambah" class="btn-batal">Batal</button>
        </div>
      </div>
    </div>

    <div class="modal" id="modalEdit">
      <div class="modal-content">
        <h2>Edit Profil Dosen</h2>
        <input type="hidden" id="editIdInput" />

        <label
          style="
            font-size: 12px;
            text-align: left;
            color: #8c8386;
            margin-bottom: -8px;
          "
          >Foto Profil:</label
        >
        <div style="display: flex; align-items: center; gap: 14px;">
          <img
            id="editFotoPreview"
            src=""
            alt="Preview foto"
            style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; background: #faf9f7; border: 2px solid #641021;"
          />
          <input type="file" id="editFotoInput" accept="image/png, image/jpeg, image/webp" style="flex: 1;" />
        </div>

        <label
          style="
            font-size: 12px;
            text-align: left;
            color: #8c8386;
            margin-bottom: -8px;
          "
          >Nama Lengkap:</label
        >
        <input type="text" id="editNamaInput" />

        <label
          style="
            font-size: 12px;
            text-align: left;
            color: #8c8386;
            margin-bottom: -8px;
          "
          >NIDN:</label
        >
        <input type="text" id="editNidnInput" />

        <label
          style="
            font-size: 12px;
            text-align: left;
            color: #8c8386;
            margin-bottom: -8px;
          "
          >Program Studi:</label
        >
        <input type="text" id="editProdiInput" />

        <label
          style="
            font-size: 12px;
            text-align: left;
            color: #8c8386;
            margin-bottom: -8px;
          "
          >Jabatan Struktural:</label
        >
        <input
          type="text"
          id="editJabatanInput"
          placeholder="Dosen Tetap / Dekan / Wakil Dekan"
        />

        <label
          style="
            font-size: 12px;
            text-align: left;
            color: #8c8386;
            margin-bottom: -8px;
          "
          >Email:</label
        >
        <input type="email" id="editEmailInput" />

        <label
          style="
            font-size: 12px;
            text-align: left;
            color: #8c8386;
            margin-bottom: -8px;
          "
          >Nomor Telepon:</label
        >
        <input type="text" id="editPhoneInput" />

        <div class="modal-action-btns">
          <button onclick="simpanEditDosen()" class="btn-simpan">
            Simpan Perubahan
          </button>
          <button id="closeEdit" class="btn-batal">Batal</button>
        </div>
      </div>
    </div>
    @endif

    <script>
        // Oper data dari Controller Laravel ke objek window global milik browser
        window.dosenDariDatabase = @json($dosens);

        // --- LOGIKA DROPDOWN INTERAKTIF (PROFIL & NOTIFIKASI) ---
        document.addEventListener("DOMContentLoaded", () => {
            const profileBtn = document.getElementById('profileDropdownBtn');
            const dropdownMenu = document.getElementById('myDropdown');
            const notifBtn = document.getElementById('notification-icon');
            const notifDropdown = document.getElementById('notification-dropdown');

            if(profileBtn && dropdownMenu) {
                profileBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isOpen = dropdownMenu.classList.contains('show');
                    dropdownMenu.classList.toggle('show', !isOpen);
                    if (notifDropdown) notifDropdown.classList.remove('show');
                });
            }

            if(notifBtn && notifDropdown) {
                notifBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isOpen = notifDropdown.classList.contains('show');
                    notifDropdown.classList.toggle('show', !isOpen);
                    if (dropdownMenu) dropdownMenu.classList.remove('show');
                });
            }

            document.addEventListener('click', (e) => {
                if (dropdownMenu) dropdownMenu.classList.remove('show');
                if (notifDropdown) notifDropdown.classList.remove('show');
            });

            if(notifDropdown) {
                notifDropdown.addEventListener('click', (e) => e.stopPropagation());
            }
        });
    </script>
    <script src="{{ asset('dosen.js') }}"></script>
  </body>
</html>