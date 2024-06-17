<?php

namespace App\Filament\Fabricator\PageBlocks;

use App\Filament\Fabricator\PageBlock;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;

class ImageBlock extends PageBlock
{
    public const ID = 'image';

    public const ICON = 'heroicon-o-photo';

    public static function defineBlock(Block $block): Block
    {
        return $block
            ->schema([
                TextInput::make('admin_title')
                    ->requiredIfNot('title'),
                CuratorPicker::make('image')
                    ->required(),
                TextInput::make('caption')
                    ->required(),
            ]);
    }
}
