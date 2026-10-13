<?php

declare(strict_types=1);

namespace App\Models\Overrides;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property array $description
 * @property array $title
 * @property array $image
 * @property array $author
 * @property array $robots
 * @property array $canonical_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|\Eloquent $model
 * @property-read mixed $translations
 *
 * @method static Builder|SEO newModelQuery()
 * @method static Builder|SEO newQuery()
 * @method static Builder|SEO query()
 * @method static Builder|SEO whereAuthor($value)
 * @method static Builder|SEO whereCanonicalUrl($value)
 * @method static Builder|SEO whereCreatedAt($value)
 * @method static Builder|SEO whereDescription($value)
 * @method static Builder|SEO whereId($value)
 * @method static Builder|SEO whereImage($value)
 * @method static Builder|SEO whereJsonContainsLocale(string $column, string $locale, ?mixed $value)
 * @method static Builder|SEO whereJsonContainsLocales(string $column, array $locales, ?mixed $value)
 * @method static Builder|SEO whereLocale(string $column, string $locale)
 * @method static Builder|SEO whereLocales(string $column, array $locales)
 * @method static Builder|SEO whereModelId($value)
 * @method static Builder|SEO whereModelType($value)
 * @method static Builder|SEO whereRobots($value)
 * @method static Builder|SEO whereTitle($value)
 * @method static Builder|SEO whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class SEO extends \RalphJSmit\Laravel\SEO\Models\SEO
{
    use HasTranslations;

    public $table = 'seo';

    public $translatable = [
        'description',
        'title',
        'image',
        'author',
        'robots',
        'canonical_url',
    ];

    protected $casts = [
        'description' => 'array',
        'title' => 'array',
        'image' => 'array',
        'author' => 'array',
        'robots' => 'array',
        'canonical_url' => 'array',
    ];
}
