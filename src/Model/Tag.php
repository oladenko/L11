<?php



namespace App\Model;


class Tag extends \Illuminate\Database\Eloquent\Model
{
    public function posts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }
}