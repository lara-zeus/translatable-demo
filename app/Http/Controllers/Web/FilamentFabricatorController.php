<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\PageRoutesService;
use Illuminate\Support\Facades\Blade;
use Spatie\RouteAttributes\Attributes\Fallback;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Where;
use Z3d0X\FilamentFabricator\Facades\FilamentFabricator;
use Z3d0X\FilamentFabricator\Layouts\Layout;
use Z3d0X\FilamentFabricator\Models\Contracts\Page;

class FilamentFabricatorController extends Controller
{
    #[Get('/{filamentFabricatorPage?}')]
    #[Where('filamentFabricatorPage', '.*')]
    #[Fallback]
    public function renderPage(?Page $filamentFabricatorPage = null): string
    {
        // Handle root (home) page
        if (blank($filamentFabricatorPage)) {
            $routesService = resolve(PageRoutesService::class);

            /** @var Page $filamentFabricatorPage */
            $filamentFabricatorPage = $routesService->findPageOrFail('/');
        }

        /** @var ?class-string<Layout> $layout */
        $layout = FilamentFabricator::getLayoutFromName($filamentFabricatorPage?->layout);

        if (! isset($layout)) {
            throw new \Exception("Filament Fabricator: Layout \"{$filamentFabricatorPage->layout}\" not found");
        }

        /** @var string $component */
        $component = $layout::getComponent();

        return Blade::render(
            <<<'BLADE'
            <x-dynamic-component
                :component="$component"
                :page="$page"
            />
            BLADE,
            ['component' => $component, 'page' => $filamentFabricatorPage]
        );
    }
}
