<?php


namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends \Illuminate\Database\Eloquent\Model
{

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    use SoftDeletes;

}