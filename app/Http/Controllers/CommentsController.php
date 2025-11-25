<?php

namespace App\Http\Controllers;

use App\Models\Comments; // ✅ đúng namespace
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class CommentsController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment_text' => 'required'
        ]);

        Comments::create([
            'postID' => $postId,
            'accountID' => session('accountID'),
            'comment_text' => $request->comment_text, // ✅ trùng với field validate
        ]);

        return back();
    }

    public function destroy(Comments $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return back();
    }
}
