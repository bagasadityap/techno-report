<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        Gate::define('dashboard', function ($user) {
            return $user->can('Dashboard');
        });
        
        Gate::define('user', function ($user) {
            return $user->can('Usercrud');
        });
        Gate::define('pelaporan', function ($user) {
            return $user->can('Pelaporancrud');
        });
        Gate::define('tanggapan', function ($user) {
            return $user->can('Tanggapancrud');
        });
        Gate::define('rekap laporan', function ($user) {
            return $user->can('Rekap Laporan');
        });
        Gate::define('group user', function ($user) {
            return $user->can('Group Usercrud');
        });
        Gate::define('data master', function ($user) {
            return $user->can('Data master');
        });
        Gate::define('kategori', function ($user) {
            return $user->can('Kategoricrud');
        });
        Gate::define('status', function ($user) {
            return $user->can('Statuscrud');
        });
        Gate::define('kewenangan', function ($user) {
            return $user->can('Kewenangancrud');
        });
        Gate::define('region', function ($user) {
            return $user->can('Regioncrud');
        });
        
    }
}
