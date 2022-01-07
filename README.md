# Filament settings

This package allows for easy setting management using [Spatie's ValueStore package](https://github.com/spatie/valuestore)

## Content of the configuration file
```php
return [
    // Group the menu item belongs to
    'group' => 'Settings',

    // Sidebar label
    'label' => 'Settings',

    // Path to the file to be used as storage
    'path' => storage_path('app/settings.json'),

    // The fields to be stored
    'fields' => [
        \Filament\Forms\Components\TextInput::make('title')
    ]
];
```

## Installation

1. Require the package
```shell
composer require reworck/filament-settings
```

2. publish the configuration file
```shell
php artisan vendor:publish --tag=filament-settings-config
```

4. (Optionally) you can publish the views for the page and the view used by the livewire component
```shell
php artisan vendor:publish --tag=filament-settings-views
```

## Usage

To use this package fill in the `fields` array in the published config file.
When saving the form the contents will be stored inside the specified file.

After that you can access your values as you usually would using [spatie/valuestore](https://github.com/spatie/valuestore)

## Testing
```shell
composer test
```

## Security

If you discover any security related issues, please email quinten@reworck.nl instead of using the issue tracker.

## Credits

- [Quinten Buis](https://github.com/quintenbuis)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.