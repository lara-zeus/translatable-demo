<?php

declare(strict_types=1);

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreatePage extends \Z3d0X\FilamentFabricator\Resources\PageResource\Pages\CreatePage
{
    use Translatable;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return array_merge([
            LocaleSwitcher::make(),
        ], parent::getHeaderActions() ?? []);
    }
}
