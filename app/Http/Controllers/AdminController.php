<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Models\Application;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Symfony\Component\String\u;

class AdminController extends Controller
{
    public function store(UserCreateRequest $request)
    {
        $user = new User();
        $user->login        = $request->get('login');
        $user->password     = Hash::make($request->get('password'));
        $user->email        = $request->get('email');
        $user->number_phone = $request->get('number_phone');
        $user->assignRole($request->get('role'));
//        $user->role_id      = $request->get('role_id') ? $request->get('role_id') : 1;

        if (!$user->save()) {
            return response()->json(['message'=>'Регистрация не удалась']);
        }
        return response()->json(['message'=>$user->jsonSerialize()]);
    }

    public function delete(User $user)
    {
        if ($user->delete()) {
            return response()->json($user->login . ' удалён', 200);
        }
        return response()->json(['message' => 'Пользователь не удалён'], 500);
    }

    public function update($id, Request $request)
    {
        $user               = User::query()->find($id);
        if ($user->hasRole('user')) {
            $user->removeRole('user');
        } elseif ($user->hasRole('admin')) {
            $user->removeRole('admin');
        }
        $user->login        = $request->input('login');
        $user->password     = Hash::make($request->input('password'));
        $user->email        = $request->input('email');
        $user->number_phone = $request->input('number_phone');
        $user->assignRole($request->input('role'));

        if (!$user->save()) {
            return response()->json(['message'=>'Изменить данные пользователя не удалось']);
        }

        return response()->json(['message'=>$user->jsonSerialize()]);
    }

    public function show()
    {
        return response()->json(User::all(), 200);
    }

    public function showById($id)
    {
        return response()->json(User::query()->find($id), 200);
    }

    public function updateStatus($id, Request $request)
    {
        $application            = Application::query()->find($id);
        $application->status_id = $request->input('status_id');
        $application->save();

        return response()->json(['message' => 'Статус заявки изменён']);
    }
}
