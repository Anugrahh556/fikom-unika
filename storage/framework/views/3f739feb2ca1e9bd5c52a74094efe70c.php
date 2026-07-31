<div class="notification" id="notification-icon" style="cursor: pointer; position: relative;">
    <i class="fa-regular fa-bell"></i>

    
    <?php if(isset($jadwalTerbaru) && count($jadwalTerbaru) > 0): ?>
        <span class="notif-badge"><?php echo e(count($jadwalTerbaru)); ?></span>
    <?php endif; ?>

    
    <div class="notification-dropdown" id="notification-dropdown">
        <div class="notification-header">
            <h4>Notifikasi Terbaru</h4>
            <?php if(isset($jadwalTerbaru) && count($jadwalTerbaru) > 0): ?>
                <button type="button" class="btn-hapus-notif" id="btnHapusSemuaNotif">Hapus Semua</button>
            <?php endif; ?>
        </div>
        <div class="notification-body" id="notificationBody">
            <?php $__empty_1 = true; $__currentLoopData = $jadwalTerbaru ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="notification-item" data-notif-id="<?php echo e($notif->id ?? ($notif->matakuliah . '_' . $notif->jam)); ?>">
                    <div class="notif-icon-wrapper">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                    <div class="notif-content">
                        
                        <p>Jadwal <strong><?php echo e(Str::limit($notif->matakuliah, 25)); ?></strong> telah diperbarui menjadi jam <strong><?php echo e($notif->jam); ?></strong>.</p>
                        <?php if(isset($notif->updated_at)): ?>
                        <small><?php echo e(\Carbon\Carbon::parse($notif->updated_at)->diffForHumans()); ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="notification-empty">
                    <i class="fa-solid fa-check-double"></i>
                    <p>Tidak ada pembaruan jadwal.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Mandiri (self-contained) supaya jalan di halaman mana pun partial ini di-include,
    // tanpa perlu duplikasi script di tiap blade (Dashboard, Dosen, Jadwal, Ruangan, dst).
    (function () {
        const STORAGE_KEY = 'dismissedNotifIds';
        const MAX_STORED_IDS = 300; // batas biar localStorage nggak numpuk selamanya

        const getDismissedIds = () => {
            try {
                const raw = localStorage.getItem(STORAGE_KEY);
                const arr = raw ? JSON.parse(raw) : [];
                return Array.isArray(arr) ? arr : [];
            } catch (e) {
                return [];
            }
        };

        const saveDismissedIds = (idsArray) => {
            try {
                // Simpan hanya N terakhir supaya tidak tumbuh tanpa batas
                const trimmed = idsArray.slice(-MAX_STORED_IDS);
                localStorage.setItem(STORAGE_KEY, JSON.stringify(trimmed));
            } catch (e) {
                // localStorage penuh/diblokir browser -> abaikan, fallback ke perilaku lama (per-sesi saja)
            }
        };

        const emptyStateHTML = `
            <div class="notification-empty">
                <i class="fa-solid fa-check-double"></i>
                <p>Tidak ada pembaruan jadwal.</p>
            </div>
        `;

        const updateBadge = (visibleCount) => {
            const badge = document.querySelector('#notification-icon .notif-badge');
            if (visibleCount > 0) {
                if (badge) {
                    badge.textContent = visibleCount;
                } else {
                    const icon = document.getElementById('notification-icon');
                    if (icon) {
                        const span = document.createElement('span');
                        span.className = 'notif-badge';
                        span.textContent = visibleCount;
                        icon.appendChild(span);
                    }
                }
            } else if (badge) {
                badge.remove();
            }
        };

        // --- 1. Saat halaman dimuat: sembunyikan notifikasi yang sudah pernah dihapus ---
        const dismissedIds = getDismissedIds();
        const body = document.getElementById('notificationBody');
        const btnHapus = document.getElementById('btnHapusSemuaNotif');

        if (body && dismissedIds.length > 0) {
            const items = body.querySelectorAll('.notification-item[data-notif-id]');
            items.forEach((item) => {
                if (dismissedIds.includes(item.getAttribute('data-notif-id'))) {
                    item.remove();
                }
            });
        }

        // Hitung ulang notifikasi yang masih tersisa setelah difilter
        const remainingItems = body ? body.querySelectorAll('.notification-item[data-notif-id]') : [];
        updateBadge(remainingItems.length);

        if (body && remainingItems.length === 0 && body.querySelector('.notification-item')) {
            // (jaga-jaga, walau seharusnya sudah kehapus semua di atas)
        }
        if (body && remainingItems.length === 0) {
            body.innerHTML = emptyStateHTML;
            if (btnHapus) btnHapus.remove();
        }

        // --- 2. Saat klik "Hapus Semua": catat id-id yang lagi tampil supaya nggak muncul lagi ---
        if (!btnHapus) return;

        btnHapus.addEventListener('click', function (e) {
            e.stopPropagation(); // jangan sampai ikut nutup dropdown-nya sendiri

            const currentBody = document.getElementById('notificationBody');
            if (currentBody) {
                const idsToStore = getDismissedIds();
                currentBody.querySelectorAll('.notification-item[data-notif-id]').forEach((item) => {
                    const id = item.getAttribute('data-notif-id');
                    if (id && !idsToStore.includes(id)) idsToStore.push(id);
                });
                saveDismissedIds(idsToStore);

                currentBody.innerHTML = emptyStateHTML;
            }

            updateBadge(0);
            btnHapus.remove();
        });
    })();
</script><?php /**PATH C:\laragon\www\fikom-unika\resources\views/partials/notification_bell.blade.php ENDPATH**/ ?>