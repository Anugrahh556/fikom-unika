document.addEventListener("DOMContentLoaded", () => {
    // =========================================================================
    // LOGIKA GLOBAL UNTUK KOMPONEN LAYOUT (SIDEBAR, TOPBAR, NOTIFIKASI)
    // =========================================================================

    const notifIcon = document.getElementById("notification-icon");
    const notifDropdown = document.getElementById("notification-dropdown");

    if (notifIcon && notifDropdown) {
        notifIcon.addEventListener("click", function (event) {
            event.stopPropagation(); // Mencegah event klik menyebar ke window
            // Toggle (Buka/Tutup) dropdown notifikasi
            const isVisible = notifDropdown.style.display === "block";
            notifDropdown.style.display = isVisible ? "none" : "block";
        });

        // Menutup dropdown jika user mengklik di luar area notifikasi
        window.addEventListener("click", function (event) {
            if (
                notifDropdown.style.display === "block" &&
                !notifIcon.contains(event.target) &&
                !notifDropdown.contains(event.target)
            ) {
                notifDropdown.style.display = "none";
            }
        });
    }
});
