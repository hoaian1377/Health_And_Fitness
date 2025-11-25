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

    // ================= PLANS =================
    public function plans()
    {
        $plans = SubscriptionPlan::all();
        return view('admin.plans', compact('plans'));
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        SubscriptionPlan::create($request->all());

        return redirect()->back()->with('success', 'Đã thêm gói tập thành công!');
    }

    public function editPlan($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        return view('admin.plans_edit', compact('plan'));
    }

    public function updatePlan(Request $request, $id)
    {
        $plan = SubscriptionPlan::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $plan->update($request->all());

        return redirect()->route('admin.plans')->with('success', 'Cập nhật gói tập thành công!');
    }

    public function destroyPlan($id)
    {
        $plan = SubscriptionPlan::find($id);
        if ($plan) {
            $plan->delete();
            return redirect()->back()->with('success', 'Đã xóa gói tập!');
        }
        return redirect()->back()->with('error', 'Không tìm thấy gói tập!');
    }
}
