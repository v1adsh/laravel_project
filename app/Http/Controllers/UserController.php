<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function Symfony\Component\String\u;

class UserController extends Controller
{
    public function store(UserCreateRequest $request){
        $user = new User();
        $user->login        = $request->get('login');
        $user->password     = $request->get('password');
        $user->email        = $request->get('email');
        $user->number_phone = $request->get('number_phone');
        $user->role_id      = $request->get('role_id') ? $request->get('role_id') : 1;

        if (!$user->save()) {
            return response()->json(['message'=>'Регистрация не удалась']);
        }

        return response()->json(['message'=>$user->jsonSerialize()]);
    }

    public function delete(User $user) {
        if ($user->delete()) {
            return response()->json($user->login . ' удалён', 200);
        }

        return response()->json(['message' => 'Пользователь не удалён'], 500);
    }

//    public function update(User $user, $id)
//    {
//        $user->login =
//    }
}
