<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        Gate::define('admin-only', function ($user) {
            return $user->role === 'admin';
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Str::macro('highlight', function ($text, $query) {
            if (empty($query)) {
                return $text;
            }
            
            // Escape special regex characters
            $pattern = preg_quote($query, '/');
            
            // Highlight matches (case insensitive)
            return preg_replace('/('.$pattern.')/i', '<span class="highlight">$0</span>', $text);
        });
    }
}
