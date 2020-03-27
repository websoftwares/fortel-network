<?php

namespace Fortel\Game\Providers;

use Fortel\Game\Console\Commands\PlayGameCommand;
use Illuminate\Support\ServiceProvider;

/**
 * @package Fortel\Game\Providers
 */
class PlayGameServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PlayGameCommand::class,
            ]);
        }
    }
}
