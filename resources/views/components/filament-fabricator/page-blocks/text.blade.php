@aware(['page'])
@props(['title', 'content'])
<div class="px-4 py-4 md:py-8">
    <div class="max-w-7xl mx-auto">
        {{ $title }}<br />
        {{ $content }}
    </div>
</div>
