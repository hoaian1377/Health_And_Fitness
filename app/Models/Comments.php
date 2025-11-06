<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'commentID';
    public $timestamps = true;

    protected $fillable = [
        'postID',
        'accountID',
        'comment_text', // sửa lại đúng tên
    ];

    public function post()
    {
        // Một comment thuộc về 1 bài viết
        return $this->belongsTo(Post::class, 'postID', 'postID');
    }
}
