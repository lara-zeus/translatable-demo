<?php

declare(strict_types=1);

namespace App\Models\Overrides;

use App\Observers\PageRoutesObserver;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\Translatable\HasTranslations;
use Filament\Facades\Filament;
use Filament\SpatieLaravelTranslatablePlugin;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Z3d0X\FilamentFabricator\Facades\FilamentFabricator;


/**
 *
 *
 * @property int $id
 * @property array $title
 * @property array $slug
 * @property string $layout
 * @property array $blocks
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Page> $allChildren
 * @property-read int|null $all_children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Page> $children
 * @property-read int|null $children_count
 * @property-read Page|null $parent
 * @property-read \App\Models\Overrides\SEO $seo
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereBlocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereJsonContainsLocale(string $column, string $locale, ?mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereJsonContainsLocales(string $column, array $locales, ?mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereLayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
#[ObservedBy([PageRoutesObserver::class])]
class Page extends \Z3d0X\FilamentFabricator\Models\Page
{
    use HasSEO, HasTranslations;

    public array $translatable = [
        'title',
        'slug',
        'blocks',
    ];

    protected $table = 'pages';

    public function getDefaultUrlArgs(): array
    {
        return [
            'locale' => 'en',
        ];
    }

    public function getUrlCacheKey(array $args = []): string
    {
        $keyArgs = collect($this->getDefaultUrlArgs())->merge($args)->all();
        $locale = $keyArgs['locale'];
        $id = $this->id;

        return "page-url--{$locale}--{$id}";
    }

    public function getUrl(array $args = []): string
    {
        $cacheKey = $this->getUrlCacheKey($args);
        $keyArgs = collect($this->getDefaultUrlArgs())->merge($args)->all();

        return Cache::rememberForever(
            $cacheKey,
            function () use ($keyArgs) {
                /**
                 * @var ?Page $parent
                 */
                $parent = $this->parent;
                $parentUri = $parent === null
                    ? (FilamentFabricator::getRoutingPrefix() ?? '/')
                    : $parent->getUrl(
                        $keyArgs
                    );
                $parentUri = Str::start($parentUri, '/');

                $selfUri = $this->getTranslation('slug', $keyArgs['locale'], useFallbackLocale: false);
                $selfUri = Str::start($selfUri, '/');

                if ($parentUri === '/') {
                    return $selfUri;
                }

                $parentUri = rtrim($parentUri, '/');

                return "{$parentUri}{$selfUri}";
            }
        );
    }

    /**
     * @return array[]
     */
    public function getAllUrlCacheKeysArgs(): array
    {
        /**
         * @var SpatieLaravelTranslatablePlugin $translatable
         */
        $translatable = Filament::getPlugin((new SpatieLaravelTranslatablePlugin())->getId());

        return array_map(
            fn (string $locale) => [
                'locale' => $locale,
            ],
            $translatable->getDefaultLocales() ?: ['fr', 'en', 'es']
        );
    }

    /**
     * @return string[]
     */
    public function getAllUrlCacheKeys(): array
    {
        return array_map($this->getUrlCacheKey(...), $this->getAllUrlCacheKeysArgs());
    }

    /**
     * @return string[]
     */
    public function getAllUrls(): array
    {
        return array_map($this->getUrl(...), $this->getAllUrlCacheKeysArgs());
    }

    public function getDynamicSEOData(): SEOData
    {
        $title = $this->title;
        $seoTitle = $this->seo->title ?? '';
        $mediaId = $this->seo->image ?? 0;
        $media = Media::query()->find($mediaId);

        if (empty($seoTitle)) {
            $seoTitle = $title;
        }

        return new SEOData(
            enableTitleSuffix: true,
            openGraphTitle: $seoTitle,
            title: $title,
            image: $media?->url ?? null,
            canonical_url: url($this->getUrl($this->getDefaultUrlArgs())),
            url: url(
                $this->getUrl(
                    [
                        'locale' => $this->getLocale(),
                    ]
                )
            ),
        );
    }
}
