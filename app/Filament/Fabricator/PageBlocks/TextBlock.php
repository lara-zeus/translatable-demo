<?php

namespace App\Filament\Fabricator\PageBlocks;

use App\Filament\Fabricator\PageBlock;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class TextBlock extends PageBlock
{
    public const ID = 'text';

    public const ICON = 'heroicon-o-bars-3-bottom-left';

    public static function defineBlock(Block $block): Block
    {
        return $block->schema([
            TextInput::make('admin_title')
                ->requiredIfNot('title')
                ->columnSpanFull(),
            TextInput::make('title'),
            Textarea::make('content'),
        ]);
    }
}
