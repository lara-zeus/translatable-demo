<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Table;

class PageResource extends \Z3d0X\FilamentFabricator\Resources\PageResource
{
    use Translatable;

    protected static ?int $navigationSort = 0;

    public static function table(Table $table): Table
    {
        return parent::table($table)
            ->defaultSort(fn ($query) => $query->orderBy('parent_id'));
    }

    public static function getPages(): array
    {
        return array_filter([
            'index' => PageResource\Pages\ListPages::route('/'),
            'create' => PageResource\Pages\CreatePage::route('/create'),
            'view' => config('filament-fabricator.enable-view-page') ? PageResource\Pages\ViewPage::route('/{record}') : null,
            'edit' => PageResource\Pages\EditPage::route('/{record}/edit'),
        ]);
    }
}
