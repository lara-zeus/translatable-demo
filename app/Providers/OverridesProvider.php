<?php

namespace App\Providers;

use App\Overrides\FilamentFabricatorManager;
use App\Services\PageRoutesService;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Illuminate\Support\Str;
use Z3d0X\FilamentFabricator\Facades\FilamentFabricator;
use Z3d0X\FilamentFabricator\Forms\Components\PageBuilder;

class OverridesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->scoped(FilamentFabricatorManager::ID, FilamentFabricatorManager::class);

        Field::macro(
            'requiredIfNot',
            fn (string $otherFieldPath) =>
            /**
             * @var Field $this
             */
            $this->required(fn (Get $get) => !filled($get($otherFieldPath)))
                ->live(onBlur: true)
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::bind(
            'filamentFabricatorPage',
            function ($value) {
                $routesService = resolve(PageRoutesService::class);

                return $routesService->findPageOrFail($value);
            }
        );

        FilamentFabricator::registerSchemaSlot(
            'sidebar.after',
            fn () => [
                Section::make('SEO')
                    ->relationship('seo')
                    ->collapsed()
                    ->schema(
                        [
                            TextInput::make('title')
                                ->label(__('filament-seo::translations.title'))
                                ->columnSpanFull(),
                            Textarea::make('description')
                                ->label(__('filament-seo::translations.description'))
                                ->helperText(
                                    fn (?string $state): string => (string) Str::of(mb_strlen($state ?? ''))
                                        ->append(' / ')
                                        ->append(160 . ' ')
                                        ->append(Str::of(__('filament-seo::translations.characters'))->lower())
                                )
                                ->live()
                                ->columnSpanFull(),
                            CuratorPicker::make('image')
                                ->label(__('filament-seo::translations.image'))
                                ->columnSpanFull(),
                        ]
                    )
                    ->dehydrateStateUsing(
                        function ($state) {
                            if (!is_array($state['image'])) {
                                $state['image'] = [
                                    $state['image'],
                                ];
                            }

                            return $state;
                        }
                    ),
            ]
        );

        PageBuilder::configureUsing(
            function (PageBuilder $pageBuilder) {
                $pageBuilder->collapsible()
                    ->collapsed()
                    //->reorderableWithButtons()
                    ->reorderableWithDragAndDrop();
            }
        );

        Section::configureUsing(
            function (Section $section) {
                $section->collapsed(shouldMakeComponentCollapsible: false)
                    ->compact();
            }
        );

        Repeater::configureUsing(
            function (Repeater $repeater) {
                $repeater
                    //                    ->itemLabel(fn (Get $get) => $get('admin_title') ?? $get('title') ?? '')
                    ->itemLabel(fn ($state) => $state['admin_title'] ?? $state['title'] ?? '')
                    ->collapsible()
                    ->collapsed()
                    //->reorderableWithButtons()
                    ->reorderableWithDragAndDrop();
            }
        );

        Select::configureUsing(
            function (Select $select) {
                $select
                    ->default(fn ($options) => $options[0] ?? null)
                    ->native(false)
                    ->selectablePlaceholder(false);
            }
        );

        Textarea::configureUsing(function (Textarea $textarea) {
            $textarea
                ->rows(8);
        });

        CuratorPicker::configureUsing(
            function (CuratorPicker $curatorPicker) {
                $curatorPicker
                    ->buttonLabel('Upload')
                    ->color('primary')
                    ->outlined(false)
                    ->size('md')
                    ->acceptedFileTypes(['image/jpeg', 'image/png']);
            }
        );
    }
}
