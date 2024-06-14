<?php

declare(strict_types=1);

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\Overrides\Page;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;

class ListPages extends \Z3d0X\FilamentFabricator\Resources\PageResource\Pages\ListPages
{
    use Translatable;

    protected static string $resource = PageResource::class;

    public function table(Table $table): Table
    {
        $table = parent::table($table);

        $actions = $table->getActions();

        $table->actions(array_merge([
            Action::make(__('filament-fabricator::page-resource.actions.visit'))
                ->url(
                    fn (Page $page) => $page->getUrl([
                        'locale' => $page->getLocale(),
                    ]),
                    shouldOpenInNewTab: true
                )
                ->icon('heroicon-s-eye'),
        ], $actions));

        return $table;
    }

    protected function getHeaderActions(): array
    {
        return array_merge([
            LocaleSwitcher::make(),
        ], parent::getHeaderActions() ?? []);
    }
}
