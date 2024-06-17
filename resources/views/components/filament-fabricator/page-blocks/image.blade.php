@aware(['page'])
@props(['image', 'caption'])
<div class="px-4 py-4 md:py-8">
    <div class="max-w-7xl mx-auto">
        <figure>
            <x-curator-glider class="_image" :media="$image" :srcset="['400w', '800w']"
                sizes="(max-width: 400px) 90vw, (max-width: 800px) 400px, 800px" loading="lazy" />

            <figcaption>
                {{ $caption }}
            </figcaption>
        </figure>
    </div>
</div>
