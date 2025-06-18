<?php

use App\Http\Middleware\CheckBirthdays;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Apply to all web routes
        $middleware->web(append: [
            CheckBirthdays::class
        ]);
        
        
    })
    ->withSchedule(function (Schedule $schedule) {
        // Schedule the birthday cache command to run daily
        $schedule->command('app:cache-birthdays')
            ->dailyAt('00:05')
            ->timezone('Asia/Kolkata')
            ->runInBackground();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Your existing exception handling
        $exceptions->reportable(function (\Throwable $e) {
            // Report exceptions
        });
    })->create();