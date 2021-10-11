<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
   
    public function index($user_id)
    {

        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y/m/d",$start_week);
        $end_week = date("Y/m/d",$end_week);

        // return "Start Week ".$start_week." - ".$end_week;
        $data = Transaction::with(['category','user'])
        ->where('user_id', $user_id)
        ->latest()
        ->get();

        // $data= Transaction::get()
        // ->groupBy(function($item) {
        //     return Carbon::parse($item->date)->format('m');;
        // });
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'transaction' => $data,
            ], 201);
    }

   
    public function store(Request $request)
    {
        $kategory = $request->category_id == 0  ? Category::orderBy('id','ASC')->where('role', $request->status)->first()->id : $request->category_id;
       

        $save = Transaction::create([
            'category_id' => $kategory,
            'user_id' => $request->user_id,
            'title' => $request->title,
            'date' => $request->date,
            'nominal' => $request->nominal,
            'notes' => $request->notes,
            'status' => $request->status,
        ]);

       

        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Created !',
                
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                
                
            ], 201);
        }
    }

    
    public function show($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        $save = Transaction::find($id)->update([
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'title' => $request->title,
            'date' => $request->date,
            'nominal' => $request->nominal,
            'notes' => $request->notes,
            'status' => $request->status,
        ]);

        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Updated !',
                
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
            
                
            ], 201);
        }
    }

    
    public function destroy($id)
    {
        $save = Transaction::find($id)->delete();

        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Deleted !',
                
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                
            ], 201);
        }
    }
}
