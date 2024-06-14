@aware(['page'])
@props(['file'])

@php($url = \Illuminate\Support\Facades\Storage::disk('public')->url($file))

<div class="px-4 py-4 md:py-8">
    <div class="max-w-7xl mx-auto">
        File: {{ $file }}<br />
        URL: {{ $url }}<br />

        <img class="w-40" src="{{ $url }}" alt="{{ $file }}" />
    </div>
</div>
