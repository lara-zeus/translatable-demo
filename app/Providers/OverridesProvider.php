<?php

declare(strict_types=1);

namespace App\Providers;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Illuminate\Support\ServiceProvider;

class OverridesProvider extends ServiceProvider
{
    public function boot(): void
    {
        Section::configureUsing(
            function (Section $section): void {
                $section->collapsed(shouldMakeComponentCollapsible: false)
                    ->compact();
            }
        );

        Repeater::configureUsing(
            function (Repeater $repeater): void {
                $repeater
                    ->itemLabel(fn ($state) => $state['admin_title'] ?? $state['title'] ?? '')
                    ->collapsible()
                    ->collapsed()
                    ->reorderableWithDragAndDrop();
            }
        );

        Select::configureUsing(
            function (Select $select): void {
                $select
                    ->default(fn ($options) => $options[0] ?? null)
                    ->native(false)
                    ->selectablePlaceholder(false);
            }
        );

        Textarea::configureUsing(function (Textarea $textarea): void {
            $textarea
                ->rows(8);
        });

        CuratorPicker::configureUsing(
            function (CuratorPicker $curatorPicker): void {
                $curatorPicker
                    ->buttonLabel('Upload')
                    ->color('primary')
                    ->outlined(false)
                    ->size('md')
                    ->acceptedFileTypes(['image/jpeg', 'image/png']);
            }
        );
    }
}
