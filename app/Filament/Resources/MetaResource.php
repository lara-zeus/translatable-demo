<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MetaResource\Pages\CreateMeta;
use App\Filament\Resources\MetaResource\Pages\EditMeta;
use App\Filament\Resources\MetaResource\Pages\ListMetas;
use App\Models\Meta;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MetaResource extends Resource
{
    protected static ?string $model = Meta::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('book_id')
                    ->relationship('book', 'title'),
                TextInput::make('title'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
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

    public static function getPages(): array
    {
        return [
            'index' => ListMetas::route('/'),
            'create' => CreateMeta::route('/create'),
            'edit' => EditMeta::route('/{record}/edit'),
        ];
    }
}
