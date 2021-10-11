<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\UserCategory;
use Illuminate\Http\Request;

class UserCategoryController extends Controller
{
    
    public function index($user_id)
    {
        $data = UserCategory::with(['category','user'])
        ->where('user_id', $user_id)
        ->latest()
        ->get();
        
        return response()->json([
            'responsecode' => '1',
            'responsemsg' => 'Success',
            'usercategory' => $data,
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $user_id = $request->user_id;

        UserCategory::where('user_id', $user_id)->delete();
        $categories = explode(',', $request->categories);
        foreach ($categories as $key => $value) {
            UserCategory::create([
                'category_id' => $value,
                'user_id' => $user_id
            ]);
        }
        return response()->json([
            'responsecode' => '1',
            'responsemsg' => 'Success',
        ], 201);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
