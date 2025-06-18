<?php
namespace App\Providers;

use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Passwords\DatabaseTokenRepository;

class PasswordResetServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('auth.password', function ($app) {
            return new class($app) extends PasswordBrokerManager {
                protected function createTokenRepository(array $config)
                {
                    return new class(
                        $this->app['db']->connection(),
                        $this->app['hash'],
                        $config['table'],
                        $this->app['config']['app.key'],
                        $config['expire'],
                        $config['throttle'] ?? 0
                    ) extends DatabaseTokenRepository {
                        public function sendTokenNotification($token, $email)
                        {
                            // Store in session instead of sending email
                            session()->flash('reset_link', route('password.reset', [
                                'token' => $token,
                                'email' => $email
                            ]));
                            
                            session()->flash('expires_at', now()->addMinutes(
                                config('auth.passwords.users.expire')
                            )->format('Y-m-d H:i:s'));
                        }
                    };
                }
            };
        });
    }
}