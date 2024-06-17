<?php

use Filament\Forms\Get;
use Illuminate\View\ComponentAttributeBag;

if (!function_exists('root_path')) {
    function root_path(string $uri = ''): string
    {
        $dir = dirname(app_path());

        return "{$dir}/{$uri}";
    }
}


if (!function_exists('ifLayoutIs')) {
    /**
     * Higher-Order function to generate a {@link Filament\Forms\Components\Builder\Block::visible} callback to only
     * display a block on a given layout(s)
     *
     * @param  string|array  $layoutName  - The name(s) of the layout(s) this component is shown for
     * @return Closure(Get): bool
     */
    function ifLayoutIs(string|array $layoutName): Closure
    {
        $layoutNames = is_array($layoutName) ? $layoutName : [$layoutName];

        return fn (Get $get) => in_array($get('../layout'), $layoutNames);
    }
}

if (!function_exists('ifLayoutIsNot')) {
    /**
     * Higher-Order function to generate a {@link Filament\Forms\Components\Builder\Block::visible} callback to only
     * display a block on all but the given layout(s)
     *
     * @param  string|array  $layoutName  - The name(s) of the layout(s) this component is not shown for
     * @return Closure(Get): bool
     */
    function ifLayoutIsNot(string|array $layoutName): Closure
    {
        $layoutNames = is_array($layoutName) ? $layoutName : [$layoutName];

        return fn (Get $get) => !in_array($get('../layout'), $layoutNames);
    }
}

if (!function_exists('arrayGroupBy')) {
    /**
     * Group an array of associative arrays by a given key
     *
     * @param  array[]  $arr
     * @return array[]
     */
    function arrayGroupBy(array &$arr, string $key): array
    {
        $ret = [];

        foreach ($arr as &$item) {
            $ret[$item[$key]][] = &$item;
        }

        return $ret;
    }
}

if (!function_exists('prepareAttributes')) {
    function prepareAttributes(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        return $attributes
            ->only([
                'id',
                'class',
                'tabindex',
            ]);
    }
}
