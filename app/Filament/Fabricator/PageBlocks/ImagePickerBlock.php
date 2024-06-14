<?php

namespace App\Filament\Fabricator\PageBlocks;

use App\Filament\Fabricator\PageBlock;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;

class ImagePickerBlock extends PageBlock
{
    public const ID = 'image-picker';

    public const ICON = 'heroicon-s-folder-arrow-down';

    public static function defineBlock(Block $block): Block
    {
        return $block->schema([
            FileUpload::make('file')
                ->required()
                ->disk('public')
                ->acceptedFileTypes(['image/png', 'image/jpg']),
        ]);
    }

    public static function mutateData(array $data): array
    {
        return $data;
    }
}
