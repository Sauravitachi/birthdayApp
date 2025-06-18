<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - Laravel</title>

    <!-- Tabler CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet" />

    <style>
        .welcome-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 80px);
        }

        .welcome-card {
            max-width: 960px;
            width: 100%;
        }

        .welcome-logo svg {
            height: 80px;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: .5rem;
            margin-right: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            padding: 1rem 0;
        }

        .feature-item:not(:last-child) {
            border-bottom: 1px solid #e0e0e0;
        }

        .btn-group-auth {
            display: flex;
            gap: 0.5rem;
        }

        .welcome-image {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
    </style>
</head>

<body class="d-flex flex-column">
    <header class="navbar navbar-expand-md navbar-light border-bottom">
        <div class="container-xl">
            <a href="#" class="navbar-brand">BirthdayApp</a>
            <div class="navbar-nav ms-auto">
                @if (Route::has('login'))
                    <div class="btn-group-auth d-none d-md-flex align-items-center">
                        @auth
                            <a href="{{ url('/user') }}" class="btn btn-outline-primary">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </header>

    <main class="page page-center">
        <div class="container-xl welcome-wrapper">
            <div class="card welcome-card shadow-sm">
                <div class="row g-0">
                    <div class="col-md-6 p-4">
                        <div class="welcome-logo mb-4">
                           
                        </div>

                        <h2 class="mb-2">Welcome to Laravel</h2>
                        <p class="text-muted">Laravel is a web application framework with expressive, elegant syntax. We've already laid the foundation — freeing you to create without sweating the small things.</p>

                        <div class="mt-4">
                            <div class="feature-item">
                                <div class="feature-icon bg-blue-lt text-blue">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-books" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path d="M0 0h24v24H0z" fill="none" /><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6v13" /><path d="M12 6v13" /><path d="M21 6v13" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="mb-1">Documentation</h3>
                                    <p class="text-muted">Laravel offers great documentation covering every part of the framework.</p>
                                    <a href="https://laravel.com/docs" target="_blank" class="btn btn-sm btn-link">Explore Docs</a>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon bg-purple-lt text-purple">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-video" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path d="M0 0h24v24H0z" fill="none" /><path d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z" /><rect x="3" y="6" width="12" height="12" rx="2" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="mb-1">Laracasts</h3>
                                    <p class="text-muted">Laracasts offers thousands of videos on Laravel, PHP, and more.</p>
                                    <a href="https://laracasts.com" target="_blank" class="btn btn-sm btn-link">Start Watching</a>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="https://forge.laravel.com" class="btn btn-primary" target="_blank">
                                Deploy with Laravel Forge
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 welcome-image d-none d-md-flex">
                        <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel" class="img-fluid" style="max-height: 300px;">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Tabler JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
</body>

</html>
