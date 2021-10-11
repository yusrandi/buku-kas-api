<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function index()
    {
        return response()->json([
            'responsecode' => '1',
            'responsemsg' => 'success',
            'user' => User::all()
        ], 201);
    }
    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
            'responsecode' => '1',
            'responsemsg' => 'Data found',
            'user' => $user
        ], 201);
    }
    public function login(Request $request)     
    {
        $hasher = app()->make('hash');
        $email = $request->email;
        $password = $request->password;

        $login = User::where(['email'=> $email])->first();

        if(!$login){

            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Maaf email anda tidak terdaftar',
                
            ], 201);
        }else{
            if($hasher->check($password, $login->password)){

                $data = User::where('id', $login->id)->first();

                    return response()->json([
                        'responsecode' => '1',
                        'responsemsg' => 'Selamat datang',
                        'user' => $data
                    ], 201);
                
            }else{
                return response()->json([
                    'responsecode' => '0',
                    'responsemsg' => 'Maaf password anda salah',
                    
                ], 201);
            }
        }

    }

    public function register(Request $request)
    {
        $hasher = app()->make('hash');
        $login = User::where('email', $request->email)->first();

        if($login){
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Maaf email sudah terdaftar',
                
            ], 201);
        }else{
            

            $insert = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$hasher->make($request->password),
            ]);


            if($insert){
                    return response()->json([
                        'responsecode' => '1',
                        'responsemsg' => 'anda berhasil terdaftar',
                        'user' => $insert
                    ], 201);
            }else{
                return response()->json([
                    'responsecode' => '0',
                    'responsemsg' => 'terjadi kesalahan',
                    
                    
                ], 201);
            }
        }
    }
    public function update(Request $request)
    {
        $name = $request->name;
        $pass = $request->password;
        $id = $request->id;

        $data['name'] = $request->name;

        if($pass != "null"){
            // return "has";
            $data['password'] = Hash::make($pass);
        }else{
            // return "not has";

        }

        $update = User::find($id)->update($data);

        $user = User::find($id);
        if ($update) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'user' => $user
            ], 201);
        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Failed',
                
            ], 201);
        }
    }
}
