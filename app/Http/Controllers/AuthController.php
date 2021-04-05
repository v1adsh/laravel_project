<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use Egulias\EmailValidator\Exception\AtextAfterCFWS;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class AuthController extends Controller
{
    public function store(UserCreateRequest $request){
        $user               = new User();
        $user->login        = $request->get('login');
        $user->password     = Hash::make($request->get('password'));
        $user->email        = $request->get('email');
        $user->number_phone = $request->get('number_phone');
        $user->assignRole('user');

        if (!$user->save()) {
            return response()->json(['message'=>'Регистрация не удалась']);
        }

        return response()->json(['message'=>$user->jsonSerialize()], 200);
    }

    public function login(UserLoginRequest $request){

        $user = User::query()->where('login', $request->get('login'))->first();
        if (!$user || !Hash::check($request->get('password'), $user->password)) {
            return response()->json(['message'=>'Попытка входа не удалась'], 422);
        }

        $token = $user->createToken('api_token')->plainTextToken;
        $user->api_token = $token;
        $user->save();
        $user = Auth::login($user);

        return response()->json(['message'=>Auth::user()->api_token], 200);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Вы вышли из системы'], 200);
    }
}
