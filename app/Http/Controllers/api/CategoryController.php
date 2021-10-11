<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'category' => $data,
            ], 201);
    }
}
