<?php

declare(strict_types=1);

namespace App\Models\Overrides;

use Spatie\Translatable\HasTranslations;

/**
 * 
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property array $description
 * @property array $title
 * @property array $image
 * @property array $author
 * @property array $robots
 * @property array $canonical_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|SEO newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SEO newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SEO query()
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereCanonicalUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereJsonContainsLocale(string $column, string $locale, ?mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereJsonContainsLocales(string $column, array $locales, ?mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereRobots($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SEO whereUpdatedAt($value)
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
