<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use Notifiable;

    // Tên bảng
    protected $table = 'account';

    // Khóa chính
    protected $primaryKey = 'accountID';

    // Cho phép Laravel quản lý timestamps (created_at, updated_at)
    public $timestamps = true;

    // Các cột có thể gán giá trị hàng loạt
    protected $fillable = [
        'fullname',
        'phone',
        'birthday',
        'height',
        'weight',
        'bmi',
        'created_at',
        'updated_at',
        'user_id'
    ];

    // Ẩn các cột khi trả về JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Quan hệ với bảng posts
    public function posts()
    {
        return $this->hasMany(Post::class, 'accountID', 'accountID');
    }
}
