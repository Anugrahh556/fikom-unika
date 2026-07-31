<div class="profile" id="profileDropdownBtn" style="cursor: pointer;">
    <img src="https://api.dicebear.com/7.x/initials/svg?seed=<?php echo e(Auth::user()->name); ?>" alt="User Avatar" style="border-radius: 50%; width: 42px; height: 42px; object-fit: cover;" />
    <div class="profile-info">
        <h4><?php echo e(Auth::user()->name); ?></h4>
        <p><?php echo e(strtoupper(Auth::user()->role)); ?></p>
    </div>
    <i class="fa-solid fa-chevron-down dropdown-icon"></i>
    
    
    <div class="dropdown-content" id="myDropdown">
        <a href="<?php echo e(url('/logout')); ?>" style="color: #b30000; padding: 12px 16px; text-decoration: none; display: block; font-size: 14px; font-weight: 500;">
            <i class="fa-solid fa-right-from-bracket" style="margin-right: 8px;"></i> Keluar Sistem
        </a>
    </div>
</div><?php /**PATH C:\laragon\www\fikom-unika\resources\views/partials/profile_dropdown.blade.php ENDPATH**/ ?>