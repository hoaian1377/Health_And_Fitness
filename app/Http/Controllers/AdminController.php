<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkoutExercise;
use App\Models\MealPlan;
use App\Models\SubscriptionPlan;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    // ================= EXERCISES =================
    public function exercises()
    {
        $exercises = WorkoutExercise::all();
        $goals = \App\Models\FitnessGoal::all();
        return view('admin.exercises', compact('exercises', 'goals'));
    }

    public function storeExercise(Request $request)
    {
        $request->validate([
            'name_workout' => 'required|string',
            'muscle_group' => 'required|string',
            'duration' => 'required|string',
            'practice_round' => 'required|string',
            'calories_burned' => 'required|numeric',
            'urls' => 'nullable|string',
            'video_urls' => 'nullable|string',
            'fitness_goalID' => 'nullable|integer',
        ]);

        WorkoutExercise::create($request->all());

        return redirect()->back()->with('success', 'Đã thêm bài tập thành công!');
    }

    public function destroyExercise($id)
    {
        $exercise = WorkoutExercise::where('workout_exerciseID', $id)->first();
        if ($exercise) {
            $exercise->delete();
            return redirect()->back()->with('success', 'Đã xóa bài tập!');
        }
        return redirect()->back()->with('error', 'Không tìm thấy bài tập!');
    }

    public function editExercise($id)
    {
        $exercise = WorkoutExercise::where('workout_exerciseID', $id)->firstOrFail();
        $goals = \App\Models\FitnessGoal::all();
        return view('admin.exercises_edit', compact('exercise', 'goals'));
    }

    public function updateExercise(Request $request, $id)
    {
        $exercise = WorkoutExercise::where('workout_exerciseID', $id)->firstOrFail();
        
        $request->validate([
            'name_workout' => 'required|string',
            'muscle_group' => 'required|string',
            'duration' => 'required|string',
            'practice_round' => 'required|string',
            'calories_burned' => 'required|numeric',
            'urls' => 'nullable|string',
            'video_urls' => 'nullable|string',
            'fitness_goalID' => 'nullable|integer',
        ]);

        $exercise->update($request->all());

        return redirect()->route('admin.exercises')->with('success', 'Cập nhật bài tập thành công!');
    }

    // ================= NUTRITION =================
    public function nutrition()
    {
        $meals = MealPlan::all();
        $goals = \App\Models\FitnessGoal::all();
        return view('admin.nutrition', compact('meals', 'goals'));
    }

    public function storeMeal(Request $request)
    {
        $request->validate([
            'meal_name' => 'required|string',
            'calories' => 'required|numeric',
            'protein' => 'required|numeric',
            'carbs' => 'required|numeric',
            'fat' => 'required|numeric',
            'food_weight' => 'required|numeric',
            'description' => 'nullable|string',
            'urls' => 'nullable|string',
            'fitness_goalID' => 'nullable|integer',
        ]);

        MealPlan::create($request->all());

        return redirect()->back()->with('success', 'Đã thêm món ăn thành công!');
    }

    public function editMeal($id)
    {
        $meal = MealPlan::where('meal_planID', $id)->firstOrFail();
        $goals = \App\Models\FitnessGoal::all();
        return view('admin.nutrition_edit', compact('meal', 'goals'));
    }

    public function updateMeal(Request $request, $id)
    {
        $meal = MealPlan::where('meal_planID', $id)->firstOrFail();

        $request->validate([
            'meal_name' => 'required|string',
            'calories' => 'required|numeric',
            'protein' => 'required|numeric',
            'carbs' => 'required|numeric',
            'fat' => 'required|numeric',
            'food_weight' => 'required|numeric',
            'meal_type' => 'required|string',
            'description' => 'nullable|string',
            'urls' => 'nullable|string',
            'fitness_goalID' => 'nullable|integer',
        ]);

        $meal->update($request->all());

        return redirect()->route('admin.nutrition')->with('success', 'Cập nhật món ăn thành công!');
    }

    public function destroyMeal($id)
    {
        $meal = MealPlan::where('meal_planID', $id)->first();
        if ($meal) {
            $meal->delete();
            return redirect()->back()->with('success', 'Đã xóa món ăn!');
        }
        return redirect()->back()->with('error', 'Không tìm thấy món ăn!');
    }

    // ================= PLANS (PACKAGES) =================
    public function plans()
    {
        $plans = \App\Models\Package::with('fitnessGoal')->get();
        $goals = \App\Models\FitnessGoal::all();
        return view('admin.plans', compact('plans', 'goals'));
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'name_package' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'fitness_goalID' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        \App\Models\Package::create($request->all());

        return redirect()->back()->with('success', 'Đã thêm gói tập thành công!');
    }

    public function editPlan($id)
    {
        $plan = \App\Models\Package::findOrFail($id);
        $goals = \App\Models\FitnessGoal::all();
        return view('admin.plans_edit', compact('plan', 'goals'));
    }

    public function updatePlan(Request $request, $id)
    {
        $plan = \App\Models\Package::findOrFail($id);

        $request->validate([
            'name_package' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'fitness_goalID' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $plan->update($request->all());

        return redirect()->route('admin.plans')->with('success', 'Cập nhật gói tập thành công!');
    }

    public function destroyPlan($id)
    {
        $plan = \App\Models\Package::find($id);
        if ($plan) {
            $plan->delete();
            return redirect()->back()->with('success', 'Đã xóa gói tập!');
        }
        return redirect()->back()->with('error', 'Không tìm thấy gói tập!');
    }

    // ================= VOUCHERS =================
    public function vouchers()
    {
        $vouchers = \App\Models\Voucher::all();
        return view('admin.vouchers', compact('vouchers'));
    }

    public function storeVoucher(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:vouchers,code',
            'discount_type' => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric',
            'expiry_date' => 'nullable|date',
            'usage_limit' => 'nullable|integer',
        ]);

        \App\Models\Voucher::create($request->all());

        return redirect()->back()->with('success', 'Đã thêm mã giảm giá thành công!');
    }

    public function editVoucher($id)
    {
        $voucher = \App\Models\Voucher::findOrFail($id);
        return view('admin.vouchers_edit', compact('voucher'));
    }

    public function updateVoucher(Request $request, $id)
    {
        $voucher = \App\Models\Voucher::findOrFail($id);

        $request->validate([
            'code' => 'required|string|unique:vouchers,code,' . $id,
            'discount_type' => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric',
            'expiry_date' => 'nullable|date',
            'usage_limit' => 'nullable|integer',
        ]);

        $voucher->update($request->all());

        return redirect()->route('admin.vouchers')->with('success', 'Cập nhật mã giảm giá thành công!');
    }

    public function destroyVoucher($id)
    {
        $voucher = \App\Models\Voucher::find($id);
        if ($voucher) {
            $voucher->delete();
            return redirect()->back()->with('success', 'Đã xóa mã giảm giá!');
        }
        return redirect()->back()->with('error', 'Không tìm thấy mã giảm giá!');
    }

    // ================= CHATBOT =================
    public function chatbot()
    {
        $questions = \App\Models\ChatbotQuestion::all();
        return view('admin.chatbot', compact('questions'));
    }

    public function storeChatbot(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        \App\Models\ChatbotQuestion::create($request->all());

        return redirect()->back()->with('success', 'Đã thêm câu hỏi thành công!');
    }

    public function editChatbot($id)
    {
        $question = \App\Models\ChatbotQuestion::findOrFail($id);
        return view('admin.chatbot_edit', compact('question'));
    }

    public function updateChatbot(Request $request, $id)
    {
        $question = \App\Models\ChatbotQuestion::findOrFail($id);

        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $question->update($request->all());

        return redirect()->route('admin.chatbot')->with('success', 'Cập nhật câu hỏi thành công!');
    }

    public function destroyChatbot($id)
    {
        $question = \App\Models\ChatbotQuestion::find($id);
        if ($question) {
            $question->delete();
            return redirect()->back()->with('success', 'Đã xóa câu hỏi!');
        }
        return redirect()->back()->with('error', 'Không tìm thấy câu hỏi!');
    }

    // ================= ADMIN CHAT SUPPORT =================
    public function chatList()
    {
        // Get users who have sent messages, ordered by latest message
        $users = \App\Models\User::whereHas('chatMessages')
            ->with(['chatMessages' => function($query) {
                $query->latest();
            }])
            ->get()
            ->sortByDesc(function($user) {
                return $user->chatMessages->first()->created_at;
            });

        return view('admin.chat_list', compact('users'));
    }

    public function chatDetail($userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $messages = \App\Models\ChatMessage::where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark user messages as read
        \App\Models\ChatMessage::where('user_id', $userId)
            ->where('sender', 'user')
            ->update(['is_read' => true]);

        return view('admin.chat_detail', compact('user', 'messages'));
    }

    public function reply(Request $request, $userId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        \App\Models\ChatMessage::create([
            'user_id' => $userId,
            'message' => $request->message,
            'sender' => 'admin',
            'is_read' => false, // User hasn't read it yet (conceptually)
        ]);

        return redirect()->back();
    }
}
