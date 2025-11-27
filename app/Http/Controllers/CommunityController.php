<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comments;
use App\Models\Postlike;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index()
    {
        $posts = Post::with(['comments.account', 'likes', 'account'])->latest()->get();
        return view('community', compact('posts'));
    }

    // Đăng bài mới
    public function storePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'img' => 'nullable|image|max:2048'
        ]);

        $path = $request->hasFile('img') 
            ? $request->file('img')->store('uploads', 'public')
            : null;

        Post::create([
            'accountID' => Auth::user()->account->accountID,
            'title' => $request->title,
            'content' => $request->content,
            'img' => $path,
        ]);

        return back()->with('success', 'Đăng bài thành công!');
    }

    // Bình luận bài viết
    public function storeComment(Request $request, $postId)
    {
        $request->validate(['content' => 'required|string']);
        Comments::create([
            'postID' => $postId,
            'accountID' => Auth::user()->account->accountID,
            'content' => $request->content,
        ]);
        return back();
    }

    // Like / Unlike bài viết
    public function toggleLike($postId)
    {
        $userId = Auth::user()->account->accountID;
        $like = Postlike::where('postID', $postId)->where('accountID', $userId)->first();
        if ($like) {
            $like->delete(); // Bỏ like
        } else {
            Postlike::create(['postID' => $postId, 'accountID' => $userId]);
        }

        return back();
    }
}
