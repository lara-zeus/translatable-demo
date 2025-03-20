<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Livewire\Component as Livewire;

class BookResource extends Resource
{
    use Translatable;

    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // for demo, use CheckboxList with local switcher
                CheckboxList::make('marineVehiclePackage')
                    ->dehydrated(false)
                    ->columnSpanFull()
                    ->columns(4)
                    ->options(fn(Livewire $livewire) => Book::whereLocale('title', $livewire->activeLocale)->pluck('title', 'id')),

                Forms\Components\Section::make('meta')
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

                Forms\Components\Section::make('JSON fields')
                    ->schema([
                        TextInput::make('json_fields.summary')
                            ->columnSpan(12),
                        Forms\Components\DatePicker::make('json_fields.summary_date')
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
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
