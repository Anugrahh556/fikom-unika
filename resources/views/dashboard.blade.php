@php
use Illuminate\Support\Str;
use Carbon\Carbon;
Carbon::setLocale('id');

$userRole = Auth::user()->role;
$sekarang = Carbon::now();
$hariIni = $sekarang->translatedFormat('l');
$tanggalLengkap = $sekarang->translatedFormat('d F Y');
@endphp

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - FIKOM UNIKA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('Dashboard.css') }}" />
    <style>
        .welcome-card { background: linear-gradient(150deg, #641021, #430b16); color: white; padding: 24px 30px; border-radius: 16px; margin-bottom: 24px; display: flex; align-items: center; gap: 25px; opacity: 0; animation: fadeInUp 0.6s ease-out forwards; animation-delay: 0.2s; }
        .welcome-text h2 { font-size: 1.75rem; font-weight: 700; line-height: 1.2; }
        .welcome-text p { font-size: 0.9rem; opacity: 0.9; margin-top: 4px; }
        
        .pagination-container { display: flex !important; justify-content: space-between !important; align-items: center !important; width: 100% !important; margin-top: 20px !important; padding-top: 16px !important; border-top: 1px solid #e2e8f0 !important; }
        .pagination-info { font-size: 0.8125rem !important; color: #6c757d !important; }
        .pagination-wrapper nav > div:first-child { display: none !important; }
        .pagination-wrapper .pagination { display: flex; gap: 6px; list-style: none; margin: 0; padding: 0; }
        .pagination-wrapper svg { width: 14px !important; height: 14px !important; display: inline-block; vertical-align: middle; }
        .pagination-wrapper .page-item .page-link, .pagination-wrapper nav a, .pagination-wrapper nav span[aria-current="page"] span, .pagination-wrapper nav span[aria-disabled="true"] span { display: inline-block !important; padding: 6px 12px !important; color: #641021 !important; background-color: #fff !important; border: 1px solid #ece5e3 !important; text-decoration: none !important; border-radius: 6px !important; font-size: 0.8125rem !important; font-weight: 500 !important; transition: all 0.2s ease !important; }
        .pagination-wrapper .page-item.active .page-link, .pagination-wrapper nav span[aria-current="page"] span, .pagination-static span.active { color: #fff !important; background-color: #641021 !important; border-color: #641021 !important; }
        .pagination-wrapper .page-item.disabled .page-link, .pagination-wrapper nav span[aria-disabled="true"] span, .pagination-static span.disabled { color: #94a3b8 !important; pointer-events: none !important; background-color: #f8fafc !important; border-color: #e2e8f0 !important; }
        .pagination-wrapper .page-item .page-link:hover:not(.active), .pagination-wrapper nav a:hover, .pagination-static a:hover { background-color: #fbf1f1 !important; border-color: #ddd4d1 !important; color: #641021 !important; }
        .pagination-static { display: flex !important; gap: 6px !important; align-items: center !important; }
        .pagination-static span { display: inline-block !important; padding: 6px 12px !important; border: 1px solid #ece5e3 !important; border-radius: 6px !important; font-size: 0.8125rem !important; font-weight: 500 !important; background-color: #fff !important; color: #641021 !important; }

        .ruangan-header a {
            text-decoration: none;
            color: inherit;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: color 0.2s ease;
        }
        .ruangan-header a:hover h2 { color: #641021; }
        .ruangan-header a:hover i { transform: translateX(4px); color: #641021; }
        .ruangan-header a i { font-size: 0.9em; opacity: 0.7; transition: transform 0.3s ease, color 0.3s ease; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-top">
            <img src="{{ asset('Logo_UNIKA.png') }}" alt="Logo" />
            <div class="logo-text"><h2>UNIVERSITAS KATOLIK SANTO THOMAS</h2><p>SISTEM PENJADWALAN MATAKULIAH</p></div>
        </div>
        <ul class="menu">
            <li class="active" onclick="window.location.href = '{{ url('/dashboard') }}'"><i class="fa-solid fa-table-cells-large"></i> Dashboard</li>
            <li onclick="window.location.href = '{{ url('/jadwal') }}'"><i class="fa-regular fa-calendar"></i> Jadwal</li>
            <li onclick="window.location.href = '{{ url('/dosen') }}'"><i class="fa-solid fa-users"></i> Dosen</li>
            <li onclick="window.location.href = '{{ url('/ruangan') }}'"><i class="fa-solid fa-door-open"></i> Ruangan</li>
        </ul>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div class="topbar-left" style="display: flex; align-items: center; gap: 16px;"><i class="fa-solid fa-bars"></i><h1>Dashboard</h1></div>
            <div class="topbar-right">
                @include('partials.notification_bell', ['jadwalTerbaru' => $jadwalTerbaru ?? []])
                @include('partials.profile_dropdown')
            </div>
        </header>

        @if ($userRole == 'admin' || $userRole == 'dosen')
            <div class="welcome-card">
                <div class="welcome-text"><h2>Selamat Datang, {{ strtok(Auth::user()->name, ' ') }}!</h2><p>Anda login sebagai <strong>{{ strtoupper(Auth::user()->role) }}</strong>. Gunakan menu navigasi untuk mengelola sistem.</p></div>
            </div>

            <section class="cards">
                <div class="card"><div class="card-icon maroon"><i class="fa-solid fa-users"></i></div><div class="card-text"><h5>Total Dosen Aktif</h5><h2>{{ $totalDosen ?? 0 }}</h2></div></div>
                <div class="card"><div class="card-icon orange"><i class="fa-solid fa-book-open-reader"></i></div><div class="card-text"><h5>Total Mata Kuliah</h5><h2>{{ $totalMatkul ?? 0 }}</h2></div></div>
                <div class="card"><div class="card-icon green"><i class="fa-solid fa-door-open"></i></div><div class="card-text"><h5>Total Ruangan Fisik</h5><h2>{{ $totalRuangan ?? 0 }}</h2></div></div>
            </section>

            <div class="dashboard-grid">
                <div class="left-content">
                    <div class="content-box">
                        <div class="table-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                            <h2>Jadwal Fakultas Hari Ini</h2>
                            <label class="modern-toggle">
                                <input type="checkbox" id="toggleTampilkanSelesai" />
                                <span class="modern-toggle-track"><span class="modern-toggle-thumb"></span></span>
                                <span class="modern-toggle-label">Tampilkan yang sudah selesai</span>
                            </label>
                        </div>
                        <div class="table-responsive">
                            <table class="jadwal-fakultas-table">
                                <thead><tr><th>Jam</th><th>Mata Kuliah</th><th>Dosen</th><th>Ruangan</th><th>Jurusan</th><th>Kelas</th><th>Status</th></tr></thead>
                                <tbody id="jadwalTableBody">
                                    {{-- Baris di-render oleh JS (lihat initJadwalPagination), sama seperti tabel Dosen --}}
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination client-side, sama persis polanya dengan halaman Dosen --}}
                        <div class="pagination-container">
                            <p class="pagination-info" id="jadwalPaginationInfo">Showing 0 to 0 of 0 entries</p>
                            <div class="pagination-buttons" id="jadwalPaginationButtons"></div>
                        </div>
                    </div>

                    <div class="content-box" style="margin-top: 24px; animation-delay: 0.7s; opacity: 0; animation: fadeInUp 0.6s ease-out forwards;">
                        <div class="table-header"><h2>Grafik Jumlah Kelas Mingguan Fakultas</h2></div>
                        <div style="height: 220px; position: relative;"><canvas id="statistikChart"></canvas></div>
                    </div>
                </div>
                
                <div class="right-content">
                    <div class="content-box" style="animation-delay: 0.5s; opacity: 0; animation: fadeInUp 0.6s ease-out forwards;">
                        <div class="calendar-header"><h2 id="calendar-month-year"></h2></div>
                        <div class="calendar-days"><span>Min</span><span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span></div>
                        <div class="calendar-dates" id="calendar-dates-container"></div>
                    </div>
                    <div class="content-box" style="animation-delay: 0.6s; opacity: 0; animation: fadeInUp 0.6s ease-out forwards;">
                        <div class="ruangan-header">
                            <a href="{{ url('/ruangan') }}">
                                <h2>Ruangan Terpakai Saat Ini</h2>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                        <div id="room-status-container">
                            @forelse($ruanganTerpakai ?? [] as $ruangan)
                                <div class="room-item"><div class="room-left"><div class="room-icon blue-bg"><i class="fa-solid fa-chalkboard-user"></i></div><div class="room-text"><h4>Ruang {{ $ruangan->ruang }}</h4><p>{{ Str::limit($ruangan->matakuliah, 20) }}</p></div></div><span class="room-status blue-status">Dipakai</span></div>
                            @empty
                                <div class="log-item border-gray" style="text-align: center; padding: 15px 0;"><span class="log-title text-muted">Semua Ruangan Kosong</span><p class="log-text" style="font-size: 13px;">Tidak ada kelas yang berlangsung saat ini.</p></div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        @elseif($userRole == 'mahasiswa')
            <div class="welcome-card"><div class="welcome-text"><h2>Selamat Datang, {{ strtok(Auth::user()->name, ' ') }}!</h2>@if(isset($mahasiswa))<p>Anda login sebagai mahasiswa <strong>{{ $mahasiswa->jurusan ?? 'N/A' }} - Kelas {{ $mahasiswa->id_kelas ?? $mahasiswa->kelas ?? 'N/A' }} (Semester {{ $semesterRomawi ?? '-' }})</strong>.</p>@endif</div></div>

            @if (isset($jadwalBerikutnya) && $jadwalBerikutnya)
                <div class="reminder-card" data-countdown="{{ $detikMenujuKelas }}"><i class="reminder-icon fa-solid fa-bell fa-shake"></i><div class="reminder-content"><p class="reminder-title">JADWAL KULIAH ANDA BERIKUTNYA</p><h3 class="reminder-matkul">{{ $jadwalBerikutnya->matakuliah }}</h3><div class="reminder-details"><span><i class="fa-solid fa-chalkboard-user"></i> {{ $jadwalBerikutnya->dosen->nama ?? 'N/A' }}</span><span><i class="fa-solid fa-location-dot"></i> Ruang {{ $jadwalBerikutnya->ruang }}</span><span><i class="fa-regular fa-clock"></i> {{ $jadwalBerikutnya->jam }}</span></div></div><div class="reminder-countdown"><p>DIMULAI DALAM</p><div id="countdown-timer">00:00:00</div></div></div>
            @else
                <div class="reminder-card empty"><i class="reminder-icon fa-solid fa-circle-check"></i><div class="reminder-content"><h3 class="reminder-matkul">Tidak Ada Jadwal Kuliah Lagi Untuk Hari Ini</h3><p style="opacity: 0.8; font-size: 0.9rem;">Semua kelas Anda untuk hari {{ $hariIni }} telah selesai. Selamat beristirahat!</p></div></div>
            @endif

            <section class="cards">
                <div class="card"><div class="card-icon maroon"><i class="fa-solid fa-hourglass-half"></i></div><div class="card-text"><h5>Total SKS Hari Ini</h5><h2>{{ $totalSksHariIni ?? 0 }}</h2></div></div>
                <div class="card"><div class="card-icon orange"><i class="fa-solid fa-book-open-reader"></i></div><div class="card-text"><h5>Total Matakuliah</h5><h2>{{ $totalMatkulHariIni ?? 0 }}</h2></div></div>
                <div class="card"><div class="card-icon green"><i class="fa-solid fa-check-double"></i></div><div class="card-text"><h5>Matakuliah Selesai</h5><h2>{{ $matkulSelesai ?? 0 }}</h2></div></div>
            </section>

            <div class="dashboard-grid">
                <div class="left-content">
                    <div class="content-box">
                        <div class="table-header"><h2>Jadwal Kuliah Anda Hari Ini ({{ $hariIni }})</h2></div>
                        <div class="table-responsive">
                            <table>
                                <thead><tr><th>Jam</th><th>Matakuliah</th><th>Dosen</th><th>Ruang</th><th>Status</th></tr></thead>
                                <tbody>
                                    @forelse($jadwalHariIni as $jadwal)
                                        <tr>
                                            <td>{{ $jadwal->jam }}</td><td><strong>{{ $jadwal->matakuliah }}</strong><br><small class="kelas-badge">{{ $jadwal->sks }} SKS</small></td><td>{{ $jadwal->dosen->nama ?? 'N/A' }}</td><td>{{ $jadwal->ruang }}</td>
                                            <td><span class="status {{ $jadwal->status_class }}">{{ $jadwal->status }}</span></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" style="text-align: center; padding: 20px;">Tidak ada jadwal kuliah hari ini. Selamat beristirahat!</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- PERMANENT PAGINATION (MHS) --}}
                        <div class="pagination-container">
                            @if(isset($jadwalHariIni) && $jadwalHariIni instanceof \Illuminate\Pagination\LengthAwarePaginator && $jadwalHariIni->hasPages())
                                <div class="pagination-info">Showing <strong>{{ $jadwalHariIni->firstItem() ?? 0 }}</strong> to <strong>{{ $jadwalHariIni->lastItem() ?? 0 }}</strong> of <strong>{{ $jadwalHariIni->total() ?? 0 }}</strong> entries</div>
                                <div class="pagination-wrapper">{{ $jadwalHariIni->links('pagination::bootstrap-4') }}</div>
                            @else
                                @php $totalItems = isset($jadwalHariIni) ? $jadwalHariIni->total() : 0; @endphp
                                <div class="pagination-info">Showing <strong>{{ $totalItems > 0 ? 1 : 0 }}</strong> to <strong>{{ $totalItems }}</strong> of <strong>{{ $totalItems }}</strong> entries</div>
                                <div class="pagination-static"><span class="disabled">&laquo; Previous</span><span class="active">1</span><span class="disabled">Next &raquo;</span></div>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="right-content">
                    <div class="content-box"><div class="calendar-header"><h2 id="calendar-month-year"></h2></div><div class="calendar-days"><span>Min</span><span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span></div><div class="calendar-dates" id="calendar-dates-container"></div></div>
                    <div class="content-box" style="animation-delay: 0.6s; opacity: 0; animation: fadeInUp 0.6s ease-out forwards;">
                        <div class="ruangan-header">
                             <a href="{{ url('/ruangan') }}">
                                <h2>Ruangan Terpakai Saat Ini</h2>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                        <div id="room-status-container">
                            @forelse($ruanganTerpakai ?? [] as $ruangan)
                                <div class="room-item"><div class="room-left"><div class="room-icon blue-bg"><i class="fa-solid fa-chalkboard-user"></i></div><div class="room-text"><h4>Ruang {{ $ruangan->ruang }}</h4><p>{{ Str::limit($ruangan->matakuliah, 20) }}</p></div></div><span class="room-status blue-status">Dipakai</span></div>
                            @empty
                                <div class="log-item border-gray" style="text-align: center; padding: 15px 0;"><span class="log-title text-muted">Semua Ruangan Kosong</span><p class="log-text" style="font-size: 13px;">Tidak ada kelas yang berlangsung saat ini.</p></div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- Dashboard.js (versi lama, pakai data mock statis) sudah TIDAK dipakai lagi di halaman ini.
         Semua fungsinya (render tabel, pagination, kalender, statistik, chart, dropdown) sudah
         digantikan oleh script inline di bawah ini yang memakai data ASLI dari database.
         File Dashboard.js tidak dihapus dari server, hanya tidak di-include di sini. --}}

    <script>
        // Oper seluruh jadwal hari ini ke JS, sama seperti window.dosenDariDatabase di halaman Dosen.
        // PENTING: kalau $jadwalHariIni masih hasil ->paginate() dari controller, ini cuma akan
        // berisi data 1 halaman (mis. 5-10 baris), bukan semua 35. Supaya pagination client-side ini
        // bekerja penuh (persis seperti Dosen), controller sebaiknya kirim koleksi LENGKAP tanpa
        // paginate (mis. ->get() bukan ->paginate()).
        window.jadwalHariIniData = @json(
            isset($jadwalHariIni)
                ? ($jadwalHariIni instanceof \Illuminate\Pagination\LengthAwarePaginator
                    ? $jadwalHariIni->items()
                    : $jadwalHariIni)
                : []
        );
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        /**
         * Inisialisasi semua fungsi interaktif setelah DOM selesai dimuat.
         */
        function initDropdowns() {
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

            if (notifBtn && notifDropdown) {
                notifBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    toggleDropdown(notifDropdown, dropdownMenu);
                });
            }

            document.addEventListener('click', () => {
                if (dropdownMenu) dropdownMenu.classList.remove('show');
                if (notifDropdown) notifDropdown.classList.remove('show');
            });
        }

        function initMahasiswaCountdown() {
            const reminderCard = document.querySelector('.reminder-card');
            if (!reminderCard || !reminderCard.dataset.countdown) return;

            let duration = parseInt(reminderCard.dataset.countdown, 10);
            const timerElement = document.getElementById('countdown-timer');
            if (!timerElement) return;

            const interval = setInterval(() => {
                if (duration <= 0) {
                    clearInterval(interval);
                    timerElement.textContent = "BERLANGSUNG";
                    window.location.reload();
                    return;
                }
                duration--;
                const hours = Math.floor(duration / 3600).toString().padStart(2, '0');
                const minutes = Math.floor((duration % 3600) / 60).toString().padStart(2, '0');
                const seconds = (duration % 60).toString().padStart(2, '0');
                timerElement.textContent = `${hours}:${minutes}:${seconds}`;
            }, 1000);
        }

        function initMiniCalendar() {
            const monthYearEl = document.getElementById('calendar-month-year');
            const datesContainer = document.getElementById('calendar-dates-container');
            if (!monthYearEl || !datesContainer) return;

            const today = new Date();
            const currentMonth = today.getMonth();
            const currentYear = today.getFullYear();
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

            monthYearEl.textContent = `${monthNames[currentMonth]} ${currentYear}`;
            datesContainer.innerHTML = '';

            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const lastDate = new Date(currentYear, currentMonth + 1, 0).getDate();

            for (let i = 0; i < firstDay; i++) {
                datesContainer.innerHTML += '<div></div>';
            }

            for (let i = 1; i <= lastDate; i++) {
                let div = document.createElement('div');
                div.textContent = i;
                if (i === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
                    div.classList.add('active-date');
                }
                datesContainer.appendChild(div);
            }
        }

        function initStatistikChart() {
            const ctx = document.getElementById('statistikChart');
            if (!ctx) return;

         const chartData = {!! json_encode($grafikData ?? [0, 0, 0, 0, 0]) !!};
const chartLabels = {!! json_encode($grafikLabels ?? ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']) !!};
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Jumlah Jadwal Matakuliah',
                        data: chartData,
                        backgroundColor: '#7d1626',
                        borderColor: '#430b16',
                        borderWidth: 1,
                        borderRadius: 6,
                        maxBarThickness: 42
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: { padding: { top: 8 } },
                    plugins: { legend: { display: false } },
                    animation: {
                        duration: 1200,
                        easing: 'easeOutQuart'
                    },
                    // PENTING: Chart.js menganggap pengukuran ukuran pertama kali
                    // (lewat ResizeObserver, kejadian sesaat setelah chart dibuat)
                    // sebagai "resize transition", BUKAN bagian dari animasi awal
                    // di atas. Transisi resize itu defaultnya duration:0 (instan),
                    // jadi tanpa baris ini, batang langsung snap ke ukuran akhir
                    // sepersekian detik setelah animasi "tumbuh dari 0" mulai —
                    // makanya animasinya kelihatan tidak pernah jalan sama sekali.
                    transitions: {
                        resize: {
                            animation: {
                                duration: 1200,
                                easing: 'easeOutQuart'
                            }
                        }
                    },
                    scales: {
                        x: { grid: { display: false }, ticks: { font: { family: "Inter", size: 12 }, color: "#8c8386" } },
                        y: {
                            beginAtZero: true,
                            grid: { color: "#f2f4f7" },
                            ticks: {
                                font: { family: "Inter", size: 12 },
                                color: "#8c8386",
                                maxTicksLimit: 6
                            }
                        }
                    }
                }
            });
        }

        const itemPerHalamanJadwal = 5; // sama seperti tampilan "5 entries" sebelumnya
        let halamanJadwalSekarang = 1;

        // Hitung status (Akan Datang / Berjalan / Selesai) dari jam asli di database,
        // karena data dari backend tidak menyertakan field status siap pakai.
        function hitungStatusJadwal(jamString) {
            if (!jamString) return { text: '-', cls: '' };
            const now = new Date();
            const currTimeStr = String(now.getHours()).padStart(2, '0') + '.' + String(now.getMinutes()).padStart(2, '0');
            const jamParts = jamString.includes(' - ') ? jamString.split(' - ') : jamString.split('-');
            const jamMulai = jamParts[0]?.trim().replace(':', '.');
            const jamSelesai = jamParts[1]?.trim().replace(':', '.');
            if (!jamMulai || !jamSelesai) return { text: '-', cls: '' };

            if (currTimeStr < jamMulai) return { text: 'Akan Datang', cls: 'info' };
            if (currTimeStr >= jamMulai && currTimeStr <= jamSelesai) return { text: 'Berjalan', cls: 'success pulsing' };
            return { text: 'Selesai', cls: 'gray-badge' };
        }

        // Tabel "Jadwal Fakultas Hari Ini" secara default cuma menampilkan kelas
        // yang masih Berjalan atau Akan Datang. Yang sudah Selesai tetap ada di
        // dataJadwalSemua (bisa dimunculkan lagi lewat toggle "Tampilkan yang
        // sudah selesai") — bukan dibuang permanen, cuma disembunyikan.
        const dataJadwalSemua = window.jadwalHariIniData || [];
        let tampilkanSelesai = false;
        let dataJadwalLengkap = dataJadwalSemua.filter(
            (jadwal) => hitungStatusJadwal(jadwal.jam).text !== 'Selesai'
        );

        function terapkanFilterJadwal() {
            dataJadwalLengkap = tampilkanSelesai
                ? dataJadwalSemua
                : dataJadwalSemua.filter(
                      (jadwal) => hitungStatusJadwal(jadwal.jam).text !== 'Selesai'
                  );
            halamanJadwalSekarang = 1; // balik ke halaman 1 supaya tidak "nyangkut" di halaman kosong
            renderTabelJadwal();
            updatePaginationJadwalUI();
        }

        function renderTabelJadwal() {
            const tbody = document.getElementById('jadwalTableBody');
            if (!tbody) return;
            tbody.innerHTML = '';

            if (dataJadwalLengkap.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" style="text-align:center; padding:40px; color:#8c8386;">Tidak ada kelas yang sedang berjalan atau akan datang hari ini (kemungkinan semua jadwal hari ini sudah selesai, atau memang tidak ada jadwal).</td></tr>';
                updateJadwalPaginationInfo(0, 0);
                return;
            }

            const indexMulai = (halamanJadwalSekarang - 1) * itemPerHalamanJadwal;
            const dataPerHalaman = dataJadwalLengkap.slice(indexMulai, indexMulai + itemPerHalamanJadwal);

            dataPerHalaman.forEach((jadwal) => {
                const tr = document.createElement('tr');
                const namaDosen = (jadwal.dosen && jadwal.dosen.nama) ? jadwal.dosen.nama : 'N/A';
                const status = hitungStatusJadwal(jadwal.jam);
                tr.innerHTML = `
                    <td>${jadwal.jam ?? ''}</td>
                    <td style="font-weight: 600;">${jadwal.matakuliah ?? ''}</td>
                    <td>${namaDosen}</td>
                    <td>${jadwal.ruang ?? ''}</td>
                    <td>${jadwal.jurusan ?? ''}</td>
                    <td><span class="kelas-badge">${jadwal.kelas ?? ''}</span></td>
                    <td><span class="status ${status.cls}">${status.text}</span></td>
                `;
                tbody.appendChild(tr);
            });

            updateJadwalPaginationInfo(indexMulai, indexMulai + dataPerHalaman.length);
        }

        function updateJadwalPaginationInfo(start, end) {
            const info = document.getElementById('jadwalPaginationInfo');
            if (!info) return;
            const total = dataJadwalLengkap.length;
            info.innerHTML = total === 0
                ? 'Showing <strong>0</strong> to <strong>0</strong> of <strong>0</strong> entries'
                : `Showing <strong>${start + 1}</strong> to <strong>${Math.min(end, total)}</strong> of <strong>${total}</strong> entries`;
        }

        function updatePaginationJadwalUI() {
            const container = document.getElementById('jadwalPaginationButtons');
            if (!container) return;
            container.innerHTML = '';

            const totalHalaman = Math.ceil(dataJadwalLengkap.length / itemPerHalamanJadwal);
            if (totalHalaman <= 1) return;

            const btnPrev = document.createElement('button');
            btnPrev.className = 'page-btn prev-btn';
            btnPrev.innerHTML = '<i class="fa-solid fa-chevron-left"></i>';
            btnPrev.disabled = halamanJadwalSekarang === 1;
            btnPrev.addEventListener('click', () => ubahHalamanJadwal(halamanJadwalSekarang - 1));
            container.appendChild(btnPrev);

            for (let i = 1; i <= totalHalaman; i++) {
                const btn = document.createElement('button');
                btn.className = i === halamanJadwalSekarang ? 'page-btn active-page' : 'page-btn';
                btn.innerText = i;
                btn.addEventListener('click', () => ubahHalamanJadwal(i));
                container.appendChild(btn);
            }

            const btnNext = document.createElement('button');
            btnNext.className = 'page-btn next-btn';
            btnNext.innerHTML = '<i class="fa-solid fa-chevron-right"></i>';
            btnNext.disabled = halamanJadwalSekarang === totalHalaman;
            btnNext.addEventListener('click', () => ubahHalamanJadwal(halamanJadwalSekarang + 1));
            container.appendChild(btnNext);
        }

        function ubahHalamanJadwal(halamanTujuan) {
            halamanJadwalSekarang = halamanTujuan;
            renderTabelJadwal();
            updatePaginationJadwalUI();
        }

        function initJadwalPagination() {
            if (!document.getElementById('jadwalTableBody')) return;
            renderTabelJadwal();
            updatePaginationJadwalUI();

            const toggleSelesai = document.getElementById('toggleTampilkanSelesai');
            if (toggleSelesai) {
                toggleSelesai.addEventListener('change', () => {
                    tampilkanSelesai = toggleSelesai.checked;
                    terapkanFilterJadwal();
                });
            }
        }

        // Panggil semua fungsi inisialisasi
        initDropdowns();
        initMahasiswaCountdown();
        initMiniCalendar();
        // Kotak grafik ini fade-in dengan animation-delay 0.7s + durasi 0.6s
        // (selesai terlihat penuh di ~1.3s). Kalau chart di-render lebih awal
        // dari itu, animasi "batang tumbuh dari 0" bawaan Chart.js akan sudah
        // selesai duluan sebelum kotaknya kelihatan (opacity masih 0) — jadi
        // yang user lihat cuma batang yang langsung penuh begitu kotaknya
        // muncul. Ditunda dulu supaya animasi tumbuhnya kelihatan.
        setTimeout(initStatistikChart, 1300);
        initJadwalPagination();
    });
    </script>
</body>
</html>