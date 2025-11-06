<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postlike;

class PostlikeController extends Controller
{
    public function toggle($postId)
    {
        $like = Postlike::where('accountID', session('accountID'))
                        ->where('postID', $postId)
                        ->first();

        if ($like) {
            $like->delete(); // Unlike
        } else {
            Postlike::create([
                'accountID' => session('accountID'),
                'postID' => $postId, // ✅ sửa chữ hoa
                'islike' => 1,       // nếu bạn có cột này
            ]);
        }

        return back();
    }
}
