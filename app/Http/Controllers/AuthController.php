<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function auth(UserLoginRequest $request){

        $user = User::query()->where('login', $request->get('login'))->first();
        if (!$user || !Hash::check($request->get('password'), $user->password)) {
            return response()->json(['message'=>'Попытка входа не удалась'], 400);
        }

        $user->createToken('api_token')->plainTextToken;

        return response()->json(['message'=>$user->api_token]);
    }

    public function store(UserCreateRequest $request){
        $user = new User();
        $user->login = $request->get('login');
        $user->password = Hash::make($request->get('password'));
        $user->email = $request->get('email');
        $user->number_phone = $request->get('number_phone');
        $user->role_id = 1;

        if (!$user->save()) {
            return response()->json(['message'=>'Регистрация не удалась']);
        }

        return response()->json(['message'=>$user->jsonSerialize()]);
    }

    public function logout($api_token) {
        User::deleted($api_token);
        auth()->logout();
        $this->save();
    }
}
