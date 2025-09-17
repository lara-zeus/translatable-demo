<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

/**
 *
 *
 * @property int $id
 * @property array $title
 * @property array|null $cover
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property array|null $authors
 * @property-read Meta|null $meta
 * @property-read mixed $translations
 * @method static BookFactory factory($count = null, $state = [])
 * @method static Builder|Book newModelQuery()
 * @method static Builder|Book newQuery()
 * @method static Builder|Book query()
 * @method static Builder|Book whereAuthors($value)
 * @method static Builder|Book whereCover($value)
 * @method static Builder|Book whereCreatedAt($value)
 * @method static Builder|Book whereId($value)
 * @method static Builder|Book whereJsonContainsLocale(string $column, string $locale, ?mixed $value)
 * @method static Builder|Book whereJsonContainsLocales(string $column, array $locales, ?mixed $value)
 * @method static Builder|Book whereLocale(string $column, string $locale)
 * @method static Builder|Book whereLocales(string $column, array $locales)
 * @method static Builder|Book whereTitle($value)
 * @method static Builder|Book whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Book extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'title', 'cover', 'authors'
    ];

    protected $guarded = [];

    protected $casts = [
        // 'authors' => 'array'
        'json_fields' => 'json'
    ];

    public function meta(): HasOne
    {
        return $this->hasOne(Meta::class);
    }
}
