<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom shadow-sm">
    <div class="container-xl">
        <!-- Brand / Logo -->
        <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center">
            <x-application-logo class="block h-8 w-auto me-2" />
            <span class="navbar-brand-text">BirthdayApp</span>
        </a>

        
        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbar-menu">
           

            <!-- User Dropdown -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown"
                        role="button" aria-expanded="false">
                        <span
                            class="avatar avatar-sm me-2 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                            {{ strtoupper(substr(Auth::user()->first_name ?? 'N', 0, 1)) }}
                        </span>
                        <div>
                            <div class="text-truncate">{{ Auth::user()->first_name ?? 'User' }}</div>
                            <small class="text-muted d-block">{{ Auth::user()->email }}</small>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap collapse
    const navbarCollapse = new bootstrap.Collapse(document.getElementById('navbar-menu'), {
        toggle: false
    });
    
    // Close menu when clicking nav links (mobile only)
    document.querySelectorAll('.nav-link:not(.dropdown-toggle)').forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 768) { // Check for mobile view
                navbarCollapse.hide();
            }
        });
    });
    
    // Close menu when clicking dropdown items (mobile only)
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function() {
            if (window.innerWidth < 768) {
                navbarCollapse.hide();
            }
        });
    });
});
</script>