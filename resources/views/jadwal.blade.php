<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jadwal Perkuliahan - FIKOM UNIKA</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('Dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('Jadwal.css') }}" />
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

        <li class="active" onclick="window.location.href = '{{ url('/jadwal') }}'">
          <i class="fa-regular fa-calendar"></i>
          Jadwal
        </li>

        <li onclick="window.location.href = '{{ url('/dosen') }}'">
          <i class="fa-solid fa-users"></i>
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
          <i class="fa-solid fa-bars"></i>
          <h1>Jadwal</h1>
        </div>

        <div class="topbar-right">
          @include('partials.notification_bell', ['jadwalTerbaru' => $jadwalTerbaru ?? []])
          @include('partials.profile_dropdown')
        </div>
      </header>

      <section class="filter-section">
        <div class="filter-group">
          <label>Hari</label>
          <select id="filterHari">
            <option value="Semua">Semua</option>
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
          </select>
        </div>

        <div class="filter-group">
          <label>Jurusan</label>
          <select id="filterJurusan">
            <option value="Semua">Semua</option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Sains Data">Sains Data</option>
          </select>
        </div>

        <div class="filter-group">
          <label>Kelas</label>
          <select id="filterKelas">
            <option value="Semua">Semua</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
          </select>
        </div>

        <div class="filter-group">
          <label>Kategori Semester</label>
          <select id="filterKategoriSemester">
            <option value="Semua">Semua</option>
            <option value="Ganjil">Ganjil (I, III, V, VII)</option>
            <option value="Genap">Genap (II, IV, VI)</option>
          </select>
        </div>

        <div class="filter-group">
          <label>Semester</label>
          <select id="filterSemester">
            <option value="Semua">Semua</option>
            <option value="I">Semester 1</option>
            <option value="II">Semester 2</option>
            <option value="III">Semester 3</option>
            <option value="IV">Semester 4</option>
            <option value="V">Semester 5</option>
            <option value="VI">Semester 6</option>
            <option value="VII">Semester 7</option>
          </select>
        </div>

        <button class="btn-filter" id="btnFilter">Terapkan</button>
      </section>

      <section class="content-box">
        <div class="table-header">
          <h2>Data Jadwal Perkuliahan</h2>
          <div style="display: flex; gap: 12px;">
            @if(auth()->user()->role == 'admin')
            <button class="btn-filter" id="btnBukaModalTambah" style="display: flex; align-items: center; gap: 8px;">
              <i class="fa-solid fa-calendar-plus"></i> Tambah Jadwal
            </button>
            @endif
            <input type="date" id="inputTglMulaiKuliah" title="Tanggal Mulai Kuliah (untuk PDF)" style="padding:8px 10px; border:1px solid #ece5e3; border-radius:8px; outline:none; font-size:13px;">
            <button class="export-btn" id="exportPdfBtn">
              <i class="fa-solid fa-file-pdf"></i>
              Export PDF
            </button>
          </div>
        </div>

        <div class="search-box">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" id="searchInput" placeholder="Cari mata kuliah atau dosen..." />
        </div>

        <div class="table-wrapper" style="min-height: 250px;">
          <table>
            <thead>
              <tr>
                <th>Hari</th>
                <th>Jam</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Kelas</th>
                <th>Semester</th>
                <th>Ruangan</th>
                <th>Jurusan</th>
                @if(auth()->user()->role == 'admin')
                <th>Aksi</th>
                @endif
              </tr>
            </thead>

            <tbody id="jadwalBody">
  @forelse($jadwals as $jadwal)
    <tr>
      <td>{{ $jadwal->hari }}</td>
      <td>{{ $jadwal->jam }}</td>
      <td>
        <div class="matkul-cell">
          <h4>{{ $jadwal->matakuliah }}</h4>
          <span>{{ $jadwal->kode_jam }} • {{ $jadwal->sks }} SKS</span>
        </div>
      </td>
      {{-- Menampilkan nama dosen dari relasi --}}
      <td>{{ $jadwal->dosen ? $jadwal->dosen->nama : 'Dosen Tidak Ditemukan' }}</td> 
      <td><span class="kelas-badge"> {{ $jadwal->kelas }} </span></td>
      <td>{{ $jadwal->semester }}</td>
      <td>{{ $jadwal->ruang }}</td>
      <td>{{ $jadwal->jurusan }}</td>
    </tr>
  @empty
    <tr>
      <td colspan="8" style="text-align: center; padding: 30px;">
        <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; color: #8c8386;">
          <i class="fa-solid fa-calendar-xmark" style="font-size: 32px;"></i>
          <p>Belum ada jadwal perkuliahan.</p>
        </div>
      </td>
    </tr>
  @endforelse
</tbody>
          </table>
        </div>

        <div class="pagination">
          <p>Showing 1 to 4 of 42 entries</p>
          <div class="pagination-buttons">
            <button class="active-page">1</button>
            <button>2</button>
            <button>3</button>
          </div>
        </div>
      </section>

      <section class="jam-card">
        <div class="jam-title">
          <h2>Jam Perkuliahan</h2>
        </div>

        <div class="jam-grid">
          <div class="jam-column">
            <div class="jam-row">
              <h4>AB</h4>
              <p>08.00-09.40</p>
            </div>
            <div class="jam-row">
              <h4>ABC</h4>
              <p>08.00-10.30</p>
            </div>
            <div class="jam-row">
              <h4>CD</h4>
              <p>09.50-11.30</p>
            </div>
            <div class="jam-row">
              <h4>CDE</h4>
              <p>09.50-12.20</p>
            </div>
          </div>

          <div class="jam-column">
            <div class="jam-row">
              <h4>DE</h4>
              <p>10.40-12.20</p>
            </div>
            <div class="jam-row">
              <h4>DEF</h4>
              <p>10.40-13.10</p>
            </div>
            <div class="jam-row">
              <h4>EF</h4>
              <p>11.40-13.20</p>
            </div>
            <div class="jam-row">
              <h4>GH</h4>
              <p>14.00-15.40</p>
            </div>
            <div class="jam-row">
              <h4>GHI</h4>
              <p>14.00-16.30</p>
            </div>
          </div>

          <div class="jam-column">
            <div class="jam-row">
              <h4>IJ</h4>
              <p>15.50-17.30</p>
            </div>
            <div class="jam-row">
              <h4>IJK</h4>
              <p>15.50-18.20</p>
            </div>
            <div class="jam-row">
              <h4>JK</h4>
              <p>15.50-18.20</p>
            </div>
            <div class="jam-row">
              <h4>JKL</h4>
              <p>16.40-19.10</p>
            </div>
          </div>
        </div>
      </section>
    </main>

@if(auth()->user()->role == 'admin')
<div id="modalTambahJadwal" class="modal-overlay">
  <div class="modal-content" style="width: 500px; max-width: 95%;">
    <div class="modal-header">
      <h2><i class="fa-solid fa-calendar-plus" style="color: #641021; margin-right: 8px;"></i>Tambah Jadwal Baru</h2>
      <i class="fa-solid fa-xmark close-modal" id="closeModalTambah"></i>
    </div>
    <form id="formTambahJadwal">
      <div class="modal-body" style="display: flex; flex-direction: column; gap: 14px; max-height: 70vh; overflow-y: auto; padding-right: 5px;">
        
        <div style="display: flex; flex-direction: column; gap: 6px;">
          <label style="font-size: 13px; font-weight: 600; color: #4a4144;">Hari Perkuliahan</label>
          <select id="inputHari" name="hari" required style="width:100%; padding:10px; border:1px solid #ece5e3; border-radius:8px; outline:none;">
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
          </select>
        </div>

        <div style="display: flex; flex-direction: column; gap: 6px;">
          <label style="font-size: 13px; font-weight: 600; color: #4a4144;">Kode Blok Jam</label>
          <select id="inputKodeJam" name="kode_jam" required style="width:100%; padding:10px; border:1px solid #ece5e3; border-radius:8px; outline:none;">
            <option value="" disabled selected>Pilih Kode Blok Jam</option>
            <option value="AB" data-jam="08.00-09.40" data-sks="2">AB &nbsp; (08.00-09.40)</option>
            <option value="ABC" data-jam="08.00-10.30" data-sks="3">ABC &nbsp; (08.00-10.30)</option>
            <option value="CD" data-jam="09.50-11.30" data-sks="2">CD &nbsp; (09.50-11.30)</option>
            <option value="CDE" data-jam="09.50-12.20" data-sks="3">CDE &nbsp; (09.50-12.20)</option>
            <option value="DE" data-jam="10.40-12.20" data-sks="2">DE &nbsp; (10.40-12.20)</option>
            <option value="DEF" data-jam="10.40-13.10" data-sks="3">DEF &nbsp; (10.40-13.10)</option>
            <option value="EF" data-jam="11.40-13.20" data-sks="2">EF &nbsp; (11.40-13.20)</option>
            <option value="GH" data-jam="14.00-15.40" data-sks="2">GH &nbsp; (14.00-15.40)</option>
            <option value="GHI" data-jam="14.00-16.30" data-sks="3">GHI &nbsp; (14.00-16.30)</option>
            <option value="IJ" data-jam="15.50-17.30" data-sks="2">IJ &nbsp; (15.50-17.30)</option>
            <option value="IJK" data-jam="15.50-18.20" data-sks="3">IJK &nbsp; (15.50-18.20)</option>
            <option value="JK" data-jam="15.50-18.20" data-sks="2">JK &nbsp; (15.50-18.20)</option>
            <option value="JKL" data-jam="16.40-19.10" data-sks="3">JKL &nbsp; (16.40-19.10)</option>
          </select>
        </div>

        {{-- Jam Kuliah tidak lagi ditampilkan sebagai field terpisah,
             karena keterangan jamnya sudah tampil di tiap opsi Kode
             Blok Jam di atas (mis. "AB (08.00-09.40)") — jadi dulu
             informasinya duplikat. Nilainya tetap dikirim ke backend
             lewat hidden input ini, otomatis terisi sesuai Kode Blok
             Jam yang dipilih. --}}
        <input type="hidden" id="inputJam" name="jam">

        <script>
          // Bobot SKS tidak lagi diketik manual — otomatis terisi sesuai
          // Kode Blok Jam yang dipilih (data-jam & data-sks pada tiap
          // <option>), supaya bobot SKS-nya nyambung dengan durasi blok
          // jamnya. Bobot SKS tetap bisa diubah manual kalau memang ada
          // kasus khusus (mis. praktikum dengan bobot berbeda dari aturan
          // umum).
          document.getElementById('inputKodeJam').addEventListener('change', function () {
            const opt = this.options[this.selectedIndex];
            document.getElementById('inputJam').value = opt.dataset.jam || '';
            if (opt.dataset.sks) {
              document.getElementById('inputSks').value = opt.dataset.sks;
            }
          });
        </script>

        <div style="display: flex; flex-direction: column; gap: 6px;">
          <label style="font-size: 13px; font-weight: 600; color: #4a4144;">Nama Mata Kuliah</label>
          <input type="text" id="inputMatkul" name="matakuliah" placeholder="Masukkan nama mata kuliah..." required style="width:100%; padding:10px; border:1px solid #ece5e3; border-radius:8px; outline:none;">
        </div>

        <div style="display: flex; gap: 12px;">
          <div style="flex: 2; display: flex; flex-direction: column; gap: 6px; position: relative;">
            <label style="font-size: 13px; font-weight: 600; color: #4a4144;">Nama Kelas</label>
            <input type="hidden" id="inputKelas" name="kelas">
            <button type="button" id="btnDropdownKelas" style="width:100%; padding:10px; border:1px solid #ece5e3; border-radius:8px; outline:none; background:#fff; text-align:left; cursor:pointer; color:#98a2b3;">
              Pilih Kelas...
            </button>
            <div id="listDropdownKelas" style="display:none; position:absolute; top:100%; left:0; right:0; margin-top:4px; background:#fff; border:1px solid #ece5e3; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.08); z-index:20; padding:8px;">
              <label style="display:flex; align-items:center; gap:8px; padding:6px 4px; cursor:pointer; font-size:14px;"><input type="checkbox" value="A" class="chkKelas"> Kelas A</label>
              <label style="display:flex; align-items:center; gap:8px; padding:6px 4px; cursor:pointer; font-size:14px;"><input type="checkbox" value="B" class="chkKelas"> Kelas B</label>
              <label style="display:flex; align-items:center; gap:8px; padding:6px 4px; cursor:pointer; font-size:14px;"><input type="checkbox" value="C" class="chkKelas"> Kelas C</label>
              <label style="display:flex; align-items:center; gap:8px; padding:6px 4px; cursor:pointer; font-size:14px;"><input type="checkbox" value="D" class="chkKelas"> Kelas D</label>
            </div>
          </div>
          <script>
            // Dropdown checkbox Nama Kelas: gabungkan checkbox terpilih (mis. A+B+C)
            // jadi satu string "ABC" yang disimpan di input hidden name="kelas",
            // supaya tetap kompatibel dengan validasi backend (kelas => string)
            // tanpa perlu ubah JadwalController.php.
            (function () {
              const btnDropdown = document.getElementById('btnDropdownKelas');
              const listDropdown = document.getElementById('listDropdownKelas');
              const inputHidden = document.getElementById('inputKelas');
              const checkboxes = document.querySelectorAll('.chkKelas');
              const formTambahEl = document.getElementById('formTambahJadwal');

              function perbaruiTeksTombol() {
                const terpilih = Array.from(checkboxes)
                  .filter(c => c.checked)
                  .map(c => c.value);
                inputHidden.value = terpilih.join('');
                btnDropdown.textContent = terpilih.length ? terpilih.join(', ') : 'Pilih Kelas...';
                btnDropdown.style.color = terpilih.length ? '#4a4144' : '#98a2b3';
              }

              if (btnDropdown) {
                btnDropdown.addEventListener('click', (e) => {
                  e.stopPropagation();
                  listDropdown.style.display = listDropdown.style.display === 'none' ? 'block' : 'none';
                });
              }

              checkboxes.forEach(c => c.addEventListener('change', perbaruiTeksTombol));

              // Tutup dropdown kalau klik di luar area
              document.addEventListener('click', (e) => {
                if (listDropdown && !listDropdown.contains(e.target) && e.target !== btnDropdown) {
                  listDropdown.style.display = 'none';
                }
              });

              // Reset checkbox saat form Tambah Jadwal di-reset (modal dibuka ulang)
              if (formTambahEl) {
                formTambahEl.addEventListener('reset', () => {
                  checkboxes.forEach(c => c.checked = false);
                  perbaruiTeksTombol();
                });
              }
            })();
          </script>
          <div style="flex: 1; display: flex; flex-direction: column; gap: 6px;">
            <label style="font-size: 13px; font-weight: 600; color: #4a4144;">Bobot SKS</label>
            <input type="number" id="inputSks" name="sks" min="1" max="6" value="3" required style="width:100%; padding:10px; border:1px solid #ece5e3; border-radius:8px; outline:none;">
          </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 6px;">
          <label style="font-size: 13px; font-weight: 600; color: #4a4144;">Dosen Pengampu</label>
          <select id="selectDosenPengampu" name="dosen_id" required style="width:100%; padding:10px; border:1px solid #ece5e3; border-radius:8px; outline:none;">
            <option value="" disabled selected>Pilih Dosen Pengampu</option>
            {{-- Mengambil data asli dari database agar ID-nya akurat --}}
            @foreach($dosens as $dosen)
              <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
            @endforeach
          </select>
        </div>

        <div style="display: flex; gap: 12px;">
          <div style="flex: 1; display: flex; flex-direction: column; gap: 6px;">
            <label style="font-size: 13px; font-weight: 600; color: #4a4144;">Semester</label>
            <select id="inputSemester" name="semester" required style="width:100%; padding:10px; border:1px solid #ece5e3; border-radius:8px; outline:none;">
              <optgroup label="Semester Ganjil">
                <option value="I">I</option>
                <option value="III">III</option>
                <option value="V">V</option>
                <option value="VII">VII</option>
              </optgroup>
              <optgroup label="Semester Genap">
                <option value="II">II</option>
                <option value="IV">IV</option>
                <option value="VI">VI</option>
              </optgroup>
            </select>
          </div>
          <div style="flex: 1; display: flex; flex-direction: column; gap: 6px;">
            <label style="font-size: 13px; font-weight: 600; color: #4a4144;">Ruangan Gedung</label>
            <select id="inputRuang" name="ruang" required style="width:100%; padding:10px; border:1px solid #ece5e3; border-radius:8px; outline:none;">
              <option value="" disabled selected>Pilih Ruangan</option>
              <optgroup label="Gedung I">
                <option value="I/1">I/1</option>
                <option value="I/2">I/2</option>
                <option value="I/3">I/3</option>
                <option value="I/4">I/4</option>
                <option value="I/5">I/5</option>
                <option value="I/6">I/6</option>
                <option value="I/7">I/7</option>
              </optgroup>
              <optgroup label="Gedung II">
                <option value="II/1">II/1</option>
                <option value="II/2">II/2</option>
              </optgroup>
              <optgroup label="Gedung III">
                <option value="III/1">III/1</option>
                <option value="III/2">III/2</option>
              </optgroup>
              <optgroup label="Laboratorium">
                <option value="Lab. A">Lab. A</option>
                <option value="Lab. B">Lab. B</option>
                <option value="Lab. C">Lab. C</option>
                <option value="Lab. D">Lab. D</option>
                <option value="Lab. E">Lab. E</option>
                <option value="Lab. G">Lab. G</option>
              </optgroup>
            </select>
          </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 6px;">
          <label style="font-size: 13px; font-weight: 600; color: #4a4144;">Homebase Program Studi / Jurusan</label>
          <select id="inputJurusan" name="jurusan" required style="width:100%; padding:10px; border:1px solid #ece5e3; border-radius:8px; outline:none;">
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Sains Data">Sains Data</option>
          </select>
        </div>

      </div>
      <div class="modal-footer" style="margin-top: 24px; border-top: 1px solid #ece5e3; padding-top: 15px;">
        <button type="button" id="btnBatalTambah" style="background-color: #8c8386; color: white;">Batal</button>
        <button type="submit" style="background-color: #641021; color: white;"><i class="fa-solid fa-floppy-disk"></i> Simpan Jadwal</button>
      </div>
    </form>
  </div>
</div>
@endif
    
    <!-- Load jsPDF and AutoTable for PDF Export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>

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

        if(profileBtn && dropdownMenu) {
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
  const dbJadwals = @json($jadwals);
  window.userRole = "{{ auth()->user()->role ?? 'guest' }}";
  window.masterJadwalDB = dbJadwals.map(j => ({
      id: j.id,
      hari: j.hari,
      jam: j.jam,
      kodeJam: j.kode_jam,
      matakuliah: j.matakuliah,
      kelas: j.kelas,
      sks: j.sks,
      dosen: j.dosen ? j.dosen.nama : 'Dosen Tidak Ditemukan',
      dosenId: j.dosen_id,
      ruang: j.ruang,
      semester: j.semester,
      jurusan: j.jurusan
  }));
</script>

    {{-- SCRIPT UNTUK TAMBAH JADWAL VIA AJAX --}}
    {{-- PERBAIKAN: sebelumnya ada 2 blok script terpisah yang sama-sama
         listen ke event submit form ini, sehingga setiap tambah jadwal
         baris barunya muncul dobel di tabel. Sekarang digabung jadi 1 blok. --}}
@if(auth()->user()->role == 'admin')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalTambahJadwal');
    const form = document.getElementById('formTambahJadwal');
    const btnBukaModal = document.getElementById('btnBukaModalTambah');
    const btnCloseModal = document.getElementById('closeModalTambah');
    const btnBatal = document.getElementById('btnBatalTambah');

    // Logika buka/tutup modal
    if (btnBukaModal) btnBukaModal.addEventListener('click', () => {
      form.reset(); // Bersihkan bekas input lama (termasuk checkbox Kelas) sebelum modal terbuka
      modal.classList.add('show');
    });
    if (btnCloseModal) btnCloseModal.addEventListener('click', () => modal.classList.remove('show'));
    if (btnBatal) btnBatal.addEventListener('click', () => modal.classList.remove('show'));

    if (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Validasi: minimal satu kelas harus dipilih di dropdown checkbox
        const inputKelasEl = document.getElementById('inputKelas');
        if (!inputKelasEl.value) {
          showToast('Pilih minimal satu Kelas terlebih dahulu.', 'error');
          return;
        }

        const formData = new FormData(form);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('{{ route("jadwal.tambah") }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
          },
          body: formData
        })
          .then(response => response.json())
          .then(result => {
            if (result.success) {
              modal.classList.remove('show');
              form.reset();

              // Format jadwal baru dari response DB, sertakan id
              const j = result.data;
              const jadwalBaru = {
                id: j.id, // <-- PERBAIKAN: tangkap id dari response
                hari: j.hari,
                jam: j.jam,
                kodeJam: j.kode_jam,
                matakuliah: j.matakuliah,
                kelas: j.kelas,
                sks: j.sks,
                dosen: j.dosen ? j.dosen.nama : 'Dosen Tidak Ditemukan',
                dosenId: j.dosen_id,
                ruang: j.ruang,
                semester: j.semester,
                jurusan: j.jurusan
              };

              // Masukkan ke array utama JS (paling atas)
              masterJadwal.unshift(jadwalBaru);

              // PENTING: window.masterJadwalDB juga harus disinkronkan di sini.
              // Ini sumber data yang dibaca perbaruiOpsiBentrok() untuk cek
              // ruangan/dosen bentrok. Kalau tidak ikut ditambahkan, jadwal
              // yang baru saja disimpan belum akan terdeteksi bentrok sampai
              // halaman di-refresh manual.
              if (window.masterJadwalDB) {
                window.masterJadwalDB.unshift(jadwalBaru);
              }

              // Panggil ulang fungsi render JS agar tabel & pagination otomatis terupdate
              halamanSekarang = 1;
              jalankanPenyaringanData();

              showToast(result.message, 'success');
            } else {
              showToast('Gagal: ' + (result.message || 'Periksa kembali data Anda.'), 'error');
            }
          })
          .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan teknis saat mengirim data.', 'error');
          });
      });
    }
  });
</script>
{{-- FITUR: auto-disable opsi Ruangan & Dosen yang sudah bentrok.
     Begitu Hari + Kode Jam + Semester di form Tambah Jadwal cocok
     dengan jadwal yang sudah ada (hari+jam+kategori semester sama),
     opsi Ruangan yang sudah dipakai dan opsi Dosen yang sudah
     mengajar di slot itu otomatis di-disable di dropdown-nya --
     jadi tidak bisa dipilih sama sekali, bukan cuma ditolak
     setelah submit. Logika kategori semester (Ganjil/Genap) sengaja
     disamakan persis dengan JadwalController::kategoriSemester()
     di backend supaya perilakunya konsisten. --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const GANJIL_LIST = ['I', 'III', 'V', 'VII', '1', '3', '5', '7'];
    const kategoriSemesterJS = (semester) => {
      return GANJIL_LIST.includes(String(semester).trim().toUpperCase()) ? 'Ganjil' : 'Genap';
    };

    const inputHari = document.getElementById('inputHari');
    const inputKodeJam = document.getElementById('inputKodeJam');
    const inputJam = document.getElementById('inputJam');
    const inputSemester = document.getElementById('inputSemester');
    const inputJurusan = document.getElementById('inputJurusan');
    const selectRuang = document.getElementById('inputRuang');
    const selectDosen = document.getElementById('selectDosenPengampu');
    const chkKelasList = document.querySelectorAll('.chkKelas');
    const btnBukaModal = document.getElementById('btnBukaModalTambah');

    if (!inputHari || !selectRuang || !selectDosen) return; // bukan admin / elemen tidak ada

    const perbaruiOpsiBentrok = () => {
      // Reset dulu semua opsi, supaya status disable dari kombinasi
      // sebelumnya tidak "nyangkut" di kombinasi yang baru dipilih.
      [...selectRuang.options].forEach(opt => {
        opt.disabled = false;
        opt.textContent = opt.textContent.replace(' (Terpakai)', '');
      });
      [...selectDosen.options].forEach(opt => {
        opt.disabled = false;
        opt.textContent = opt.textContent.replace(' (Sudah Ada Jadwal)', '');
      });
      chkKelasList.forEach(chk => {
        chk.disabled = false;
        const labelEl = chk.closest('label');
        if (labelEl) labelEl.style.opacity = '1';
        const span = labelEl ? labelEl.querySelector('.tandaBentrokKelas') : null;
        if (span) span.remove();
      });

      const hari = inputHari.value;
      const jam = inputJam.value;
      const semester = inputSemester.value;
      const jurusan = inputJurusan ? inputJurusan.value : '';
      if (!hari || !jam || !semester) return; // data belum lengkap, belum bisa dicek

      const kategori = kategoriSemesterJS(semester);
      const bentrokList = (window.masterJadwalDB || []).filter(j =>
        j.hari === hari && j.jam === jam && kategoriSemesterJS(j.semester) === kategori
      );

      const ruangTerpakai = new Set(bentrokList.map(j => j.ruang));
      const dosenTerpakai = new Set(bentrokList.map(j => String(j.dosenId)).filter(Boolean));

      [...selectRuang.options].forEach(opt => {
        if (opt.value && ruangTerpakai.has(opt.value)) {
          opt.disabled = true;
          opt.textContent += ' (Terpakai)';
          if (selectRuang.value === opt.value) selectRuang.value = '';
        }
      });

      [...selectDosen.options].forEach(opt => {
        if (opt.value && dosenTerpakai.has(opt.value)) {
          opt.disabled = true;
          opt.textContent += ' (Sudah Ada Jadwal)';
          if (selectDosen.value === opt.value) selectDosen.value = '';
        }
      });

      // Bentrok Kelas: dicek persis sampai ke Semester (bukan cuma
      // kategori Ganjil/Genap) + Jurusan yang sama, karena "Kelas A" di
      // Semester II itu kelompok mahasiswa yang beda dari "Kelas A" di
      // Semester IV meski labelnya sama. Satu kelas juga bisa berisi
      // gabungan huruf (mis. "ABC"), makanya di-split per huruf.
      if (jurusan) {
        const bentrokListKelas = (window.masterJadwalDB || []).filter(j =>
          j.hari === hari && j.jam === jam &&
          String(j.semester).trim().toUpperCase() === String(semester).trim().toUpperCase() &&
          j.jurusan === jurusan
        );
        const kelasTerpakai = new Set(
          bentrokListKelas.flatMap(j => String(j.kelas || '').split(''))
        );

        chkKelasList.forEach(chk => {
          if (kelasTerpakai.has(chk.value)) {
            chk.disabled = true;
            const labelEl = chk.closest('label');
            if (labelEl) {
              labelEl.style.opacity = '0.5';
              if (!labelEl.querySelector('.tandaBentrokKelas')) {
                const span = document.createElement('span');
                span.className = 'tandaBentrokKelas';
                span.style.cssText = 'font-size:12px; color:#b30000; margin-left:4px;';
                span.textContent = '(Sudah Ada Jadwal)';
                labelEl.appendChild(span);
              }
            }
            // Kalau sebelumnya sudah tercentang lalu jadi bentrok
            // (mis. gara-gara ganti Hari/Jam/Semester/Jurusan setelahnya),
            // otomatis dicentang-ulang jadi kosong + trigger update
            // hidden input & teks tombol lewat event 'change' bawaan.
            if (chk.checked) {
              chk.checked = false;
              chk.dispatchEvent(new Event('change'));
            }
          }
        });
      }
    };

    ['change'].forEach(evt => {
      inputHari.addEventListener(evt, perbaruiOpsiBentrok);
      inputKodeJam.addEventListener(evt, perbaruiOpsiBentrok);
      inputSemester.addEventListener(evt, perbaruiOpsiBentrok);
      if (inputJurusan) inputJurusan.addEventListener(evt, perbaruiOpsiBentrok);
    });

    // Jalankan sekali pas modal dibuka, karena Hari & Semester
    // sudah punya nilai default terpilih dari awal (bukan placeholder).
    if (btnBukaModal) btnBukaModal.addEventListener('click', perbaruiOpsiBentrok);
  });
</script>
@endif
<script src="{{ asset('jadwal.js') }}"></script>
    <!-- Toast Notifikasi (pengganti alert() bawaan browser) -->
    <div id="toastContainer" style="position: fixed; top: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 12px; pointer-events: none;"></div>

    <style>
      .toast-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        min-width: 300px;
        max-width: 380px;
        background: #ffffff;
        border-radius: 10px;
        padding: 14px 16px;
        box-shadow: 0 8px 24px rgba(28, 21, 23, 0.18);
        border-left: 4px solid #641021;
        pointer-events: auto;
        transform: translateX(120%);
        opacity: 0;
        transition: transform 0.35s ease, opacity 0.35s ease;
      }
      .toast-item.show { transform: translateX(0); opacity: 1; }
      .toast-item.toast-success { border-left-color: #1f7a4d; }
      .toast-item.toast-error { border-left-color: #b3261e; }
      .toast-icon { font-size: 18px; margin-top: 1px; }
      .toast-success .toast-icon { color: #1f7a4d; }
      .toast-error .toast-icon { color: #b3261e; }
      .toast-body { flex: 1; font-size: 13.5px; color: #1c1517; line-height: 1.45; }
      .toast-close { cursor: pointer; color: #8c8386; font-size: 13px; margin-top: 2px; }
      .toast-close:hover { color: #4a4144; }
    </style>

    <script>
      // Toast notifikasi ringan, gantinya alert() bawaan browser.
      // Dipakai lewat: showToast('Pesan...', 'success' | 'error')
      function showToast(message, type = 'success', durasiMs = 4500) {
        const container = document.getElementById('toastContainer');
        if (!container) { alert(message); return; } // fallback kalau container belum ada

        const toast = document.createElement('div');
        toast.className = `toast-item toast-${type}`;
        const icon = type === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation';
        toast.innerHTML = `
          <i class="fa-solid ${icon} toast-icon"></i>
          <div class="toast-body">${message}</div>
          <i class="fa-solid fa-xmark toast-close"></i>
        `;
        container.appendChild(toast);

        // Trigger animasi masuk
        requestAnimationFrame(() => toast.classList.add('show'));

        const hapusToast = () => {
          toast.classList.remove('show');
          setTimeout(() => toast.remove(), 350);
        };

        toast.querySelector('.toast-close').addEventListener('click', hapusToast);
        setTimeout(hapusToast, durasiMs);
      }
    </script>
  </body>
</html>