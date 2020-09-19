<?php

namespace Solitweb\SoundtrackTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class SoundtrackTileServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Soundtrack::class, function () {
            return new Soundtrack(config('dashboard.tiles.soundtrack.email'), config('dashboard.tiles.soundtrack.password'));
        });
    }

    public function boot()
    {
        Livewire::component('soundtrack-tile', SoundtrackTileComponent::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchDataFromApiCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-soundtrack-tile'),
        ], 'dashboard-soundtrack-tile-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-soundtrack-tile');
    }
}
