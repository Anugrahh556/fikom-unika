// =========================================================================
// 1. DATABASE UTAMA DAFTAR 26 DOSEN FIKOM UNIKA SANTO THOMAS
// =========================================================================
let dataDosenLengkap = [];
// Data dosen diambil dari database asli (dikirim dari dosen.blade.php via
// window.dosenDariDatabase), bukan lagi hardcode di JS. Kalau untuk suatu
// alasan variabel ini belum tersedia, fallback ke array kosong (bukan crash).
if (
    typeof window.dosenDariDatabase !== "undefined" &&
    Array.isArray(window.dosenDariDatabase)
) {
    dataDosenLengkap = window.dosenDariDatabase;
} else {
    console.warn(
        "window.dosenDariDatabase tidak ditemukan — pastikan dosen.blade.php mengirimkannya.",
    );
}

const itemPerHalaman = 10; // Menampilkan 10 data per halaman agar tabel rapi
let halamanSekarang = 1;
let dataHasilSaring = [...dataDosenLengkap];
let idDosenAktifDiPreview = 1;

document.addEventListener("DOMContentLoaded", () => {
    // Pastikan data terurut berdasarkan ID saat aplikasi mulai
    dataDosenLengkap.sort((a, b) => a.id - b.id);
    perbaruiStatistikDashboard();
    jalankanPenyaringanDosen();
    sinkronisasiHighlightDanPreview(idDosenAktifDiPreview);

    const searchDosenInput = document.getElementById("searchDosenInput");
    if (searchDosenInput) {
        searchDosenInput.addEventListener("input", () => {
            halamanSekarang = 1;
            jalankanPenyaringanDosen();
        });
    }

    const btnTambah = document.getElementById("btnTambah");
    const modalTambah = document.getElementById("modalTambah");
    const closeTambah = document.getElementById("closeTambah");

    if (btnTambah && modalTambah && closeTambah) {
        btnTambah.addEventListener(
            "click",
            () => (modalTambah.style.display = "flex"),
        );
        closeTambah.addEventListener(
            "click",
            () => (modalTambah.style.display = "none"),
        );
    }

    const closeEdit = document.getElementById("closeEdit");
    const modalEdit = document.getElementById("modalEdit");
    if (closeEdit && modalEdit) {
        closeEdit.addEventListener(
            "click",
            () => (modalEdit.style.display = "none"),
        );
    }
});

function jalankanPenyaringanDosen() {
    const searchInput = document.getElementById("searchDosenInput");
    const kataKunci = searchInput ? searchInput.value.toLowerCase().trim() : "";

    dataHasilSaring = dataDosenLengkap.filter((dosen) => {
        return (
            kataKunci === "" ||
            dosen.nama.toLowerCase().includes(kataKunci) ||
            dosen.nidn.includes(kataKunci) ||
            dosen.prodi.toLowerCase().includes(kataKunci)
        );
    });

    renderTabelDosen();
    updatePaginationUI();
}

// Animasi hitung naik dari 0 sampai angka target (dipakai di kartu statistik)
function animasikanAngkaNaik(elemen, angkaTarget, durasiMs = 900) {
    if (!elemen) return;

    const angkaAwal = parseInt(elemen.innerText, 10) || 0;
    // Kalau tidak ada perubahan, tidak perlu dianimasikan
    if (angkaAwal === angkaTarget) {
        elemen.innerText = angkaTarget;
        return;
    }

    const waktuMulai = performance.now();

    function langkahAnimasi(waktuSekarang) {
        const progres = Math.min((waktuSekarang - waktuMulai) / durasiMs, 1);
        // Easing biar melambat menjelang akhir (terasa lebih halus, bukan gerak lurus kaku)
        const progresHalus = 1 - Math.pow(1 - progres, 3);
        const angkaSaatIni = Math.round(
            angkaAwal + (angkaTarget - angkaAwal) * progresHalus,
        );

        elemen.innerText = angkaSaatIni;

        if (progres < 1) {
            requestAnimationFrame(langkahAnimasi);
        } else {
            elemen.innerText = angkaTarget; // pastikan berhenti tepat di angka final
        }
    }

    requestAnimationFrame(langkahAnimasi);
}

function perbaruiStatistikDashboard() {
    const totalDosen = dataDosenLengkap.filter(
        (d) => d.status === "Aktif",
    ).length;
    const dosenTetap = dataDosenLengkap.filter(
        (d) => d.jabatan === "Dosen Tetap",
    ).length;

    animasikanAngkaNaik(document.getElementById("statTotalDosen"), totalDosen);
    animasikanAngkaNaik(document.getElementById("statDosenTetap"), dosenTetap);
}

function renderTabelDosen() {
    const tbody = document.getElementById("dosenTableBody");
    if (!tbody) return;
    tbody.innerHTML = "";

    if (dataHasilSaring.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" style="color: #888; padding: 30px; text-align: center;">Data dosen tidak ditemukan.</td></tr>`;
        return;
    }

    const indexMulai = (halamanSekarang - 1) * itemPerHalaman;
    const dataPerHalaman = dataHasilSaring.slice(
        indexMulai,
        indexMulai + itemPerHalaman,
    );

    dataPerHalaman.forEach((dosen, index) => {
        const tr = document.createElement("tr");
        const nomorUrut = indexMulai + index + 1;

        tr.setAttribute("id", `row-dosen-${dosen.id}`);
        tr.className = dosen.id === idDosenAktifDiPreview ? "row-active" : "";

        const kelasBadgeStatus =
            dosen.status === "Aktif"
                ? "badge-status-aktif"
                : "badge-status-nonaktif";

        tr.innerHTML = `
            <td>${nomorUrut}</td>
            <td style="text-align: left; padding-left: 20px; font-weight:500;">${dosen.nama}</td>
            <td>${dosen.nidn}</td>
            <td>${dosen.prodi}</td>
            <td><span class="${kelasBadgeStatus}">${dosen.status}</span></td>
            <td>
                <button class="btn-edit-row" onclick="bukaModalEditDosen(event, ${dosen.id})">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>
            </td>
        `;

        tr.onclick = () => {
            document
                .querySelectorAll("#dosenTableBody tr")
                .forEach((r) => r.classList.remove("row-active"));
            tr.classList.add("row-active");
            idDosenAktifDiPreview = dosen.id;
            updateProfilPreviewPanel(dosen);
        };

        tbody.appendChild(tr);
    });

    const infoPagination = document.getElementById("paginationInfo");
    if (infoPagination) {
        const entriAkhir = Math.min(
            indexMulai + dataPerHalaman.length,
            dataHasilSaring.length,
        );
        infoPagination.innerText = `Showing ${indexMulai + 1} to ${entriAkhir} of ${dataHasilSaring.length} entries`;
    }
}

function updateProfilPreviewPanel(dosen) {
    if (!dosen) return;
    document.getElementById("prevFoto").src = dosen.foto;
    document.getElementById("prevNama").innerText = dosen.nama;
    document.getElementById("prevProdi").innerText = dosen.prodi;
    document.getElementById("prevEmail").innerText = dosen.email;
    document.getElementById("prevPhone").innerText = dosen.phone;

    const badgeContainer = document.getElementById("prevBadgeContainer");
    badgeContainer.innerHTML = "";

    if (dosen.jabatan === "Dekan" || dosen.jabatan === "Wakil Dekan") {
        const spanBadge = document.createElement("span");
        spanBadge.className = "badge-kuning-struktural";
        spanBadge.innerText = dosen.jabatan;
        badgeContainer.appendChild(spanBadge);
    }
}

function sinkronisasiHighlightDanPreview(idTarget) {
    const targetDosen = dataDosenLengkap.find((d) => d.id === idTarget);
    if (targetDosen) {
        updateProfilPreviewPanel(targetDosen);
        idDosenAktifDiPreview = idTarget;

        setTimeout(() => {
            const currentActiveRow = document.getElementById(
                `row-dosen-${idTarget}`,
            );
            if (currentActiveRow) {
                document
                    .querySelectorAll("#dosenTableBody tr")
                    .forEach((r) => r.classList.remove("row-active"));
                currentActiveRow.classList.add("row-active");
            }
        }, 50);
    }
}

function updatePaginationUI() {
    const containerTombol = document.querySelector(".pagination-buttons");
    if (!containerTombol) return;
    containerTombol.innerHTML = "";

    const totalHalaman = Math.ceil(dataHasilSaring.length / itemPerHalaman);
    if (totalHalaman <= 1) return;

    // Tombol Previous (Mundur)
    const btnPrev = document.createElement("button");
    btnPrev.className = "page-btn prev-btn";
    btnPrev.innerHTML = '<i class="fa-solid fa-chevron-left"></i>';
    btnPrev.disabled = halamanSekarang === 1;
    btnPrev.addEventListener("click", () =>
        ubahHalamanDosen(halamanSekarang - 1),
    );
    containerTombol.appendChild(btnPrev);

    for (let i = 1; i <= totalHalaman; i++) {
        const btn = document.createElement("button");
        btn.className =
            i === halamanSekarang ? "page-btn active-page" : "page-btn";
        btn.innerText = i;

        btn.addEventListener("click", (e) => {
            ubahHalamanDosen(i);
        });
        containerTombol.appendChild(btn);
    }

    // Tombol Next (Maju)
    const btnNext = document.createElement("button");
    btnNext.className = "page-btn next-btn";
    btnNext.innerHTML = '<i class="fa-solid fa-chevron-right"></i>';
    btnNext.disabled = halamanSekarang === totalHalaman;
    btnNext.addEventListener("click", () =>
        ubahHalamanDosen(halamanSekarang + 1),
    );
    containerTombol.appendChild(btnNext);
}

// Fungsi Pembantu untuk Transisi Antar Halaman
function ubahHalamanDosen(halamanTujuan) {
    halamanSekarang = halamanTujuan;
    renderTabelDosen();
    updatePaginationUI();

    const indexMulai = (halamanSekarang - 1) * itemPerHalaman;
    const dataHalamanBaru = dataHasilSaring.slice(
        indexMulai,
        indexMulai + itemPerHalaman,
    );

    if (dataHalamanBaru.length > 0) {
        sinkronisasiHighlightDanPreview(dataHalamanBaru[0].id);
    }
}

// Ambil CSRF token dari meta tag (wajib ada di <head> dosen.blade.php)
// supaya request POST ke Laravel tidak ditolak dengan error 419.
function ambilCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.getAttribute("content") : null;
}

async function tambahDosen() {
    const nama = document.getElementById("namaInput").value.trim();
    const nidn = document.getElementById("nidnInput").value.trim();
    const prodi = document.getElementById("prodiInput").value.trim();
    const jabatan =
        document.getElementById("jabatanInput").value.trim() || "Dosen Tetap";
    const email = document.getElementById("emailInput").value.trim();
    const phone = document.getElementById("phoneInput").value.trim();

    if (!nama || !nidn || !prodi) {
        alert("Mohon isi field Nama, NIDN, dan Prodi terlebih dahulu!");
        return;
    }

    const csrfToken = ambilCsrfToken();
    if (!csrfToken) {
        alert(
            "Token keamanan (CSRF) tidak ditemukan. Muat ulang halaman dan coba lagi.",
        );
        return;
    }

    const tombolSimpan = document.querySelector("#modalTambah .btn-simpan");
    const teksAsli = tombolSimpan ? tombolSimpan.innerText : null;
    if (tombolSimpan) {
        tombolSimpan.innerText = "Menyimpan...";
        tombolSimpan.disabled = true;
    }

    try {
        const response = await fetch("/dosen/tambah", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
                Accept: "application/json",
            },
            body: JSON.stringify({ nama, nidn, prodi, jabatan, email, phone }),
        });

        const result = await response.json();

        if (!response.ok || !result.success) {
            // Laravel mengirim daftar error validasi di result.errors (mis. NIDN sudah dipakai)
            const pesanError = result.errors
                ? Object.values(result.errors).flat().join("\n")
                : result.message || "Gagal menyimpan data dosen.";
            alert(pesanError);
            return;
        }

        // Sukses tersimpan di database — masukkan data ASLI dari server
        // (termasuk id auto-increment yang benar) ke tabel di layar.
        dataDosenLengkap.push(result.data);

        // Reset form field input
        document.getElementById("namaInput").value = "";
        document.getElementById("nidnInput").value = "";
        document.getElementById("prodiInput").value = "";
        document.getElementById("jabatanInput").value = "";
        document.getElementById("emailInput").value = "";
        document.getElementById("phoneInput").value = "";

        document.getElementById("modalTambah").style.display = "none";
        alert(result.message || `Berhasil menambahkan dosen baru: ${nama}`);

        perbaruiStatistikDashboard();
        jalankanPenyaringanDosen();
        sinkronisasiHighlightDanPreview(result.data.id);
    } catch (error) {
        console.error("Gagal menambah dosen:", error);
        alert("Terjadi kesalahan jaringan/sistem saat menyimpan data dosen.");
    } finally {
        if (tombolSimpan) {
            tombolSimpan.innerText = teksAsli;
            tombolSimpan.disabled = false;
        }
    }
}

function bukaModalEditDosen(event, idDosen) {
    event.stopPropagation();

    const dosen = dataDosenLengkap.find((d) => d.id === idDosen);
    if (!dosen) return;

    document.getElementById("editIdInput").value = dosen.id;
    document.getElementById("editNamaInput").value = dosen.nama;
    document.getElementById("editNidnInput").value = dosen.nidn;
    document.getElementById("editProdiInput").value = dosen.prodi;
    document.getElementById("editJabatanInput").value = dosen.jabatan;
    document.getElementById("editEmailInput").value = dosen.email;
    document.getElementById("editPhoneInput").value = dosen.phone;

    // Tampilkan foto yang sedang tersimpan, dan kosongkan pilihan file
    // lama supaya tidak ke-upload ulang kalau admin tidak ganti foto.
    document.getElementById("editFotoPreview").src = dosen.foto || "";
    const inputFoto = document.getElementById("editFotoInput");
    inputFoto.value = "";

    document.getElementById("modalEdit").style.display = "flex";
}

// Tampilkan pratinjau langsung begitu admin memilih file foto baru
const inputEditFotoEl = document.getElementById("editFotoInput");
if (inputEditFotoEl) {
    inputEditFotoEl.addEventListener("change", () => {
        const file = inputEditFotoEl.files[0];
        if (file) {
            document.getElementById("editFotoPreview").src =
                URL.createObjectURL(file);
        }
    });
}

async function simpanEditDosen() {
    const id = parseInt(document.getElementById("editIdInput").value);
    const nama = document.getElementById("editNamaInput").value.trim();
    const nidn = document.getElementById("editNidnInput").value.trim();
    const prodi = document.getElementById("editProdiInput").value.trim();
    const jabatan = document.getElementById("editJabatanInput").value.trim();
    const email = document.getElementById("editEmailInput").value.trim();
    const phone = document.getElementById("editPhoneInput").value.trim();

    if (!nama || !nidn || !prodi) {
        alert("Nama, NIDN, dan Program Studi tidak boleh dikosongkan!");
        return;
    }

    const csrfToken = ambilCsrfToken();
    if (!csrfToken) {
        alert(
            "Token keamanan (CSRF) tidak ditemukan. Muat ulang halaman dan coba lagi.",
        );
        return;
    }

    const tombolSimpan = document.querySelector("#modalEdit .btn-simpan");
    const teksAsli = tombolSimpan ? tombolSimpan.innerText : null;
    if (tombolSimpan) {
        tombolSimpan.innerText = "Menyimpan...";
        tombolSimpan.disabled = true;
    }

    try {
        // Pakai FormData (bukan JSON) supaya file foto bisa ikut terkirim.
        // PENTING: jangan set header 'Content-Type' manual di sini — browser
        // butuh menetapkan boundary multipart-nya sendiri secara otomatis.
        const formData = new FormData();
        formData.append("id", id);
        formData.append("nama", nama);
        formData.append("nidn", nidn);
        formData.append("prodi", prodi);
        formData.append("jabatan", jabatan);
        formData.append("email", email);
        formData.append("phone", phone);

        const fileFoto = document.getElementById("editFotoInput").files[0];
        if (fileFoto) {
            formData.append("foto", fileFoto);
        }

        const response = await fetch("/dosen/edit", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                Accept: "application/json",
            },
            body: formData,
        });

        const result = await response.json();

        if (!response.ok || !result.success) {
            const pesanError = result.errors
                ? Object.values(result.errors).flat().join("\n")
                : result.message || "Gagal menyimpan perubahan data dosen.";
            alert(pesanError);
            return;
        }

        // Sukses tersimpan di database — sinkronkan array lokal supaya
        // tabel di layar langsung mencerminkan data yang baru saja disimpan.
        const indexDosen = dataDosenLengkap.findIndex((d) => d.id === id);
        if (indexDosen !== -1) {
            dataDosenLengkap[indexDosen].nama = nama;
            dataDosenLengkap[indexDosen].nidn = nidn;
            dataDosenLengkap[indexDosen].prodi = prodi;
            dataDosenLengkap[indexDosen].jabatan = jabatan;
            dataDosenLengkap[indexDosen].email = email;
            dataDosenLengkap[indexDosen].phone = phone;
            // 'foto' hanya berubah di server kalau admin memang upload file
            // baru — respons server selalu punya URL foto terkini (baik
            // yang baru diupload maupun yang lama tidak berubah).
            if (result.data && result.data.foto) {
                dataDosenLengkap[indexDosen].foto = result.data.foto;
            }
        }

        document.getElementById("modalEdit").style.display = "none";
        alert(result.message || "Perubahan profil dosen berhasil disimpan!");

        perbaruiStatistikDashboard();
        jalankanPenyaringanDosen();
        sinkronisasiHighlightDanPreview(id);
    } catch (error) {
        console.error("Gagal menyimpan perubahan dosen:", error);
        alert(
            "Terjadi kesalahan jaringan/sistem saat menyimpan perubahan data dosen.",
        );
    } finally {
        if (tombolSimpan) {
            tombolSimpan.innerText = teksAsli;
            tombolSimpan.disabled = false;
        }
    }
}
