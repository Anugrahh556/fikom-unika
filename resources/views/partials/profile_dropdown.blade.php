<div class="profile" id="profileDropdownBtn" style="cursor: pointer;">
    <img src="https://api.dicebear.com/7.x/initials/svg?seed={{ Auth::user()->name }}" alt="User Avatar" style="border-radius: 50%; width: 42px; height: 42px; object-fit: cover;" />
    <div class="profile-info">
        <h4>{{ Auth::user()->name }}</h4>
        <p>{{ strtoupper(Auth::user()->role) }}</p>
    </div>
    <i class="fa-solid fa-chevron-down dropdown-icon"></i>
    
    {{-- Dropdown Profile --}}
    <div class="dropdown-content" id="myDropdown">
        <a href="{{ url('/logout') }}" style="color: #b30000; padding: 12px 16px; text-decoration: none; display: block; font-size: 14px; font-weight: 500;">
            <i class="fa-solid fa-right-from-bracket" style="margin-right: 8px;"></i> Keluar Sistem
        </a>
    </div>
</div>