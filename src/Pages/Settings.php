<?php

namespace Reworck\FilamentSettings\Pages;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Reworck\FilamentSettings\FilamentSettings;
use Spatie\Valuestore\Valuestore;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    public array $data;
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static string $view = 'filament-settings::pages.settings';

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    protected function getFormSchema(): array
    {
        return FilamentSettings::$fields;
    }

    public function mount(): void
    {
        $this->form->fill(
            Valuestore::make(
                config('filament-settings.path')
            )->all()
        );
    }

    public function submit(): void
    {
        $this->validate();

        foreach ($this->data as $key => $data) {
            Valuestore::make(
                config('filament-settings.path')
            )->put($key, $data);
        }

        $this->notify('success', 'Saved!');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('filament-settings.group');
    }

    protected static function getNavigationLabel(): string
    {
        return config('filament-settings.label');
    }

    protected static function shouldRegisterNavigation(): bool
    {
        // If method canManageSettings is not defined on the user model, assume users are allowed to manage settings
        if(auth()->user() && !method_exists(auth()->user(), 'canManageSettings')) {
            return true;
        }

        return auth()->user()?->canManageSettings() ?? true;
    }
}
