<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Postlike;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'postID';
    public $timestamps = true;

    // ✅ Cho phép gán các cột này
    protected $fillable = [
        'accountID',
        'title',
        'content',
        'img',
        'created_at',
        'updated_at'
    ];

    public function likes()
    {
        return $this->hasMany(Postlike::class, 'postID', 'postID');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'postID', 'postID');
    }
}
