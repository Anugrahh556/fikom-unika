// =========================================================================
// 1. MASTER INDUK DATABASE RUANGAN FIKOM UNIKA (SENIN - JUMAT)
// =========================================================================
const masterRuanganFikom = {
    Senin: [
        {
            id: "Senin-1",
            nama: "1/1",
            status: "Dipakai",
            matkul: "Statistika (A)",
            dosen: "Desinta Purba, ST, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "09.40",
            sks: 2,
            semester: "II",
            kelas: "A",
            jurusan: "Sistem Informasi",
            nextMatkul: "Statistika (B)",
            nextDosen: "Desinta Purba, ST, M.Kom",
            nextJamMulai: "09.50",
            nextJamSelesai: "11.30",
            nextSks: 2,
            nextSemester: "II",
            nextKelas: "B",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Senin-2",
            nama: "1/2",
            status: "Dipakai",
            matkul: "Struktur Data (A)",
            dosen: "Drs. Lamhot Sitorus, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "II",
            kelas: "A",
            jurusan: "Teknik Informatika",
            nextMatkul: "Struktur Data (B)",
            nextDosen: "Drs. Lamhot Sitorus, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "II",
            nextKelas: "B",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Senin-3",
            nama: "1/3",
            status: "Dipakai",
            matkul: "Pemrograman Web (A)",
            dosen: "Wasit Ginting, S.Kom, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "IV",
            kelas: "A",
            jurusan: "Teknik Informatika",
            nextMatkul: "Pemrograman Web (D)",
            nextDosen: "Romanus Damanik, S.Kom, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "IV",
            nextKelas: "D",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Senin-4",
            nama: "1/4",
            status: "Kosong",
            matkul: "-",
            dosen: "-",
            jamMulai: "-",
            jamSelesai: "-",
            sks: 0,
            semester: "-",
            kelas: "-",
            jurusan: "-",
            nextMatkul: "Pemrograman Web (C)",
            nextDosen: "Romanus Damanik, S.Kom, M.Kom",
            nextJamMulai: "14.00",
            nextJamSelesai: "16.30",
            nextSks: 3,
            nextSemester: "IV",
            nextKelas: "C",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Senin-5",
            nama: "1/5",
            status: "Dipakai",
            matkul: "Pemrograman Visual (B)",
            dosen: "Sorang Pakpahan, S.Kom, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "09.40",
            sks: 2,
            semester: "II",
            kelas: "B",
            jurusan: "Sistem Informasi",
            nextMatkul: "Pemrograman Visual (A)",
            nextDosen: "Sorang Pakpahan, S.Kom, M.Kom",
            nextJamMulai: "09.50",
            nextJamSelesai: "11.30",
            nextSks: 2,
            nextSemester: "II",
            nextKelas: "A",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Senin-6",
            nama: "1/6",
            status: "Kosong",
            matkul: "-",
            dosen: "-",
            jamMulai: "-",
            jamSelesai: "-",
            sks: 0,
            semester: "-",
            kelas: "-",
            jurusan: "-",
            nextMatkul: "Rekayasa Proses Bisnis (C)",
            nextDosen: "Masdiana Sagala, S.Kom, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "IV",
            nextKelas: "C",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Senin-7",
            nama: "1/7",
            status: "Dipakai",
            matkul: "Infrastruktur dan Tek. Big Data",
            dosen: "Dr. Paska Marto, S.Kom., M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "IV",
            kelas: "Gabungan",
            jurusan: "Sains Data",
            nextMatkul: "Analisa Big Data dan Cloud Computing",
            nextDosen: "Dr. Paska Marto, S.Kom., M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "VI",
            nextKelas: "Gabungan",
            nextJurusan: "Sains Data",
        },
        {
            id: "Senin-8",
            nama: "II/1",
            status: "Dipakai",
            matkul: "Metode Riset Sistem Informasi (B)",
            dosen: "Anirma Kandida Ginting, S.Kom., M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "IV",
            kelas: "B",
            jurusan: "Sistem Informasi",
            nextMatkul: "Metode Riset Sistem Informasi (A)",
            nextDosen: "Zekson Arizona Matondang, S.Kom, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "IV",
            nextKelas: "A",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Senin-9",
            nama: "III/1",
            status: "Dipakai",
            matkul: "Rekayasa Proses Bisnis (A)",
            dosen: "Masdiana Sagala, S.Kom, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "IV",
            kelas: "A",
            jurusan: "Sistem Informasi",
            nextMatkul: "Etika (A)",
            nextDosen: "Justini Simanjuntak, S.Pd, M.Pd",
            nextJamMulai: "14.00",
            nextJamSelesai: "15.40",
            nextSks: 2,
            nextSemester: "II",
            nextKelas: "A",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Senin-10",
            nama: "III/2",
            status: "Kosong",
            matkul: "-",
            dosen: "-",
            jamMulai: "-",
            jamSelesai: "-",
            sks: 0,
            semester: "-",
            kelas: "-",
            jurusan: "-",
            nextMatkul: "Keamanan Jaringan (B)",
            nextDosen: "Emerson P. Malau, S.Si, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "VI",
            nextKelas: "B",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Senin-11",
            nama: "Lab. A",
            status: "Dipakai",
            matkul: "Prak. Rekayasa Perangkat Lunak (C)",
            dosen: "Andy Paul Harianja, ST, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "IV",
            kelas: "C",
            jurusan: "Sistem Informasi",
            nextMatkul: "Prak. Rekayasa Perangkat Lunak (B)",
            nextDosen: "Andy Paul Harianja, ST, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "IV",
            nextKelas: "B",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Senin-12",
            nama: "Lab. B",
            status: "Dipakai",
            matkul: "Prak. Pengolahan Citra Digital (B)",
            dosen: "Dr. Pandi Barita Nauli Simangunsong, S.Kom, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "IV",
            kelas: "B",
            jurusan: "Teknik Informatika",
            nextMatkul: "Prak. Pengolahan Citra Digital (A)",
            nextDosen: "Dr. Pandi Barita Nauli Simangunsong, S.Kom, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "IV",
            nextKelas: "A",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Senin-13",
            nama: "Lab. C",
            status: "Dipakai",
            matkul: "Prak. Sistem Operasi (B)",
            dosen: "Lotar Mateus Sinaga, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "II",
            kelas: "B",
            jurusan: "Teknik Informatika",
            nextMatkul: "Prak. Pemrograman Web (A)",
            nextDosen: "Wasit Ginting, S.Kom, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 2,
            nextSemester: "VI",
            nextKelas: "A",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Senin-14",
            nama: "Lab. D",
            status: "Dipakai",
            matkul: "Prak. Keamanan Jaringan (A)",
            dosen: "Emerson P. Malau, S.Si, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "VI",
            kelas: "A",
            jurusan: "Teknik Informatika",
            nextMatkul: "Prak. Sistem Operasi (A)",
            nextDosen: "Lotar Mateus Sinaga, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "II",
            nextKelas: "A",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Senin-15",
            nama: "Lab. E",
            status: "Kosong",
            matkul: "-",
            dosen: "-",
            jamMulai: "-",
            jamSelesai: "-",
            sks: 0,
            semester: "-",
            kelas: "-",
            jurusan: "-",
            nextMatkul: "Prak. Jaringan Komputer (D)",
            nextDosen: "Sardo Sipayung, S.Kom., M.Kom",
            nextJamMulai: "14.00",
            nextJamSelesai: "16.30",
            nextSks: 3,
            nextSemester: "IV",
            nextKelas: "D",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Senin-16",
            nama: "Lab. G",
            status: "Kosong",
            matkul: "-",
            dosen: "-",
            jamMulai: "-",
            jamSelesai: "-",
            sks: 0,
            semester: "-",
            kelas: "-",
            jurusan: "-",
            nextMatkul: "Prak. Pemrograman Jaringan (Pilihan 2)(B)",
            nextDosen: "Sorang Pakpahan, S.Kom, M.Kom",
            nextJamMulai: "16.40",
            nextJamSelesai: "19.10",
            nextSks: 3,
            nextSemester: "VI",
            nextKelas: "B",
            nextJurusan: "Teknik Informatika",
        },
    ],
    Selasa: [
        {
            id: "Selasa-1",
            nama: "1/1",
            status: "Dipakai",
            matkul: "Sistem Digital (A)",
            dosen: "Desinta Purba, ST, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "09.40",
            sks: 2,
            semester: "II",
            kelas: "A",
            jurusan: "Teknik Informatika",
            nextMatkul: "Sistem Digital (B)",
            nextDosen: "Desinta Purba, ST, M.Kom",
            nextJamMulai: "09.50",
            nextJamSelesai: "11.30",
            nextSks: 2,
            nextSemester: "II",
            nextKelas: "B",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Selasa-2",
            nama: "1/2",
            status: "Dipakai",
            matkul: "Antar Muka Pengguna/Peng. Pengguna (B)",
            dosen: "Andy Paul Harianja, ST, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "09.40",
            sks: 2,
            semester: "IV",
            kelas: "B",
            jurusan: "Teknik Informatika",
            nextMatkul: "Antar Muka Pengguna/Peng. Pengguna (D)",
            nextDosen: "Andy Paul Harianja, ST, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "12.20",
            nextSks: 2,
            nextSemester: "IV",
            nextKelas: "D",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Selasa-3",
            nama: "1/3",
            status: "Dipakai",
            matkul: "Keamanan Sistem Informasi (A)",
            dosen: "Emerson P. Malau, S.Si, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "09.40",
            sks: 3,
            semester: "VI",
            kelas: "A",
            jurusan: "Sistem Informasi",
            nextMatkul: "Keamanan Sistem Informasi (B)",
            nextDosen: "Emerson P. Malau, S.Si, M.Kom",
            nextJamMulai: "09.50",
            nextJamSelesai: "11.30",
            nextSks: 3,
            nextSemester: "VI",
            nextKelas: "B",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Selasa-4",
            nama: "1/4",
            status: "Dipakai",
            matkul: "Pembelajaran Mesin (D)",
            dosen: "Prof. Dr. Zakarias Situmorang, MT",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "IV",
            kelas: "D",
            jurusan: "Teknik Informatika",
            nextMatkul: "Pembelajaran Mesin (B)",
            nextDosen: "Prof. Dr. Zakarias Situmorang, MT",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "IV",
            nextKelas: "B",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Selasa-5",
            nama: "1/5",
            status: "Dipakai",
            matkul: "Organisasi & Arsitektur Komputer (B)",
            dosen: "Romanus Damanik, S.Kom, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "09.40",
            sks: 2,
            semester: "II",
            kelas: "B",
            jurusan: "Teknik Informatika",
            nextMatkul: "Pendidikan Kewarganegaraan (A)",
            nextDosen: "Muhammad Akbar Siregar, S.H, M.Hum",
            nextJamMulai: "09.50",
            nextJamSelesai: "11.30",
            nextSks: 2,
            nextSemester: "II",
            nextKelas: "A",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Selasa-6",
            nama: "1/6",
            status: "Dipakai",
            matkul: "Rekayasa Proses Bisnis (B)",
            dosen: "Masdiana Sagala, S.Kom, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "IV",
            kelas: "B",
            jurusan: "Sistem Informasi",
            nextMatkul: "Sistem Informasi Bisnis (B)",
            nextDosen: "Dr. Novri Siagian, S.Kom., M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "II",
            nextKelas: "B",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Selasa-7",
            nama: "1/7",
            status: "Dipakai",
            matkul: "Pemrograman Web (B)",
            dosen: "Wasit Ginting, S.Kom, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "09.40",
            sks: 2,
            semester: "VI",
            kelas: "B",
            jurusan: "Sistem Informasi",
            nextMatkul: "Pemrograman Web (A)",
            nextDosen: "Wasit Ginting, S.Kom, M.Kom",
            nextJamMulai: "09.50",
            nextJamSelesai: "11.30",
            nextSks: 2,
            nextSemester: "VI",
            nextKelas: "A",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Selasa-8",
            nama: "II/1",
            status: "Dipakai",
            matkul: "Big Data (C)",
            dosen: "Dr. Paska Marto, S.Kom., M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "IV",
            kelas: "C",
            jurusan: "Sistem Informasi",
            nextMatkul: "Algoritma Lanjut (Pilihan 2)",
            nextDosen: "Drs. Lamhot Sitorus, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "VI",
            nextKelas: "Gabungan",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Selasa-9",
            nama: "III/1",
            status: "Dipakai",
            matkul: "Pemasaran Digital (Pilihan 2)",
            dosen: "Alex Rikki, S.Kom., M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "VI",
            kelas: "Gabungan",
            jurusan: "Teknik Informatika",
            nextMatkul: "Pemrograman Jaringan (Pilihan 2)(A)",
            nextDosen: "Sorang Pakpahan, S.Kom, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "VI",
            nextKelas: "A",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Selasa-10",
            nama: "III/2",
            status: "Dipakai",
            matkul: "Sistem Informasi Bisnis (A)",
            dosen: "Dr. Novri Siagian, S.Kom., M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "II",
            kelas: "A",
            jurusan: "Sistem Informasi",
            nextMatkul: "Sistem Operasi Jaringan (Pilihan 2)",
            nextDosen: "Parasian D.P. Silitonga, S.Kom, M.Cs",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "VI",
            nextKelas: "Gabungan",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Selasa-11",
            nama: "Lab. A",
            status: "Dipakai",
            matkul: "Prak. Sistem Operasi Jaringan (Pilihan 2)",
            dosen: "Parasian D.P. Silitonga, S.Kom, M.Cs",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 2,
            semester: "VI",
            kelas: "Gabungan",
            jurusan: "Teknik Informatika",
            nextMatkul: "Prak. Antar Muka Pengguna/Peng. Pengguna (B)",
            nextDosen: "Andy Paul Harianja, ST, M.Kom",
            nextJamMulai: "14.00",
            nextJamSelesai: "16.30",
            nextSks: 3,
            nextSemester: "IV",
            nextKelas: "B",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Selasa-12",
            nama: "Lab. B",
            status: "Dipakai",
            matkul: "Prak. Algoritma Lanjut (Pilihan 2)",
            dosen: "Drs. Lamhot Sitorus, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "VI",
            kelas: "Gabungan",
            jurusan: "Teknik Informatika",
            nextMatkul: "Prak. Pengolahan Citra Digital (C)",
            nextDosen: "Dr. Pandi Barita Nauli Simangunsong, S.Kom, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "IV",
            nextKelas: "C",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Selasa-13",
            nama: "Lab. C",
            status: "Kosong",
            matkul: "-",
            dosen: "-",
            jamMulai: "-",
            jamSelesai: "-",
            sks: 0,
            semester: "-",
            kelas: "-",
            jurusan: "-",
            nextMatkul: "Prak. Pemrograman Web (B)",
            nextDosen: "Wasit Ginting, S.Kom, M.Kom",
            nextJamMulai: "14.00",
            nextJamSelesai: "16.30",
            nextSks: 2,
            nextSemester: "VI",
            nextKelas: "B",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Selasa-14",
            nama: "Lab. D",
            status: "Kosong",
            matkul: "-",
            dosen: "-",
            jamMulai: "-",
            jamSelesai: "-",
            sks: 0,
            semester: "-",
            kelas: "-",
            jurusan: "-",
            nextMatkul: "Prak. Pemrograman Berbasis Objek (C)",
            nextDosen: "Parasian D.P. Silitonga, S.Kom, M.Cs",
            nextJamMulai: "14.00",
            nextJamSelesai: "16.30",
            nextSks: 3,
            nextSemester: "IV",
            nextKelas: "C",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Selasa-15",
            nama: "Lab. E",
            status: "Dipakai",
            matkul: "Prak. Perenc. Sumber Daya Perusahaan (C)",
            dosen: "Anirma Kandida Ginting, S.Kom., M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "VI",
            kelas: "C",
            jurusan: "Sistem Informasi",
            nextMatkul: "Prak. Penjaminan Mutu Perangkat Lunak (A)",
            nextDosen: "Zekson Arizona Matondang, S.Kom, M.Kom",
            nextJamMulai: "14.00",
            nextJamSelesai: "16.30",
            nextSks: 3,
            nextSemester: "VI",
            nextKelas: "A",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Selasa-16",
            nama: "Lab. G",
            status: "Dipakai",
            matkul: "Prak. Pemrograman Jaringan (Pilihan 2)(A)",
            dosen: "Sorang Pakpahan, S.Kom, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "10.30",
            sks: 3,
            semester: "VI",
            kelas: "A",
            jurusan: "Teknik Informatika",
            nextMatkul: "Prak. Pemrograman Visual (B)",
            nextDosen: "Sorang Pakpahan, S.Kom, M.Kom",
            nextJamMulai: "14.00",
            nextJamSelesai: "16.30",
            nextSks: 3,
            nextSemester: "II",
            nextKelas: "B",
            nextJurusan: "Sistem Informasi",
        },
    ],
    Rabu: [
        {
            id: "Rabu-1",
            nama: "1/1",
            status: "Kosong",
            matkul: "-",
            dosen: "-",
            jamMulai: "-",
            jamSelesai: "-",
            sks: 0,
            semester: "-",
            kelas: "-",
            jurusan: "-",
            nextMatkul: "Metode Penelitian (B)",
            nextDosen: "Anirma Kandida Ginting, S.Kom., M.Kom",
            nextJamMulai: "14.00",
            nextJamSelesai: "15.40",
            nextSks: 2,
            nextSemester: "IV",
            nextKelas: "B",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Rabu-2",
            nama: "1/2",
            status: "Dipakai",
            matkul: "Rekayasa Perangkat Lunak (A)",
            dosen: "Andy Paul Harianja, ST, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "09.40",
            sks: 2,
            semester: "IV",
            kelas: "A",
            jurusan: "Sistem Informasi",
            nextMatkul: "Rekayasa Perangkat Lunak (C)",
            nextDosen: "Andy Paul Harianja, ST, M.Kom",
            nextJamMulai: "09.50",
            nextJamSelesai: "11.30",
            nextSks: 2,
            nextSemester: "IV",
            nextKelas: "C",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Rabu-3",
            nama: "1/3",
            status: "Kosong",
            matkul: "-",
            dosen: "-",
            jamMulai: "-",
            jamSelesai: "-",
            sks: 0,
            semester: "-",
            kelas: "-",
            jurusan: "-",
            nextMatkul: "Etika Profesi Bisnis (A)",
            nextDosen: "Dr. Pandi Barita Nauli Simangunsong, S.Kom, M.Kom",
            nextJamMulai: "14.00",
            nextJamSelesai: "15.40",
            nextSks: 2,
            nextSemester: "IV",
            nextKelas: "A",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Rabu-4",
            nama: "1/4",
            status: "Dipakai",
            matkul: "Pendidikan Pancasila (A)",
            dosen: "Maranatha Purba, SH., M.H",
            jamMulai: "08.00",
            jamSelesai: "09.40",
            sks: 2,
            semester: "II",
            kelas: "A",
            jurusan: "Sistem Informasi",
            nextMatkul: "Prak. Pengolahan Citra Digital (D)",
            nextDosen: "Dr. Pandi Barita Nauli Simangunsong, S.Kom, M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 2,
            nextSemester: "IV",
            nextKelas: "D",
            nextJurusan: "Sistem Informasi",
        },
    ],
    Kamis: [
        {
            id: "Kamis-1",
            nama: "1/1",
            status: "Kosong",
            matkul: "-",
            dosen: "-",
            jamMulai: "-",
            jamSelesai: "-",
            sks: 0,
            semester: "-",
            kelas: "-",
            jurusan: "-",
            nextMatkul: "Pendidikan Pancasila (B)",
            nextDosen: "Maranatha Purba, SH., M.H",
            nextJamMulai: "11.40",
            nextJamSelesai: "13.20",
            nextSks: 2,
            nextSemester: "II",
            nextKelas: "B",
            nextJurusan: "Sistem Informasi",
        },
        {
            id: "Kamis-2",
            nama: "1/2",
            status: "Kosong",
            matkul: "-",
            dosen: "-",
            jamMulai: "-",
            jamSelesai: "-",
            sks: 0,
            semester: "-",
            kelas: "-",
            jurusan: "-",
            nextMatkul: "Matematika Informatika (A)",
            nextDosen: "Swingly Purba, M.Sc",
            nextJamMulai: "09.50",
            nextJamSelesai: "11.30",
            nextSks: 2,
            nextSemester: "II",
            nextKelas: "A",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Kamis-3",
            nama: "1/3",
            status: "Dipakai",
            matkul: "Pengolahan Citra Digital (C)",
            dosen: "Dr. Pandi Barita Nauli Simangunsong, S.Kom, M.Kom",
            jamMulai: "08.00",
            jamSelesai: "09.40",
            sks: 2,
            semester: "IV",
            kelas: "C",
            jurusan: "Teknik Informatika",
            nextMatkul: "Pengolahan Citra Digital (A)",
            nextDosen: "Dr. Pandi Barita Nauli Simangunsong, S.Kom, M.Kom",
            nextJamMulai: "11.40",
            nextJamSelesai: "13.20",
            nextSks: 2,
            nextSemester: "IV",
            nextKelas: "A",
            nextJurusan: "Teknik Informatika",
        },
    ],
    Jumat: [
        {
            id: "Jumat-1",
            nama: "1/1",
            status: "Kosong",
            matkul: "-",
            dosen: "-",
            jamMulai: "-",
            jamSelesai: "-",
            sks: 0,
            semester: "-",
            kelas: "-",
            jurusan: "-",
            nextMatkul: "Manajemen Proyek Perangkat Lunak (A)",
            nextDosen: "Alex Rikki, S.Kom., M.Kom",
            nextJamMulai: "10.40",
            nextJamSelesai: "13.10",
            nextSks: 3,
            nextSemester: "VI",
            nextKelas: "A",
            nextJurusan: "Teknik Informatika",
        },
        {
            id: "Jumat-7",
            nama: "1/7",
            status: "Dipakai",
            matkul: "Rekayasa Sains Data",
            dosen: "Dr. Pandi Barita Nauli Simangunsong",
            jamMulai: "10.40",
            jamSelesai: "13.10",
            sks: 3,
            semester: "VI",
            kelas: "Gabungan",
            jurusan: "Sains Data",
            nextMatkul: "Penambangan Teks",
            nextDosen: "Sardo Sipayung, S.Kom., M.Kom",
            nextJamMulai: "14.00",
            nextJamSelesai: "16.30",
            nextSks: 3,
            nextSemester: "VI",
            nextKelas: "Gabungan",
            nextJurusan: "Sains Data",
        },
    ],
};

// Variabel Kontrol untuk Transaksi Alokasi Kelas Darurat
let idRuanganDipilihSaatIni = null;

// =========================================================================
// LOG AKTIVITAS ENGINE
// =========================================================================
function logActivity(pesan) {
    const logContainer = document.querySelector(".log-container");
    if (!logContainer) return;
    const waktu = new Date();
    const jam =
        String(waktu.getHours()).padStart(2, "0") +
        ":" +
        String(waktu.getMinutes()).padStart(2, "0");
    const logHTML = `
        <div class="log-item border-maroon" style="animation: fadeIn 0.3s ease-in-out;">
            <span class="log-title">Sistem Ruangan</span>
            <p class="log-text">${pesan}</p>
            <span class="log-time">${jam} WIB</span>
        </div>
    `;
    logContainer.insertAdjacentHTML("afterbegin", logHTML);
}

// =========================================================================
// 2. LIFECYCLE INITIALIZER & RUN-TIME TIMER
// =========================================================================
document.addEventListener("DOMContentLoaded", () => {
    const daftarHari = [
        "Minggu",
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jumat",
        "Sabtu",
    ];
    const hariIniSistem = daftarHari[new Date().getDay()];

    const selectHari =
        document.getElementById("filterHari") ||
        document.querySelector("select:nth-of-type(1)");
    if (selectHari) {
        // Perbaikan: Atur filter ke hari ini, jangan ubah paksa ke Senin.
        selectHari.value = hariIniSistem;
    }

    const semuaRuanganTetap = [
        "1/1",
        "1/2",
        "1/3",
        "1/4",
        "1/5",
        "1/6",
        "1/7",
        "II/1",
        "II/2",
        "III/1",
        "III/2",
        "Lab. A",
        "Lab. B",
        "Lab. C",
        "Lab. D",
        "Lab. E",
        "Lab. F",
        "Lab. G",
    ];
    const hariKerja = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"];

    // Mengamankan jadwal asli agar tidak terhapus
    hariKerja.forEach((hari) => {
        if (!masterRuanganFikom[hari]) masterRuanganFikom[hari] = [];

        const kapasitasRuangan = {
            "1/1": 41,
            "1/2": 47,
            "1/3": 45,
            "1/4": 41,
            "1/5": 48,
            "1/6": 38,
            "1/7": 43,
            "II/1": 58,
            "III/1": 41,
            "III/2": 41,
        };

        semuaRuanganTetap.forEach((namaRuang) => {
            const ruangAda = masterRuanganFikom[hari].find(
                (r) => r.nama === namaRuang,
            );

            let kapasitas = 40; // Kapasitas default
            if (namaRuang.toLowerCase().startsWith("lab")) {
                kapasitas = 40;
            } else if (kapasitasRuangan[namaRuang]) {
                kapasitas = kapasitasRuangan[namaRuang];
            }

            if (!ruangAda) {
                masterRuanganFikom[hari].push({
                    id: `${hari}-${namaRuang.replace(/[\s\/\.]/g, "")}`,
                    nama: namaRuang,
                    status: "Kosong",
                    matkul: "-",
                    dosen: "-",
                    jamMulai: "-",
                    jamSelesai: "-",
                    kapasitas: kapasitas,
                    sks: 0,
                    semester: "-",
                    kelas: "-",
                    jurusan: "-",
                    nextMatkul: "-",
                    nextDosen: "-",
                    nextJamMulai: "-",
                    nextJamSelesai: "-",
                    nextSks: 0,
                    nextSemester: "-",
                    nextKelas: "-",
                    nextJurusan: "-",
                });
            } else {
                ruangAda.kapasitas = kapasitas;
            }
        });
    });

    for (let hari in masterRuanganFikom) {
        masterRuanganFikom[hari].forEach((ruang) => {
            if (ruang.status === "Dipakai") ruang.status = "Sedang Digunakan";
        });
    }

    buatStrukturModalDetailHTML();
    buatStrukturModalFormBookingHTML();

    cekWaktuSelesaiPerkuliahan();
    jalankanPenyaringanRuangan();

    setInterval(() => {
        if (hariIniSistem !== "Sabtu" && hariIniSistem !== "Minggu") {
            if (cekWaktuSelesaiPerkuliahan()) jalankanPenyaringanRuangan();
        }
    }, 30000);

    const btnTerapkan = document.getElementById("btnFilter");
    if (btnTerapkan)
        btnTerapkan.addEventListener("click", jalankanPenyaringanRuangan);

    const searchInput = document.getElementById("searchInput");
    if (searchInput)
        searchInput.addEventListener("input", jalankanPenyaringanRuangan);
});

// =========================================================================
// 3. LOGIKA ENGINE: FILTERING & SORTING
// =========================================================================
function jalankanPenyaringanRuangan() {
    cekWaktuSelesaiPerkuliahan();

    const selectHari =
        document.getElementById("filterHari") ||
        document.querySelector("select:nth-of-type(1)");
    const selectJurusan =
        document.getElementById("filterJurusan") ||
        document.querySelector("select:nth-of-type(2)");
    const selectStatus =
        document.getElementById("filterStatus") ||
        document.querySelector("select:nth-of-type(3)");
    const searchInput =
        document.getElementById("searchInput") ||
        document.querySelector("input[placeholder*='Cari']");

    const fHari = selectHari ? selectHari.value : "Senin";
    const fJurusan = selectJurusan ? selectJurusan.value : "Semua";
    const fStatus = selectStatus ? selectStatus.value : "Semua";
    const keyword = searchInput ? searchInput.value.toLowerCase().trim() : "";

    let dataHariDipilih = masterRuanganFikom[fHari] || [];

    let dataHasilSaring = dataHariDipilih.filter((ruang) => {
        const cocokStatus =
            fStatus === "Semua" ||
            fStatus === "" ||
            ruang.status.toLowerCase() === fStatus.toLowerCase() ||
            (fStatus.toLowerCase() === "dipakai" &&
                ruang.status === "Sedang Digunakan");
        let cocokJurusan = true;
        if (
            fJurusan !== "Semua" &&
            fJurusan !== "" &&
            ruang.status !== "Kosong"
        ) {
            const targetMatkul = ruang.matkul.toLowerCase();
            cocokJurusan =
                targetMatkul.includes(fJurusan.toLowerCase()) ||
                (fJurusan === "Teknik Informatika" &&
                    (targetMatkul.includes("(a)") ||
                        targetMatkul.includes("(b)") ||
                        targetMatkul.includes("(d)"))) ||
                (fJurusan === "Sistem Informasi" &&
                    targetMatkul.includes("(c)"));
        }
        const cocokKeyword =
            keyword === "" ||
            ruang.nama.toLowerCase().includes(keyword) ||
            ruang.matkul.toLowerCase().includes(keyword) ||
            ruang.dosen.toLowerCase().includes(keyword);
        return cocokStatus && cocokJurusan && cocokKeyword;
    });

    dataHasilSaring.sort((a, b) => {
        const getPriority = (status) => {
            if (status === "Sedang Digunakan" || status === "Dipakai") return 1;
            if (status === "Booking") return 2;
            return 3;
        };
        return getPriority(a.status) - getPriority(b.status);
    });

    renderCardRuangan(dataHasilSaring, fHari);
    updateWidgetRingkasanStatus(dataHariDipilih);
}

// =========================================================================
// 4. RENDERER ENGINE: MENGGAMBAR KARTU RUANGAN
// =========================================================================
function renderCardRuangan(daftarRuangan, hariAktif) {
    const gridContainer =
        document.getElementById("ruanganGrid") ||
        document.querySelector(".ruangan-grid");
    if (!gridContainer) return;

    gridContainer.innerHTML = "";

    if (hariAktif === "Sabtu" || hariAktif === "Minggu") {
        gridContainer.innerHTML = `
          <div class="sunday-empty-box" style="width: 100%;">
            <i class="fa-solid fa-mug-hot"></i>
            <h3>Kampus Libur (${hariAktif})</h3>
            <p>Fakultas Ilmu Komputer sedang tutup. Tidak ada aktivitas perkuliahan maupun alokasi ruangan operasional hari ini.</p>
          </div>`;
        return;
    }

    if (daftarRuangan.length === 0) {
        gridContainer.innerHTML = `
          <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: #f9fafb; border: 1px dashed #d0d5dd; border-radius: 8px;">
            <i class="fa-solid fa-folder-open" style="font-size: 36px; color: #98a2b3; margin-bottom: 10px; display:block;"></i>
            <h3 style="margin:0; color:#344054;">Ruangan Tidak Ditemukan</h3>
            <p style="margin:4px 0 0 0; color:#667085; font-size:13px;">Silakan ubah kata kunci atau kombinasi filter Anda.</p>
          </div>`;
        return;
    }

    daftarRuangan.forEach((ruang) => {
        const card = document.createElement("div");

        let kelasCssCard = "kosong";
        let warnaUtama = "#027a48";
        let bgBadge = "#ecfdf3";
        let bgCard = "#ffffff";
        let borderCard = "#eaecf0";

        if (ruang.status === "Sedang Digunakan" || ruang.status === "Dipakai") {
            kelasCssCard = "sedang-digunakan pulsing-red";
            warnaUtama = "#9a1c1c";
            bgBadge = "#fee4e2";
            bgCard = "#fff1f2";
            borderCard = "#fecdd3";
        } else if (ruang.status === "Booking") {
            kelasCssCard = "booking";
            warnaUtama = "#175cd3";
            bgBadge = "#eff8ff";
            bgCard = "#f5f9ff";
            borderCard = "#d1e9ff";
        } else if (ruang.status === "Akan Datang") {
            kelasCssCard = "booking";
            warnaUtama = "#175cd3";
            bgBadge = "#eff8ff";
            bgCard = "#f5f9ff";
            borderCard = "#d1e9ff";
        }

        card.className = kelasCssCard;
        card.style.cssText = `
          background: ${bgCard}; border: 1px solid ${borderCard}; border-radius: 12px; 
          padding: 16px; display: flex; flex-direction: column; justify-content: space-between;
          box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05); cursor: pointer; 
          transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        `;

        let txtMatkul = "Tidak Ada Perkuliahan";
        let txtDosen = "Ruangan kosong / stand-by";

        if (
            ruang.status === "Sedang Digunakan" ||
            ruang.status === "Dipakai" ||
            ruang.status === "Booking"
        ) {
            txtMatkul = ruang.matkul;
            txtDosen = ruang.dosen;
        }

        card.innerHTML = `
          <div>
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
              <h3 style="margin: 0; font-size: 17px; font-weight: 700; color: #1d2939; font-family: 'Poppins';">Ruang ${ruang.nama}</h3>
              <span style="font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 12px; background: ${bgBadge}; color: ${warnaUtama};">
                ${ruang.status}
              </span>
            </div>
            <div style="font-size: 11px; color: #667085; font-family: 'Poppins'; margin-bottom: 12px; display: flex; align-items: center; gap: 5px;">
                <i class="fa-solid fa-users" style="width: 12px;"></i>
                <span>${ruang.kapasitas} Kursi</span>
            </div>
            <div style="margin-bottom: 15px; min-height: 55px;">
              <h4 style="margin: 0; font-size: 13px; font-weight: 600; color: #344054; font-family: 'Poppins'; line-height: 1.4;">
                ${txtMatkul}
              </h4>
              <p style="margin: 4px 0 0 0; font-size: 12px; color: #667085; font-family: 'Poppins'; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                ${txtDosen}
              </p>
            </div>
          </div>
          <div style="border-top: 1px dashed #eaecf0; padding-top: 12px; display: flex; flex-direction: column; gap: 8px;">
            <div style="display: flex; align-items: center; justify-content: space-between; font-size: 11px; color: #667085; font-family: 'Poppins';">
              <span>${ruang.status === "Sedang Digunakan" || ruang.status === "Dipakai" ? "Selesai Jam:" : ruang.status === "Booking" || ruang.status === "Akan Datang" ? "Dimulai Jam:" : "Next Kelas:"}</span>
              <span style="font-weight: 600; color: #344054;">
                ${ruang.status === "Sedang Digunakan" || ruang.status === "Dipakai" ? ruang.jamSelesai : ruang.status === "Booking" ? ruang.jamMulai : ruang.nextMatkul !== "-" ? ruang.nextMatkul + " (" + ruang.nextJamMulai + ")" : "-"}
              </span>
            </div>
            
            ${
                ruang.status === "Kosong"
                    ? window.userRole === "admin" || window.userRole === "dosen"
                        ? `
              <button class="btn-action-ruang" data-type="ambil" style="width: 100%; background: #027a48; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-family: 'Poppins'; font-size: 12px; font-weight: 500; cursor: pointer;">
                <i class="fa-solid fa-plus"></i> Ambil Ruangan
              </button>
            `
                        : `` /* Jika Mahasiswa, tombol Ambil Ruangan HILANG (Kosong) */
                    : `
              <button class="btn-action-ruang" data-type="detail" style="width: 100%; background: #f2f4f7; color: #344054; border: 1px solid #d0d5dd; padding: 6px 12px; border-radius: 6px; font-family: 'Poppins'; font-size: 12px; font-weight: 500; cursor: pointer;">
                <i class="fa-solid fa-eye"></i> Lihat Detail
              </button>
            `
            }
          </div>
        `;

        const btnAksi = card.querySelector(".btn-action-ruang");
        btnAksi.addEventListener("click", (e) => {
            e.stopPropagation();
            const type = btnAksi.getAttribute("data-type");
            if (type === "ambil") {
                bukaFormBookingDarurat(ruang.id);
            } else {
                bukaModalDetailRuangan(ruang);
            }
        });

        card.addEventListener("click", () => {
            bukaModalDetailRuangan(ruang);
        });

        gridContainer.appendChild(card);
    });
}

// =========================================================================
// 5. MODAL SYSTEM I: POP-UP DETAIL (DENGAN FITUR HAPUS)
// =========================================================================
function buatStrukturModalDetailHTML() {
    if (document.getElementById("modalDetailRuangan")) return;
    const div = document.createElement("div");
    div.id = "modalDetailRuangan";
    div.style.cssText =
        "position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(16,24,40,0.6); backdrop-filter:blur(4px); display:flex; align-items:center; justify-content:center; z-index:9999; opacity:0; pointer-events:none; transition:opacity 0.2s;";
    div.innerHTML = `
    <div style="background: white; width: 100%; max-width: 460px; border-radius: 12px; padding: 24px; position: relative; font-family: 'Poppins';">
      <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eaecf0; padding-bottom: 12px; margin-bottom: 16px;">
        <h3 id="mdlTitleRuang" style="margin:0; font-size:18px; font-weight:700; color:#1d2939;">Detail Ruangan</h3>
        <span id="mdlStatusBadge" style="font-size:11px; font-weight:600; padding:4px 12px; border-radius:12px;">-</span>
      </div>
      <div style="display: flex; flex-direction: column; gap: 10px; font-size: 13px; color: #344054;">
        <div style="display: flex; border-bottom:1px solid #f2f4f7; padding-bottom:4px;"><span style="width:120px; color:#667085;">Mata Kuliah</span><strong id="mdlMatkul" style="flex:1; color:#1d2939;">-</strong></div>
        <div style="display: flex; border-bottom:1px solid #f2f4f7; padding-bottom:4px;"><span style="width:120px; color:#667085;">Dosen Pengajar</span><span id="mdlDosen" style="flex:1;">-</span></div>
        <div style="display: flex; border-bottom:1px solid #f2f4f7; padding-bottom:4px;"><span style="width:120px; color:#667085;">Durasi Waktu</span><span id="mdlWaktu" style="flex:1;">-</span></div>
        <div style="display: flex; border-bottom:1px solid #f2f4f7; padding-bottom:4px;"><span style="width:120px; color:#667085;">Bobot SKS</span><span id="mdlSks" style="flex:1;">-</span></div>
        <div style="display: flex; border-bottom:1px solid #f2f4f7; padding-bottom:4px;"><span style="width:120px; color:#667085;">Semester</span><span id="mdlSemester" style="flex:1;">-</span></div>
        <div style="display: flex; border-bottom:1px solid #f2f4f7; padding-bottom:4px;"><span style="width:120px; color:#667085;">Kelas Ruang</span><span id="mdlKelas" style="flex:1;">-</span></div>
        <div style="display: flex; border-bottom:1px solid #f2f4f7; padding-bottom:4px;"><span style="width:120px; color:#667085;">Program Studi</span><span id="mdlProdi" style="flex:1;">-</span></div>
        <div style="display: flex; border-bottom:1px solid #f2f4f7; padding-bottom:4px;"><span style="width:120px; color:#667085;">Kapasitas</span><strong id="mdlKapasitas" style="flex:1; color:#1d2939;">-</strong></div>
      </div>
      <div id="mdlAlertFooter" style="margin-top: 20px; padding: 10px; border-radius: 6px; text-align: center; font-size: 12px; font-weight: 600;">-</div>
      
      <div style="display: flex; gap: 10px; margin-top: 14px;">
        <button id="btnBatalRuang" onclick="eksekusiBatalBooking()" style="flex:1; background:#fee4e2; color:#9a1c1c; border:1px solid #fecdd3; padding:8px; border-radius:6px; font-family:'Poppins'; font-weight:500; cursor:pointer; display:none;">
            <i class="fa-solid fa-trash"></i> Batalkan / Kosongkan
        </button>
        <button onclick="tutupModalDetailRuangan()" style="flex:1; background:#f2f4f7; color:#344054; border:1px solid #d0d5dd; padding:8px; border-radius:6px; font-family:'Poppins'; font-weight:500; cursor:pointer;">
            Tutup Info
        </button>
      </div>
    </div>`;
    document.body.appendChild(div);
}

function bukaModalDetailRuangan(ruang) {
    window.ruangDetailSaatIni = ruang; // Simpan ke memori untuk proses hapus

    const modal = document.getElementById("modalDetailRuangan");
    if (!modal) return;
    document.getElementById("mdlTitleRuang").innerText = `Ruang ${ruang.nama}`;
    const badge = document.getElementById("mdlStatusBadge");
    const footer = document.getElementById("mdlAlertFooter");
    const btnBatal = document.getElementById("btnBatalRuang");

    document.getElementById("mdlKapasitas").innerText =
        `${ruang.kapasitas} Kursi`;

    badge.innerText = ruang.status;

    if (ruang.status === "Kosong") {
        [
            "mdlMatkul",
            "mdlDosen",
            "mdlWaktu",
            "mdlSks",
            "mdlSemester",
            "mdlKelas",
            "mdlProdi",
        ].forEach((id) => (document.getElementById(id).innerText = "-"));
        badge.style.cssText = "background: #ecfdf3; color: #027a48;";
        footer.innerText = "Ruangan Siap Digunakan / Kosong";
        footer.style.cssText = "background: #ecfdf3; color: #027a48;";

        if (btnBatal) btnBatal.style.display = "none"; // Sembunyikan tombol hapus jika kosong
    } else {
        document.getElementById("mdlMatkul").innerText = ruang.matkul;
        document.getElementById("mdlDosen").innerText = ruang.dosen;
        document.getElementById("mdlWaktu").innerText =
            `${ruang.jamMulai} - ${ruang.jamSelesai} WIB`;
        document.getElementById("mdlSks").innerText = `${ruang.sks || "3"} SKS`;
        document.getElementById("mdlSemester").innerText =
            `Semester ${ruang.semester || "IV"}`;
        document.getElementById("mdlKelas").innerText =
            `Kelas ${ruang.kelas || "A"}`;
        document.getElementById("mdlProdi").innerText =
            ruang.jurusan || "Fakultas Ilmu Komputer";

        if (ruang.status === "Sedang Digunakan" || ruang.status === "Dipakai") {
            badge.style.cssText = "background: #fee4e2; color: #9a1c1c;";
            footer.innerText = "⚠️ RUANGAN SEDANG DIGUNAKAN";
            footer.style.cssText = "background: #fee4e2; color: #9a1c1c;";
        } else if (ruang.status === "Akan Datang") {
            badge.style.cssText = "background: #eff8ff; color: #175cd3;";
            footer.innerText = "🔵 RUANGAN AKAN SEGERA DIGUNAKAN";
            footer.style.cssText = "background: #eff8ff; color: #175cd3;";
        } else if (ruang.status === "Booking") {
            badge.style.cssText = "background: #eff8ff; color: #175cd3;";
            footer.innerText = "📅 RUANGAN INI SUDAH DI-BOOKING";
            footer.style.cssText = "background: #eff8ff; color: #175cd3;";
        }

        if (btnBatal) btnBatal.style.display = "block"; // Tampilkan tombol hapus
    }
    modal.style.opacity = "1";
    modal.style.pointerEvents = "auto";
}

function tutupModalDetailRuangan() {
    const m = document.getElementById("modalDetailRuangan");
    if (m) {
        m.style.opacity = "0";
        m.style.pointerEvents = "none";
    }
}

// Fungsi Baru: Menjalankan Perintah Hapus ke Database
async function eksekusiBatalBooking() {
    if (!window.ruangDetailSaatIni) return;
    const ruang = window.ruangDetailSaatIni;

    // Popup Konfirmasi
    const konfirmasi = confirm(
        `Apakah Anda yakin ingin MENGHAPUS jadwal ${ruang.matkul} di Ruang ${ruang.nama}?`,
    );
    if (!konfirmasi) return;

    const selectHari =
        document.getElementById("filterHari") ||
        document.querySelector("select:nth-of-type(1)");
    const hariAktif = selectHari ? selectHari.value : "Senin";

    const payloadData = {
        hari: hariAktif,
        ruang: ruang.nama,
        matkul: ruang.matkul,
    };

    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfTokenMeta
        ? csrfTokenMeta.getAttribute("content")
        : "";

    const btnBatal = document.getElementById("btnBatalRuang");
    const originalText = btnBatal.innerHTML;
    btnBatal.innerHTML =
        '<i class="fa-solid fa-spinner fa-spin"></i> Menghapus...';
    btnBatal.disabled = true;

    try {
        const response = await fetch("/ruangan/booking/cancel", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
                Accept: "application/json",
            },
            body: JSON.stringify(payloadData),
        });

        const result = await response.json();

        if (result.success) {
            tutupModalDetailRuangan();
            window.location.reload(); // Refresh halaman agar kartu kembali jadi hijau
        } else {
            alert(result.message); // Menampilkan info jika itu jadwal reguler (tidak bisa dihapus)
        }
    } catch (error) {
        console.error("Terjadi kesalahan:", error);
        alert("Terjadi kesalahan sistem/jaringan saat menghapus data.");
    } finally {
        if (btnBatal) {
            btnBatal.innerHTML = originalText;
            btnBatal.disabled = false;
        }
    }
}

// =========================================================================
// 6. MODAL SYSTEM II: FORMULIR INPUT TRANSAKSI BOOKING CERDAS
// =========================================================================

// Escape nilai supaya aman dipakai di dalam atribut HTML (cegah HTML/atribut bocor
// kalau suatu saat nama dosen mengandung karakter seperti " atau <)
function escapeHtmlAttr(nilai) {
    if (nilai === null || nilai === undefined) return "";
    return String(nilai)
        .replace(/&/g, "&amp;")
        .replace(/"/g, "&quot;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;");
}

// Bangun daftar <option> dosen dari data yang dikirim server (window.daftarDosenServer),
// BUKAN hardcode lagi. Sumber datanya harus sinkron dengan tabel `dosens` di database,
// supaya nama yang dipilih di sini selalu cocok saat dicari di RuanganController::storeBooking().
function buatOpsiDosenHTML() {
    const daftarDosen =
        typeof daftarDosenServer !== "undefined" &&
        Array.isArray(daftarDosenServer)
            ? daftarDosenServer
            : [];

    if (daftarDosen.length === 0) {
        console.warn(
            "daftarDosenServer kosong/tidak ditemukan — pastikan ruangan.blade.php mengirim window.daftarDosenServer dari database.",
        );
        return '<option value="" disabled>Data dosen tidak tersedia, hubungi admin</option>';
    }

    return daftarDosen
        .map((d) => {
            const nama = d.nama || d;
            const aman = escapeHtmlAttr(nama);
            return `<option value="${aman}">${aman}</option>`;
        })
        .join("");
}

function buatStrukturModalFormBookingHTML() {
    if (document.getElementById("modalFormBooking"))
        document.getElementById("modalFormBooking").remove();
    const div = document.createElement("div");
    div.id = "modalFormBooking";
    div.style.cssText =
        "position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(16,24,40,0.6); backdrop-filter:blur(4px); display:flex; align-items:center; justify-content:center; z-index:9999; opacity:0; pointer-events:none; transition:opacity 0.2s;";

    const formControlStyle =
        "width:100%; padding:8px 10px; border:1px solid #d0d5dd; border-radius:6px; font-size:13px; font-family:'Poppins'; background-color:#fff; color:#344054;";
    const labelStyle =
        "font-size:12px; font-weight:500; color:#344054; display:block; margin-bottom:4px;";

    div.innerHTML = `
    <div style="background: white; width: 100%; max-width: 480px; border-radius: 12px; padding: 24px; font-family: 'Poppins'; box-shadow: 0 20px 24px -4px rgba(16, 24, 40, 0.08);">
      <h3 id="bookingFormTitle" style="margin: 0 0 16px 0; font-size: 18px; font-weight: 700; color: #1d2939; border-bottom: 1px solid #eaecf0; padding-bottom: 10px;">Ambil Alokasi Ruangan</h3>
      <form id="frmTransaksiBooking" style="display: flex; flex-direction: column; gap: 14px;">
        <div>
          <label style="${labelStyle}">Nama Dosen</label>
          <select id="inDosen" required style="${formControlStyle} cursor:pointer;">
            <option value="" disabled selected>Pilih dosen pengampu...</option>
            ${buatOpsiDosenHTML()}
          </select>
        </div>
        <div style="display:flex; gap:12px;">
          <div style="flex:2;">
            <label style="${labelStyle}">Program Studi</label>
            <select id="inJurusan" onchange="window.updateDropdownMatkul()" style="${formControlStyle} cursor:pointer;">
              <option value="Teknik Informatika" selected>Teknik Informatika</option>
              <option value="Sistem Informasi">Sistem Informasi</option>
              <option value="Sains Data">Sains Data</option>
            </select>
          </div>
          <div style="flex:1;">
            <label style="${labelStyle}">Semester</label>
            <select id="inSemester" onchange="window.updateDropdownMatkul()" style="${formControlStyle} cursor:pointer;">
              <option value="II">II</option>
              <option value="IV" selected>IV</option>
              <option value="VI">VI</option>
            </select>
          </div>
          <div style="flex:1;">
            <label style="${labelStyle}">Kelas</label>
            <select id="inKelas" onchange="window.updateDropdownMatkul()" style="${formControlStyle} cursor:pointer;">
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C" selected>C</option>
              <option value="D">D</option>
              <option value="Gabungan">Gab</option>
            </select>
          </div>
        </div>
        <div style="display:flex; gap:12px;">
          <div style="flex:3;">
            <label style="${labelStyle}">Mata Kuliah</label>
            <select id="inMatkul" required style="${formControlStyle} cursor:pointer;"></select>
          </div>
          <div style="flex:1;">
            <label style="${labelStyle}">SKS</label>
            <select id="inSks" style="${formControlStyle} cursor:pointer;">
              <option value="2">2 SKS</option>
              <option value="3" selected>3 SKS</option>
              <option value="4">4 SKS</option>
            </select>
          </div>
        </div>
        <div>
          <label style="${labelStyle}">Kode Jam Perkuliahan</label>
          <select id="inKodeJam" required style="${formControlStyle} cursor:pointer;">
            <option value="" disabled selected>Pilih jam (AB, ABC, DEF...)</option>
            <option value="08.00 - 09.40">AB (08.00-09.40)</option>
            <option value="08.00 - 10.30">ABC (08.00-10.30)</option>
            <option value="09.50 - 11.30">CD (09.50-11.30)</option>
            <option value="09.50 - 12.20">CDE (09.50-12.20)</option>
            <option value="10.40 - 12.20">DE (10.40-12.20)</option>
            <option value="10.40 - 13.10">DEF (10.40-13.10)</option>
            <option value="11.40 - 13.20">EF (11.40-13.20)</option>
            <option value="14.00 - 15.40">GH (14.00-15.40)</option>
            <option value="14.00 - 16.30">GHI (14.00-16.30)</option>
            <option value="15.50 - 17.30">IJ (15.50-17.30)</option>
            <option value="15.50 - 18.20">IJK (15.50-18.20)</option>
            <option value="16.40 - 18.20">JK (16.40-18.20)</option>
            <option value="16.40 - 19.10">JKL (16.40-19.10)</option>
          </select>
        </div>
        <div style="display: flex; gap: 12px; margin-top: 14px;">
          <button type="button" onclick="tutupFormBooking()" style="flex: 1; background: white; border: 1px solid #d0d5dd; padding: 10px; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 500; font-family:'Poppins';">Batal</button>
          <button type="submit" style="flex: 2; background: #175cd3; color: white; border: none; padding: 10px; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 500; font-family:'Poppins'; transition:0.2s;">Simpan Alokasi</button>
        </div>
      </form>
    </div>`;

    document.body.appendChild(div);

    window.matkulDB = {
        "Teknik Informatika": {
            II: [
                "Struktur Data",
                "Sistem Operasi",
                "Sistem Digital",
                "Organisasi & Arsitektur Komputer",
                "Pendidikan Kewarganegaraan",
                "Matematika Informatika",
                "Agama",
            ],
            IV: [
                "Pemrograman Web",
                "Pengolahan Citra Digital",
                "Jaringan Komputer",
                "Antar Muka Pengguna/Peng. Pengguna",
                "Pembelajaran Mesin",
                "Metode Penelitian",
            ],
            VI: [
                "Keamanan Jaringan",
                "Administrasi Basis Data",
                "Manajemen Proyek Perangkat Lunak",
                "Adminstrasi Server",
                "Multimedia & Animasi",
                "Pemasaran Digital (Pilihan 2)",
                "Pemrograman Jaringan (Pilihan 2)",
                "Sistem Operasi Jaringan (Pilihan 2)",
                "Algoritma Lanjut (Pilihan 2)",
            ],
        },
        "Sistem Informasi": {
            II: [
                "Pemrograman Visual",
                "Statistika",
                "Etika",
                "Sistem Informasi Bisnis",
                "Pendidikan Pancasila",
                "Sistem Basis Data",
                "Aplikasi Multimedia",
            ],
            IV: [
                "Metode Riset Sistem Informasi",
                "Rekayasa Proses Bisnis",
                "Rekayasa Perangkat Lunak",
                "Komunikasi Data & Jaringan Komputer",
                "Pemrograman Web",
                "Rekayasa Sistem Informasi",
                "Keamanan Sistem Informasi",
                "Big Data",
                "Etika Profesi Bisnis",
                "Pemrograman Berbasis Objek",
            ],
            VI: [
                "Technopreneuship",
                "Penjaminan Mutu Perangkat Lunak",
                "Pemasaran Digital",
                "Perencanaan Sumber Daya Perusahaan",
                "Sistem Terdistribusi (Pilihan 2)",
                "Basis Data Terdistribusi (Pilihan 2)",
            ],
        },
        "Sains Data": {
            II: [
                "Kecerdasan Buatan",
                "Pemrograman Berorientasi Objek",
                "Agama",
                "Pendidikan Pancasila",
            ],
            IV: [
                "Infrastruktur dan Tek. Big Data",
                "Machine Learning",
                "Metode Visualisasi Data",
                "Manajemen Proyek Sains Data",
            ],
            VI: [
                "Analisa Big Data dan Cloud Computing",
                "Penambangan Teks",
                "Rekayasa Sains Data",
                "Deep Learning",
                "Analisis Big Data Untuk IoT (Pilihan)",
            ],
        },
    };

    window.updateDropdownMatkul = function () {
        const jurusan = document.getElementById("inJurusan").value;
        const semester = document.getElementById("inSemester").value;
        const kelas = document.getElementById("inKelas").value;
        const matkulSelect = document.getElementById("inMatkul");

        if (!matkulSelect) return;
        matkulSelect.innerHTML = "";

        const daftarMatkulSesuai = window.matkulDB[jurusan]?.[semester] || [
            "Mata Kuliah Umum / Lainnya",
        ];

        // Mencegah munculnya opsi "Prak." untuk mata kuliah yang murni Teori
        const matkulNonPrak = [
            "Agama",
            "Pendidikan Pancasila",
            "Pendidikan Kewarganegaraan",
            "Etika",
            "Etika Profesi Bisnis",
            "Matematika Informatika",
            "Metode Penelitian",
            "Metode Riset Sistem Informasi",
            "Manajemen Proyek Perangkat Lunak",
            "Manajemen Proyek Sains Data",
            "Sistem Informasi Bisnis",
            "Technopreneuship",
            "Rekayasa Sistem Informasi",
        ];

        daftarMatkulSesuai.forEach((mk) => {
            const namaTeori = kelas === "Gabungan" ? mk : `${mk} (${kelas})`;
            matkulSelect.insertAdjacentHTML(
                "beforeend",
                `<option value="${namaTeori}">${namaTeori}</option>`,
            );

            if (!matkulNonPrak.includes(mk)) {
                const namaPrak =
                    kelas === "Gabungan"
                        ? `Prak. ${mk}`
                        : `Prak. ${mk} (${kelas})`;
                matkulSelect.insertAdjacentHTML(
                    "beforeend",
                    `<option value="${namaPrak}">${namaPrak}</option>`,
                );
            }
        });
    };

    window.updateDropdownMatkul();

    document
        .getElementById("frmTransaksiBooking")
        .addEventListener("submit", (e) => {
            e.preventDefault();
            eksekusiSimpanBookingData();
        });
}

function bukaFormBookingDarurat(idRuang) {
    idRuanganDipilihSaatIni = idRuang;
    const modal = document.getElementById("modalFormBooking");
    if (!modal) return;

    const selectHari =
        document.getElementById("filterHari") ||
        document.querySelector("select:nth-of-type(1)");
    const hariAktif = selectHari ? selectHari.value : "Senin";
    const objekRuang = masterRuanganFikom[hariAktif].find(
        (r) => r.id === idRuang,
    );

    if (objekRuang) {
        if (objekRuang.status !== "Kosong") {
            alert(
                "Peringatan: Ruangan ini sedang tidak tersedia atau sudah dipakai.",
            );
            return;
        }

        document.getElementById("bookingFormTitle").innerText =
            `Ambil Alokasi Ruang ${objekRuang.nama}`;
        document.getElementById("frmTransaksiBooking").reset();
        window.updateDropdownMatkul();

        modal.style.opacity = "1";
        modal.style.pointerEvents = "auto";
    }
}

function tutupFormBooking() {
    const m = document.getElementById("modalFormBooking");
    if (m) {
        m.style.opacity = "0";
        m.style.pointerEvents = "none";
    }
    idRuanganDipilihSaatIni = null;
}

async function eksekusiSimpanBookingData() {
    if (!idRuanganDipilihSaatIni) return;

    const selectHari =
        document.getElementById("filterHari") ||
        document.querySelector("select:nth-of-type(1)");
    const hariAktif = selectHari ? selectHari.value : "Senin";

    // --- PERBAIKAN UTAMA: Mengambil nama ruangan ASLI, bukan memotong ID ---
    const objekRuang = masterRuanganFikom[hariAktif].find(
        (r) => r.id === idRuanganDipilihSaatIni,
    );
    let namaRuang = objekRuang
        ? objekRuang.nama
        : idRuanganDipilihSaatIni.split("-").slice(1).join("-");

    const dosen = document.getElementById("inDosen").value;
    const matkulLengkap = document.getElementById("inMatkul").value;
    const kelasValue = document.getElementById("inKelas").value;
    const kodeJamDB = document.getElementById("inKodeJam").value;
    const sks = parseInt(document.getElementById("inSks").value) || 3;
    const semester = document.getElementById("inSemester").value;
    const jurusan = document.getElementById("inJurusan").value;

    const payloadData = {
        hari: hariAktif,
        ruang: namaRuang, // Sekarang mengirim nama asli (Misal: "1/1" atau "Lab. F")
        dosen: dosen,
        matkul: matkulLengkap,
        jam: kodeJamDB,
        sks: sks,
        semester: semester,
        jurusan: jurusan,
        kelas: kelasValue,
    };

    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfTokenMeta) {
        alert("Sistem Keamanan (CSRF) belum terpasang di blade Anda!");
        return;
    }
    const csrfToken = csrfTokenMeta.getAttribute("content");

    const btnSubmit = document.querySelector(
        '#frmTransaksiBooking button[type="submit"]',
    );
    const originalText = btnSubmit.innerHTML;
    btnSubmit.innerHTML =
        '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';
    btnSubmit.disabled = true;

    try {
        const response = await fetch("/ruangan/booking", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
                Accept: "application/json",
            },
            body: JSON.stringify(payloadData),
        });

        const result = await response.json();

        if (result.success) {
            tutupFormBooking();
            window.location.reload();
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error("Terjadi kesalahan:", error);
        alert("Terjadi kesalahan sistem/jaringan saat menyimpan data.");
    } finally {
        btnSubmit.innerHTML = originalText;
        btnSubmit.disabled = false;
    }
}

// =========================================================================
// 7. SMART SCHEDULER: PENGGABUNGAN REAL-TIME (HARDCODE + DATABASE)
// =========================================================================
function normalisasiNamaRuang(nama) {
    if (!nama) return "";
    let n = nama.toUpperCase();
    n = n.replace(/LAB[\s\-\.]*([A-Z])/g, "LAB. $1");
    n = n.replace("III 1/2", "III/2");
    return n.trim();
}

function cekWaktuSelesaiPerkuliahan() {
    const sekarang = new Date();
    const jamSekarangStr =
        String(sekarang.getHours()).padStart(2, "0") +
        "." +
        String(sekarang.getMinutes()).padStart(2, "0");

    const selectHari =
        document.getElementById("filterHari") ||
        document.querySelector("select:nth-of-type(1)");
    const hariAktif = selectHari ? selectHari.value : "Senin";

    let daftarRuanganHariIni = masterRuanganFikom[hariAktif] || [];
    let statusBerubah = false;

    // CATATAN: sebelumnya di sini digabungkan juga data dari masterJadwalFikom
    // (mock lama di Dashboard.js yang sudah tidak dipakai). Itu dihapus karena
    // window.masterJadwalServer (dari RuanganController) sudah berisi SEMUA
    // jadwal asli dari tabel `jadwals` — baik jadwal reguler maupun booking —
    // jadi mencampur data mock lama hanya berisiko menampilkan status ruangan
    // yang salah (Sedang Digunakan/Kosong tidak sesuai data sebenarnya).
    const jadwalAsliDB =
        typeof masterJadwalServer !== "undefined" &&
        masterJadwalServer[hariAktif]
            ? masterJadwalServer[hariAktif]
            : [];

    const semuaJadwalGabungan = [...jadwalAsliDB];

    daftarRuanganHariIni.forEach((ruang) => {
        let statusAwal = ruang.status;

        let normRuang = normalisasiNamaRuang(ruang.nama);
        let kelasBerjalan = null;
        let kelasBerikutnya = null;

        // Mesin Pencari: Mengecek jadwal mana yang cocok dengan ruangan ini
        semuaJadwalGabungan.forEach((b) => {
            let normDB = normalisasiNamaRuang(b.ruang);
            if (
                normDB === normRuang ||
                normDB.includes(normRuang) ||
                normRuang.includes(normDB)
            ) {
                let jamParts = b.jam
                    ? b.jam.includes(" - ")
                        ? b.jam.split(" - ")
                        : b.jam.split("-")
                    : ["-", "-"];
                let jMulai = jamParts[0]
                    ? jamParts[0].trim().replace(":", ".")
                    : "-";
                let jSelesai = jamParts[1]
                    ? jamParts[1].trim().replace(":", ".")
                    : "-";

                if (jamSekarangStr >= jMulai && jamSekarangStr < jSelesai) {
                    kelasBerjalan = { ...b, jMulai, jSelesai };
                } else if (
                    jamSekarangStr < jMulai &&
                    (!kelasBerikutnya || jMulai < kelasBerikutnya.jMulai)
                ) {
                    kelasBerikutnya = { ...b, jMulai, jSelesai };
                }
            }
        });

        // Terapkan Status pada Kartu Ruangan
        if (kelasBerjalan) {
            // Dashboard biasanya menggunakan key 'mataKuliah' atau 'matkul'
            let namaMatkul =
                kelasBerjalan.matkul || kelasBerjalan.mataKuliah || "-";

            // Deteksi otomatis: Apakah ini jadwal reguler atau booking?
            if (namaMatkul.includes("[Booking]")) {
                ruang.status = "Booking";
            } else {
                ruang.status = "Sedang Digunakan";
            }

            ruang.matkul = namaMatkul.replace(" [Booking]", "");
            ruang.dosen = kelasBerjalan.dosen || "-";
            ruang.jamMulai = kelasBerjalan.jMulai;
            ruang.jamSelesai = kelasBerjalan.jSelesai;
        } else {
            ruang.status = "Kosong";
            ruang.matkul = "-";
            ruang.dosen = "-";
            ruang.jamMulai = "-";
            ruang.jamSelesai = "-";

            // LOGIKA BARU: Jika ruangan kosong, cek apakah ada jadwal berikutnya
            if (kelasBerikutnya) {
                ruang.status = "Akan Datang";
            }
        }

        // Terapkan info 'Next Kelas' di bawah kartu
        if (kelasBerikutnya) {
            let namaMatkulNext =
                kelasBerikutnya.matkul || kelasBerikutnya.mataKuliah || "-";
            ruang.nextMatkul = namaMatkulNext.replace(" [Booking]", "");
            ruang.nextDosen = kelasBerikutnya.dosen || "-";
            ruang.nextJamMulai = kelasBerikutnya.jMulai;
            ruang.nextJamSelesai = kelasBerikutnya.jSelesai;

            // Jika statusnya "Akan Datang", data utama diisi dari jadwal berikutnya
            if (ruang.status === "Akan Datang") {
                ruang.matkul = ruang.nextMatkul;
                ruang.dosen = ruang.nextDosen;
                ruang.jamMulai = ruang.nextJamMulai;
                ruang.jamSelesai = ruang.nextJamSelesai;
            }
        } else {
            ruang.nextMatkul = "-";
            ruang.nextDosen = "-";
            ruang.nextJamMulai = "-";
            ruang.nextJamSelesai = "-";
        }

        if (statusAwal !== ruang.status) statusBerubah = true;
    });

    return statusBerubah;
}

// =========================================================================
// 8. WIDGET REAL-TIME CALCULATOR COUNTER
// =========================================================================
function updateWidgetRingkasanStatus(dataRuangan) {
    let totalRuangKosong = 0;
    let totalRuangDipakai = 0;

    dataRuangan.forEach((r) => {
        if (r.status === "Kosong" || r.status === "Akan Datang")
            totalRuangKosong++;
        else if (
            r.status === "Sedang Digunakan" ||
            r.status === "Dipakai" ||
            r.status === "Booking"
        )
            totalRuangDipakai++;
    });

    const txtKosong = document.getElementById("statKosong");
    const txtDipakai = document.getElementById("statDipakai");

    if (txtKosong) txtKosong.innerText = `${totalRuangKosong} Ruang`;
    if (txtDipakai) txtDipakai.innerText = `${totalRuangDipakai} Ruang`;
}
