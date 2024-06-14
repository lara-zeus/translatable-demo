@aware(['page'])
@props(['blocks' => []])

@use(\App\Filament\Fabricator\PageBlock)
@use(\Z3d0X\FilamentFabricator\Facades\FilamentFabricator)

@php

    $groups = arrayGroupBy($blocks, 'type');

    foreach ($groups as $blockType => &$group) {
        /**
         * @var class-string<PageBlock> $blockClass
         */
        $blockClass = FilamentFabricator::getPageBlockFromName($blockType);

        if (!empty($blockClass)) {
            $blockClass::preloadRelatedData($page, $group);
        }
    }
@endphp

@foreach ($blocks as $blockData)
    @php
        /**
         * @var class-string<PageBlock> $blockClass
         */
        $blockClass = FilamentFabricator::getPageBlockFromName($blockData['type']);
    @endphp

    @isset($blockClass)
        <x-dynamic-component :component="$blockClass::getComponent()" :attributes="new \Illuminate\View\ComponentAttributeBag($blockClass::mutateData($blockData['data']))" />
    @endisset
@endforeach
