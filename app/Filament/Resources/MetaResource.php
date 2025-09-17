<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\MetaResource\Pages\ListMetas;
use App\Filament\Resources\MetaResource\Pages\CreateMeta;
use App\Filament\Resources\MetaResource\Pages\EditMeta;
use App\Filament\Resources\MetaResource\Pages;
use App\Models\Meta;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MetaResource extends Resource
{
    protected static ?string $model = Meta::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMetas::route('/'),
            'create' => CreateMeta::route('/create'),
            'edit' => EditMeta::route('/{record}/edit'),
        ];
    }
}
