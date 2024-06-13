<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

class Book extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'cover', 'authors'];

    protected $guarded = [];

    /*protected $casts = [
        'authors' => 'array'
    ];*/

    public function meta(): HasOne
    {
        return $this->hasOne(Meta::class);
    }

}
