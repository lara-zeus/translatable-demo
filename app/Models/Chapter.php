<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Database\Factories\ChapterFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ChapterFactory factory($count = null, $state = [])
 * @method static Builder|Chapter newModelQuery()
 * @method static Builder|Chapter newQuery()
 * @method static Builder|Chapter query()
 * @method static Builder|Chapter whereCreatedAt($value)
 * @method static Builder|Chapter whereId($value)
 * @method static Builder|Chapter whereTitle($value)
 * @method static Builder|Chapter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Chapter extends Model
{
    use HasFactory;
}
