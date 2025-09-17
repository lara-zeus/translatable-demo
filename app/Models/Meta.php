<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Database\Factories\MetaFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 *
 *
 * @property int $id
 * @property int $book_id
 * @property array $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static MetaFactory factory($count = null, $state = [])
 * @method static Builder|Meta newModelQuery()
 * @method static Builder|Meta newQuery()
 * @method static Builder|Meta query()
 * @method static Builder|Meta whereBookId($value)
 * @method static Builder|Meta whereCreatedAt($value)
 * @method static Builder|Meta whereId($value)
 * @method static Builder|Meta whereJsonContainsLocale(string $column, string $locale, ?mixed $value)
 * @method static Builder|Meta whereJsonContainsLocales(string $column, array $locales, ?mixed $value)
 * @method static Builder|Meta whereLocale(string $column, string $locale)
 * @method static Builder|Meta whereLocales(string $column, array $locales)
 * @method static Builder|Meta whereTitle($value)
 * @method static Builder|Meta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Meta extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded = [];

    public $translatable = ['title'];
}
