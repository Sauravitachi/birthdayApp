<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en" data-theme="{{ request()->cookie('theme', 'light') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
<!-- Tabler Core CSS -->
<link href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet" />

<!-- Tabler JS can stay if you want Tabler components -->
<script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js" defer></script>

<!-- ✅ Add Bootstrap JS for navbar collapse to work -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-vMO8cPfAjR3MZB7XRI9+7E2+Dx+FW32LTT5RrE0kHvlImUwDbosKqH2nEJ1nAPiG" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        @hasSection('header')
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <main>
            @yield('content')
        </main>
    </div>
    @if(session('birthday_users'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach(session('birthday_users') as $user)
                // Using Tabler's toast notification
                const toastHtml = `
                    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <i class="ti ti-cake me-2"></i>
                            <strong class="me-auto">Birthday Alert</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Happy Birthday, {{ $user->first_name }} {{ $user->last_name }}! 🎉
                        </div>
                    </div>
                `;
                
                // Create a temporary container
                const container = document.createElement('div');
                container.innerHTML = toastHtml;
                const toastElement = container.firstChild;
                
                // Add to page and show
                document.body.appendChild(toastElement);
                
                // Auto-remove after 10 seconds
                setTimeout(() => {
                    toastElement.remove();
                }, 10000);
            @endforeach
        });
    </script>
@endif
</body>
</html>
