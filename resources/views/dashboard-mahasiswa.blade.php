<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Mahasiswa - FIKOM UNIKA</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('Dashboard.css') }}" />
    <style>
        .welcome-card {
            background: linear-gradient(135deg, #a50000, #8b0000);
            color: white;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 25px;
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
            animation-delay: 0.2s;
        }
        .welcome-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .welcome-text h2 {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
        }
        .welcome-text p {
            font-size: 1rem;
            opacity: 0.9;
            margin-top: 4px;
        }
    </style>
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
        <li class="active" onclick="window.location.href = '{{ url('/dashboard') }}'">
          <i class="fa-solid fa-columns"></i>
          Dashboard
        </li>
        <li onclick="window.location.href = '{{ url('/jadwal') }}'">
          <i class="fa-regular fa-calendar"></i>
          Jadwal
        </li>
        <li onclick="window.location.href = '{{ url('/dosen') }}'">
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
      <header class="topbar">
        <div class="topbar-left">
          <i class="fa-solid fa-bars" id="burgerIcon"></i>
          <h1>Dashboard</h1>
        </div>

        <div class="topbar-right">
          <div class="notification" id="notifDropdownBtn" style="cursor: pointer; position: relative;">
              <i class="fa-regular fa-bell"></i>
              @if(isset($jadwalTerbaru) && $jadwalTerbaru->count() > 0)
                  <span class="notif-badge">{{ $jadwalTerbaru->count() }}</span>
              @endif
      
              {{-- Dropdown Notifikasi --}}
              <div class="notification-dropdown" id="notifDropdownContent">
                  <div class="notification-header">
                      <h4>Notifikasi Terbaru</h4>
                  </div>
                  <div class="notification-body">
                      @forelse($jadwalTerbaru as $notif)
                          <div class="notification-item">
                              <div class="notif-icon-wrapper">
                                  <i class="fa-solid fa-calendar-day"></i>
                              </div>
                              <div class="notif-content">
                                  <p>Jadwal <strong>{{ Str::limit($notif->matakuliah, 25) }}</strong> telah diperbarui menjadi jam <strong>{{ $notif->jam }}</strong>.</p>
                                  <small>{{ $notif->updated_at->diffForHumans() }}</small>
                              </div>
                          </div>
                      @empty
                          <div class="notification-empty">
                              <i class="fa-solid fa-check-double"></i>
                              <p>Tidak ada pembaruan jadwal.</p>
                          </div>
                      @endforelse
                  </div>
              </div>
          </div>
          <div class="profile" id="profileDropdownBtn" style="cursor: pointer;">
            <img src="https://api.dicebear.com/7.x/initials/svg?seed={{ Auth::user()->name }}" alt="Avatar Mahasiswa" />
            <div class="profile-info">
              <h4>{{ Auth::user()->name }}</h4>
              <p>{{ strtoupper(Auth::user()->role) }}</p>
            </div>
            <i class="fa-solid fa-chevron-down dropdown-icon"></i>
            
            <div class="dropdown-content" id="myDropdown" style="display:none; position: absolute; top: 60px; right: 20px; background: white; min-width: 160px; box-shadow: 0px 8px 16px rgba(0,0,0,0.1); border-radius: 8px; z-index: 1000;">
              <a href="{{ url('/logout') }}" style="color: #b30000; padding: 12px 16px; text-decoration: none; display: block; font-size: 14px; font-weight: 500;">
                <i class="fa-solid fa-right-from-bracket" style="margin-right: 8px;"></i> Keluar Sistem
              </a>
            </div>
          </div>
          @include('partials.notification_bell', ['jadwalTerbaru' => $jadwalTerbaru ?? []])
          @include('partials.profile_dropdown')
        </div>
      </header>

     <section class="content">
        <div class="welcome-card">
            <img src="https://api.dicebear.com/7.x/initials/svg?seed={{ Auth::user()->name }}" alt="Avatar Mahasiswa" />
            <div class="welcome-text">
                <h2>Selamat Datang, {{ Auth::user()->name }}!</h2>
                <p>Semoga harimu menyenangkan dan perkuliahanmu lancar.</p>
            </div>
        </div>

        <section class="cards">
            <div class="card">
              <div class="card-icon maroon"><i class="fa-solid fa-hourglass-half"></i></div>
              <div class="card-text">
                <h5>Total SKS Hari Ini</h5>
                <h2>{{ $totalSksHariIni ?? 0 }}</h2> 
              </div>
            </div>
          
            <div class="card">
              <div class="card-icon orange"><i class="fa-solid fa-book-open-reader"></i></div>
              <div class="card-text">
                <h5>Total Matakuliah</h5>
                <h2>{{ $totalMatkulHariIni ?? 0 }}</h2> 
              </div>
            </div>
          
            <div class="card">
              <div class="card-icon green"><i class="fa-solid fa-check-double"></i></div>
              <div class="card-text">
                <h5>Matakuliah Selesai</h5>
                <h2>{{ $matkulSelesai ?? 0 }}</h2> 
              </div>
            </div>
        </section>

        <!-- Di sini Anda bisa menambahkan widget lain untuk mahasiswa -->
        <!-- Contoh: Jadwal hari ini, pengumuman, dll. -->
        <div class="dashboard-grid">
            <!-- Kolom Kiri: Jadwal Hari Ini -->
            <div class="left-content">
                <div class="content-box">
                    <div class="table-header">
                        <h2>Jadwal Kuliah Anda Hari Ini ({{ $hariIni }})</h2>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Jam</th>
                                    <th>Matakuliah</th>
                                    <th>Dosen</th>
                                    <th>Ruang</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="jadwalMahasiswaBody">
                                @forelse($jadwalSaya as $jadwal)
                                    <tr>
                                        <td>{{ $jadwal->jam }}</td>
                                        <td>
                                            <strong>{{ $jadwal->matakuliah }}</strong><br>
                                            <small class="kelas-badge">{{ $jadwal->kelas }}</small>
                                        </td>
                                        <td>{{ $jadwal->dosen->nama ?? 'N/A' }}</td>
                                        <td>{{ $jadwal->ruang }}</td>
                                        <td>
                                            @php
                                                $jamSekarang = now('Asia/Jakarta')->format('H.i');
                                                $jamParts = explode('-', str_replace(' ', '', $jadwal->jam ?? ''));
                                                $jamMulai = $jamParts[0] ?? null;
                                                $jamSelesai = $jamParts[1] ?? null;
                                                $status = 'Akan Datang';
                                                $statusClass = 'gray-badge';
                                        if ($jamSekarang >= $jamMulai && $jamSekarang <= $jamSelesai) {
                                            $status = 'Berlangsung';
                                            $statusClass = 'success pulsing';
                                        } elseif ($jamSekarang > $jamSelesai) {
                                            $status = 'Selesai';
                                            $statusClass = 'blue-status';
                                        }
                                            @endphp
                                            <span class="status {{ $statusClass }}">{{ $status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 20px;">Tidak ada jadwal kuliah hari ini. Selamat beristirahat!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Kontrol Pagination -->
                    <div class="pagination-container">
                        <span class="pagination-info" id="mahasiswaPaginationInfo"></span>
                        <div class="pagination-buttons" id="mahasiswaPaginationBtns"></div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Kalender & Ruangan -->
            <div class="right-content">
                <div class="content-box">
                    <div class="calendar-header">
                        <h2 id="calendar-month-year"></h2>
                    </div>
                    <div class="calendar-days">
                        <span>Min</span><span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span>
                    </div>
                    <div class="calendar-dates" id="calendar-dates-container"></div>
                </div>

                <div class="content-box">
                    <div class="ruangan-header">
                        <h2>Ruangan Terpakai Saat Ini</h2>
                    </div>
                    <div id="room-status-container">
                        @forelse($ruanganTerpakai as $ruangan)
                            <div class="room-item">
                                <div class="room-left">
                                    <div class="room-icon blue-bg"><i class="fa-solid fa-chalkboard-user"></i></div>
                                    <div class="room-text">
                                        <h4>Ruang {{ $ruangan->ruang }}</h4>
                                        <p>{{ Str::limit($ruangan->matakuliah, 20) }}</p>
                                    </div>
                                </div>
                                <span class="room-status blue-status">Dipakai</span>
                            </div>
                        @empty
                            <div class="log-item border-gray" style="text-align: center; padding: 15px 0;">
                                <span class="log-title text-muted">Semua Ruangan Kosong</span>
                                <p class="log-text" style="font-size: 13px;">Tidak ada kelas yang berlangsung saat ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
     </section>
    </main>

    <script src="{{ asset('Dashboard.js') }}"></script>
    <script>
      // --- LOGIKA DROPDOWN INTERAKTIF (PROFIL & NOTIFIKASI) ---
      const profileBtn = document.getElementById('profileDropdownBtn');
      const dropdownMenu = document.getElementById('myDropdown');
      const notifBtn = document.getElementById('notifDropdownBtn');
      const notifDropdown = document.getElementById('notifDropdownContent');
      const notifBtn = document.getElementById('notification-icon');
      const notifDropdown = document.getElementById('notification-dropdown');
      
      if(profileBtn && dropdownMenu) {
        profileBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
          if (notifDropdown) notifDropdown.style.display = 'none'; // Tutup dropdown notif
        });
      }

      if(notifBtn && notifDropdown) {
        notifBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          notifDropdown.style.display = notifDropdown.style.display === 'block' ? 'none' : 'block';
          if (dropdownMenu) dropdownMenu.style.display = 'none'; // Tutup dropdown profil
        });
      }

      // Listener global untuk menutup semua dropdown saat klik di luar
      document.addEventListener('click', (e) => {
          if (dropdownMenu) dropdownMenu.style.display = 'none';
          if (notifDropdown) notifDropdown.style.display = 'none';
      });

      if(notifDropdown) {
        notifDropdown.addEventListener('click', (e) => e.stopPropagation());
      }

      // --- SCRIPT UNTUK KALENDER MINI ---
      document.addEventListener("DOMContentLoaded", function() {
        const monthYearEl = document.getElementById('calendar-month-year');
        const datesContainer = document.getElementById('calendar-dates-container');
        
        if (!monthYearEl || !datesContainer) return;

        const today = new Date();
        let currentMonth = today.getMonth();
        let currentYear = today.getFullYear();

        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        function renderCalendar() {
            datesContainer.innerHTML = '';
            monthYearEl.textContent = `${monthNames[currentMonth]} ${currentYear}`;
            
            const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();
            const lastDateOfMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

            for (let i = 0; i < firstDayOfMonth; i++) {
                datesContainer.innerHTML += '<div></div>';
            }

            for (let i = 1; i <= lastDateOfMonth; i++) {
                let dateDiv = document.createElement('div');
                dateDiv.textContent = i;
                if (i === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
                    dateDiv.classList.add('active-date');
                }
                datesContainer.appendChild(dateDiv);
            }
        }
        renderCalendar();
    });

    // --- SCRIPT UNTUK PAGINATION JADWAL SAYA ---
    document.addEventListener("DOMContentLoaded", function() {
        const rowsPerPage = 4; // Atur jumlah jadwal per halaman
        const tableBody = document.getElementById('jadwalMahasiswaBody');
        const paginationInfo = document.getElementById('mahasiswaPaginationInfo');
        const paginationBtns = document.getElementById('mahasiswaPaginationBtns');
        const paginationContainer = document.querySelector('.pagination-container');

        if (!tableBody || !paginationInfo || !paginationBtns || !paginationContainer) return;

        let currentPage = 1;
        const rows = Array.from(tableBody.querySelectorAll("tr"));
        const totalRows = rows.length;

        // Jika tidak ada baris data atau hanya 1 halaman, sembunyikan pagination
        if (totalRows <= rowsPerPage) {
            paginationContainer.style.display = 'none';
            return;
        }

        function updatePagination() {
            const totalPages = Math.ceil(totalRows / rowsPerPage);
            if (currentPage > totalPages) currentPage = totalPages || 1;

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            
            rows.forEach((row, index) => {
                row.style.display = (index >= start && index < end) ? "" : "none";
            });
            
            const currentEnd = end > totalRows ? totalRows : end;
            paginationInfo.textContent = `Menampilkan ${start + 1} - ${currentEnd} dari ${totalRows} jadwal`;
            
            paginationBtns.innerHTML = "";
            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement("button");
                btn.className = `pagination-btn ${i === currentPage ? 'active' : ''}`;
                btn.textContent = i;
                btn.addEventListener("click", () => {
                    currentPage = i;
                    updatePagination();
                });
                paginationBtns.appendChild(btn);
            }
        }
        updatePagination();
    });
    </script>
  </body>
</html>