<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category as ResourcesCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();

        $data = [
            'status' => 200,
            'message' => "Categories",
            "data" =>  ResourcesCategory::collection($categories)
        ];

        return response()->json($data);
    }
}
