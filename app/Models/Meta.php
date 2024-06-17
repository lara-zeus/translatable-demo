<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * 
 *
 * @property int $id
 * @property int $book_id
 * @property array $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Database\Factories\MetaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Meta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meta whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meta whereJsonContainsLocale(string $column, string $locale, ?mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meta whereJsonContainsLocales(string $column, array $locales, ?mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meta whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Meta whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Meta whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Meta extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded = [];

    public $translatable = ['title'];
}
