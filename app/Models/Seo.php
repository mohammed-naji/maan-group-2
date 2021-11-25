<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function seoable()
    {
        return $this->morphTo();
    }

    public static function add($item)
    {
        $item->seo()->create([
            'author' => request()->seo_author,
            'description' => request()->seo_description,
            'keywords' => request()->seo_keywords,
        ]);
    }
}
