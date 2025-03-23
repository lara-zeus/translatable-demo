<?php

declare(strict_types=1);

namespace App\Overrides;

use App\Filament\Fabricator\Layouts\DefaultLayout;
use Illuminate\Support\Str;
use Z3d0X\FilamentFabricator\Services\PageRoutesService;

class FilamentFabricatorManager extends \Z3d0X\FilamentFabricator\FilamentFabricatorManager
{
    public function __construct(?PageRoutesService $routesService = null)
    {
        parent::__construct();
    }

    public function getDefaultLayoutName(): ?string
    {
        return DefaultLayout::NAME;
    }

    public function getPageUrls(): array
    {
        return $this->routesService->getAllUrls();
    }

    public function getPageUrlFromId(int|string $id, bool $prefixSlash = false, array $args = []): ?string
    {
        return $this->getPageModel()::query()->find($id)?->getUrl($args);
    }

    public function getRoutingPrefix(): ?string
    {
        $prefix = config('filament-fabricator.routing.prefix');

        if ($prefix === null) {
            return null;
        }

        $prefix = Str::start($prefix, '/');

        if ($prefix === '/') {
            return $prefix;
        }

        return rtrim($prefix, '/');
    }
}
