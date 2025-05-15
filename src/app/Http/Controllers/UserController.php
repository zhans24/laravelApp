<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function login(Request $request){
        try {
            $user=User::where('email',$request['email'])->first();
            if ($user && Hash::check($request['password'],$user->password)){
                Session::put('user_id',$user->id);
                return response()->json(["message"=>"login success"]);
            }else {
                return response()->json(["message"=>"email or password incorrect"]);
            }
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['message'=>'Internal server error'],500);
        }
    }

    public function register(Request $request)
    {
        try {
            $user=User::where('email',$request['email'])->first();
            if ($user){
                return response()->json(['message'=>"email exist"]);
            }else {
                User::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password'])
                ]);                return response()->json(['message'=>'register success'],201);
            }
        }catch (\Exception $e){
            Log::error($e);
            return response()->json(['message'=>'Internal server error'],500);
        }
    }

    public function logout()
    {
        Session::remove('user_id');
        return response()->json(['message'=>'You successfully logout']);
    }
}
