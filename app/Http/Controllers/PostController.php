<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Account;
class PostController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('community', compact('posts'));
    }


    public function store(Request $request)
    {
        // 1️⃣ Kiểm tra dữ liệu đầu vào
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'img' => 'nullable|image|max:2048'
        ]);

        // 2️⃣ Lấy thông tin user trong session
        $user = session('user');

        if (!$user) {
            return redirect('/login')->with('error', 'Bạn cần đăng nhập trước khi đăng bài.');
        }

        // 3️⃣ Tìm account tương ứng
        $account = Account::where('registerID', $user->registerID)->first();

        if (!$account) {
            return back()->with('error', 'Không tìm thấy tài khoản tương ứng.');
        }

        // 4️⃣ Xử lý ảnh (nếu có)
        $path = null;
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('uploads', 'public');
        }

        // 5️⃣ Tạo bài viết mới
        Post::create([
            'accountID' => $account->accountID,
            'title' => $request->title,
            'content' => $request->content,
            'img' => $path,
        ]);

        // 6️⃣ Quay lại trang cộng đồng
        return redirect()->back()->with('success', 'Đăng bài thành công!');
    }




    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        return back();
    }
}
