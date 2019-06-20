<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use Illuminates\Http\Response;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success'=>$success], $this->successStatus);

        }else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->errors()]);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        return response()->json(['success' => $success], $this->successStatus);
    }
}
