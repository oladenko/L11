<?php



namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends \Illuminate\Database\Eloquent\Model
{
    public function posts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Post::class)->withTimestamps();

    }
    use SoftDeletes;
}