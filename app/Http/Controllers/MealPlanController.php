<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    public function index(Request $request)
{
    $mealplan = MealPlan::with('fitness_goal')->orderBy('meal_planID','asc')->get();

    // Mapping category cho tab
    $categoryMap = [
        1 => 'suc-khoe', 
        2 => 'can-bang',  
        3 => 'tang-co',  
        4 => 'giam-can',    
        
             
    ];

    // Gắn category cho mỗi meal
    foreach ($mealplan as $meal) {
        $meal->category = $categoryMap[$meal->fitness_goalID] ?? 'other';
    }

    return view('nutrition', compact('mealplan'));
}
public function show($id)
{
    // Tìm món ăn theo ID
    $mealplan = MealPlan::with('fitness_goal')->find($id);

    // Nếu không tìm thấy -> 404
    if (!$mealplan) {
        abort(404, 'Không tìm thấy món ăn');
    }

    // Truyền dữ liệu sang view chi tiết
    return view('meal-detail', compact('mealplan'));
}

}
