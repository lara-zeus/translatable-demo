<?php

declare(strict_types=1);

namespace App\Filament\Fabricator;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Set;

class PageBlockWrapper
{
    public static function baseFields(): array
    {
        // $extractLocale = fn (Component $component) => $component->getLivewire()->getActiveFormsLocale();

        return [
            /* Hidden::make('locale')
                ->formatStateUsing($extractLocale)
                ->dehydrateStateUsing($extractLocale), */];
    }

    public static function wrap(Block $block): Block
    {
        $defaultLabel = $block->getDefaultLabel();

        $updateLocale = function ($state, Set $set) use ($block) {
            /* $locale = $block->getLivewire()->getActiveFormsLocale();
            $set('locale', $locale);
            $state['locale'] = $locale; */

            return $state;
        };

        $block
            ->label(function ($state, $uuid = null) use ($defaultLabel) {
                $label = $state['admin_title'] ?? $state['title'] ?? $uuid;

                return empty($label) ? $defaultLabel : static::decorateLabel($label, $defaultLabel);
            })
            ->formatStateUsing($updateLocale)
            ->beforeStateDehydrated($updateLocale)
            ->afterStateHydrated($updateLocale)
            ->afterStateUpdated($updateLocale);

        return $block;
    }

    public static function decorateLabel(string $label, $defaultLabel): string
    {
        return "{$label}";
    }
}
