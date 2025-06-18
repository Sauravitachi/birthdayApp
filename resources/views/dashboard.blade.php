<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="text-muted mb-2">Users</div>
                            <div class="h1 m-0">{{ $userCount ?? '...' }}</div>
                        </div>
                    </div>
                </div>
                <!-- Add more cards or stats as needed -->
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Welcome!</h3>
                </div>
                <div class="card-body">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
