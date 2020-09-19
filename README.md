# A Soundtrack Your Brand tile for the Laravel Dashboard

[![Latest Version on Packagist](https://img.shields.io/packagist/v/solitweb/laravel-dashboard-soundtrack-tile.svg?style=flat-square)](https://packagist.org/packages/solitweb/laravel-dashboard-soundtrack-tile)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/solitweb/laravel-dashboard-soundtrack-tile/run-tests?label=tests)](https://github.com/solitweb/laravel-dashboard-soundtrack-tile/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/solitweb/laravel-dashboard-soundtrack-tile.svg?style=flat-square)](https://packagist.org/packages/solitweb/laravel-dashboard-soundtrack-tile)

This tile displays "now playing" infomation from [Soundtrack Your Brand](https://www.soundtrackyourbrand.com/).

This tile can be used on [the Laravel Dashboard](https://docs.spatie.be/laravel-dashboard).

<p align="center">
  <img width="415" height="375" src="https://github.com/solitweb/laravel-dashboard-soundtrack-tile/raw/master/screenshot.png">
</p>

## Installation

You can install the package via composer:

```bash
composer require solitweb/laravel-dashboard-soundtrack-tile
```

In the dashboard config file, you must add this configuration in the tiles key.

```php
// in config/dashboard.php

return [
    // ...
    'tiles' => [
        'soundtrack' => [
            'email' => env('SOUNDTRACK_EMAIL'),
            'password' => env('SOUNDTRACK_PASSWORD'),
            'sound_zone' => env('SOUNDTRACK_SOUND_ZONE'),
            'refresh_interval_in_seconds' => 60,
        ],
    ],
];
```

In `app\Console\Kernel.php` you should schedule the `Solitweb\SoundtrackTile\FetchDataFromApiCommand` to run every minute.

```php
// in app/console/Kernel.php

protected function schedule(Schedule $schedule)
{
    // ...
    $schedule->command(\Solitweb\SoundtrackTile\FetchDataFromApiCommand::class)->everyMinute();
}
```

## Usage

In your dashboard view you use the `livewire:soundtrack-tile` component.

```html
<x-dashboard>
    <livewire:soundtrack-tile position="a1" />
</x-dashboard>
```

### Customizing the view

If you want to customize the view used to render this tile, run this command:

```bash
php artisan vendor:publish --provider="Solitweb\SoundtrackTile\SoundtrackTileServiceProvider" --tag="dashboard-soundtrack-tile-views"
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email stijn@solitweb.be instead of using the issue tracker.

## Credits

- [Spatie](https://github.com/spatie/)
- [Spotify tile](https://github.com/ashbakernz/laravel-dashboard-spotify-tile)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
