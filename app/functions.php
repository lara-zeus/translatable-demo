<?php

declare(strict_types=1);

if (! function_exists('root_path')) {
    function root_path(string $uri = ''): string
    {
        $dir = dirname(app_path());

        return "{$dir}/{$uri}";
    }
}
