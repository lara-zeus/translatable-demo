<?php

namespace App\Filament\Resources;

use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\BookResource\Pages\ListBooks;
use App\Filament\Resources\BookResource\Pages\CreateBook;
use App\Filament\Resources\BookResource\Pages\EditBook;
use App\Filament\Resources\BookResource\Pages;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Livewire\Component as Livewire;

class BookResource extends Resource
{
    use Translatable;

    protected static ?string $model = Book::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // for demo, use CheckboxList with local switcher
                CheckboxList::make('marineVehiclePackage')
                    ->dehydrated(false)
                    ->columnSpanFull()
                    ->columns(4)
                    ->options(fn(Livewire $livewire) => Book::whereLocale('title', $livewire->activeLocale)->pluck('title', 'id')),

                Section::make('meta')
                    ->relationship('meta')
                    ->schema([
                        TextInput::make('title'),
                    ]),

                TextInput::make('title')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('cover')
//                    ->required()
                    ->image(),
                Repeater::make('authors')
                    ->collapsed(false)
                    ->collapsible(false)
                    ->schema([
                        TextInput::make('name'),
                    ]),

                Section::make('JSON fields')
                    ->schema([
                        TextInput::make('json_fields.summary')
                            ->columnSpan(12),
                        DatePicker::make('json_fields.summary_date')
                            ->columnSpan(3),
                    ])
                    ->columns(12),               
                
                

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('title'),
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
            'index' => ListBooks::route('/'),
            'create' => CreateBook::route('/create'),
            'edit' => EditBook::route('/{record}/edit'),
        ];
    }
}
