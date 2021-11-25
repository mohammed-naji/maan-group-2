<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function getTitleAttribute()
    // {
    //     $lang = app()->currentLocale();
    //     $title = "title_$lang";
    //     return $this->$title;
    // }

    // public function getSiteContentAttribute()
    // {
    //     $lang = app()->currentLocale();
    //     $title = "content_$lang";
    //     return $this->$title;
    // }

    public function getTransTitleAttribute()
    {
        return json_decode( $this->title )->{app()->currentLocale()};
    }

    public function getTransContentAttribute()
    {
        return json_decode( $this->content )->{app()->currentLocale()};
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
