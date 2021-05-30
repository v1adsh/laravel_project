<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        //$request = $request->validate([
        //    'login' => 'required|max:255|string',
        //    'password' => 'required|max:255|string',
        //    'fio' => 'required|max:255|string',
        //    'email' => 'required|max:255|email|string',
        //    'number_phone' => 'required|max:11|string',
        //]);

        $user               = new User();
        $user->login        = $request->get('login');
        $user->password     = Hash::make($request->get('password'));
        $user->fio          = $request->get('fio');
        $user->email        = $request->get('email');
        $user->number_phone = $request->get('number_phone');
        $user->assignRole('user');

        if (!$user->save()) {
            return response()->json(['message'=>'Регистрация не удалась'], 422);
        }

        return response()->json(['message'=> 'Регистрация прошла успешно'], 200);
    }

    public function login(Request $request){

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

        return response()->json(['message' => 'Вы вышли из системы', 'apiKey' => Auth::user()->api_token], 200);
    }
}
