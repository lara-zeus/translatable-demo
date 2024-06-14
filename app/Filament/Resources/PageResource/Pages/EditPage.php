<?php

declare(strict_types=1);

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\Overrides\Page;
use Filament\Actions\Action;
use Filament\Actions\LocaleSwitcher;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditPage extends \Z3d0X\FilamentFabricator\Resources\PageResource\Pages\EditPage
{
    use Translatable;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return array_merge([
            LocaleSwitcher::make(),
            Action::make(__('filament-fabricator::page-resource.actions.visit'))
                ->url(fn (Page $record, HasForms $livewire) => url($record->getUrl([
                    'locale' => $livewire->getActiveFormsLocale(),
                ])))
                ->openUrlInNewTab(),
        ], parent::getHeaderActions() ?? []);
    }
}
