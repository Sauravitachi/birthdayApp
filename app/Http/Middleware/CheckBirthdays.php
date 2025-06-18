<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CheckBirthdays
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only check for authenticated web users
        if (!$request->user() || !$request->acceptsHtml()) {
            return $response;
        }

        // Get cached birthdays or empty collection
        $birthdayUsers = Cache::get('todays_birthdays', collect());

        if ($birthdayUsers->isNotEmpty()) {
            // Store only IDs in session to minimize data
            session()->flash('birthday_user_ids', $birthdayUsers->pluck('id'));
        }

        return $response;
    }
}