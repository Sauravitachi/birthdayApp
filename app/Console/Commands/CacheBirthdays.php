<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheBirthdays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cache-birthdays 
                            {--force : Force refresh even if already cached}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache users with birthdays today for birthday notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $today = now()->format('m-d');
            
            // Skip if already cached (unless --force option used)
            if (Cache::has('todays_birthdays') && !$this->option('force')) {
                $this->info('Birthdays already cached for today. Use --force to refresh.');
                return 0;
            }

            $this->info("Fetching users with birthdays on {$today}...");
            
            $birthdayUsers = User::query()
                ->whereRaw("DATE_FORMAT(date_of_birth, '%m-%d') = ?", [$today])
                ->select(['id', 'first_name', 'last_name', 'date_of_birth', 'email'])
                ->orderBy('first_name')
                ->get();
            
            $count = $birthdayUsers->count();
            
            if ($count > 0) {
                Cache::put('todays_birthdays', $birthdayUsers, now()->addDay());
                $this->info("Successfully cached birthdays for {$count} users.");
                
                $summary = $birthdayUsers->take(5)->map(function ($user) {
                    return "{$user->first_name} {$user->last_name} ({$user->email})";
                })->implode(', ');
                
                if ($count > 5) {
                    $summary .= " and " . ($count - 5) . " more";
                }
                
                Log::info("Birthday cache updated for {$count} users: " . $summary);
            } else {
                Cache::put('todays_birthdays', collect(), now()->addDay());
                $this->info("No birthdays found for today. Empty cache set.");
            }
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error("Failed to cache birthdays: " . $e->getMessage());
            Log::error("Birthday cache command failed: " . $e->getMessage(), [
                'exception' => $e
            ]);
            return 1;
        }
    }
}