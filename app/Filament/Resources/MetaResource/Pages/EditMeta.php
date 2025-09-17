<?php

namespace App\Filament\Resources\MetaResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\MetaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMeta extends EditRecord
{
    protected static string $resource = MetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
