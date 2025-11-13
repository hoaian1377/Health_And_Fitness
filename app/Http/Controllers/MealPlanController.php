<?php

namespace App\Http\Controllers;
use App\Models\MealPlan;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    //
    public function index()
    {
        $mealplan=MealPlan::wiht('fitness_goal')->orderby('meal_planID','asc')->get();
        return view('nutrition',compact('mealplan'));
    }

    public function show($id)
    {
        // Tìm món ăn theo ID
        $mealplan = MealPlan::with('fitness_goal')->find($id);

        // Nếu không có -> trả về 404
        if (!$mealplan) {
            abort(404, 'Không tìm thấy món ăn');
        }

        // Truyền dữ liệu sang view
        return view('meal-detail', compact('mealplan'));
    }
 
}
