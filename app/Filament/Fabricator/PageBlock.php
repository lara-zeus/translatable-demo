<?php

declare(strict_types=1);

namespace App\Filament\Fabricator;

use Filament\Forms\Components\Builder\Block;
use Z3d0X\FilamentFabricator\Models\Contracts\Page;

abstract class PageBlock extends \Z3d0X\FilamentFabricator\PageBlocks\PageBlock
{
    public const ID = 'undefined';

    public const ICON = 'heroicon-o-plus';

    final public static function getBlockSchema(): Block
    {
        $block = static::defineBlock(
            Block::make(static::getBlockId())
                ->label(fn () => __('blocks.' . static::getBlockId()))
                ->icon(static::getBlockIcon())
        );

        return PageBlockWrapper::wrap($block);
    }

    abstract public static function defineBlock(Block $block): Block;

    /**
     * @param  array[]  $blocks  - The array of blocks' data for the given page and the given block type
     */
    public static function preloadRelatedData(Page $page, array &$blocks): void
    {
    }

    public static function mutateData(array $data): array
    {
        return $data;
    }

    public static function getBlockId(): string
    {
        return static::ID;
    }

    public static function getBlockIcon(): string
    {
        return static::ICON;
    }
}
