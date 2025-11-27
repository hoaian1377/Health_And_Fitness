<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postlike extends Model
{
    // ✅ sửa đúng tên bảng thật
    protected $table = 'post_like';

    protected $primaryKey = 'post_likeID'; // hoặc 'likeID' nếu bạn dùng cột này

    protected $fillable = [
        'postID',
        'accountID',
        'islike',
        'created_at'
    ];

    public function post()
    {
        // ✅ Quan hệ ngược: 1 like thuộc về 1 bài viết
        return $this->belongsTo(Post::class, 'postID', 'postID');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'accountID', 'accountID');
    }
}
