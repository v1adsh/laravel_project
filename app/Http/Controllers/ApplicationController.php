<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function show() {
        $login = User::query()->where('id', Auth::id())->get('login');

        return response()->json(['application' => Application::query()->where('user_id', Auth::id())->get(), 'login' => $login], 200);
    }

    public function store(Request $request){
        $application                = new Application();
        $application->user_id       = Auth::id();
        $application->status_id     = 1;
        $application->description   = $request->get('description');

        if (!$application->save()) {
            return response()->json(['message'=>'Заявка не отправлена'], 422);
        }

        $login = User::query()->where('id', Auth::id())->get('login');

        return response()->json(['message'=>'Заявка создана', 'login' => $login], 200);
    }

    public function delete(Application $application) {
        if (!$application) {
            return response()->json(['message' => 'Такой заявки нет'], 404);
        }

        if ($application->user_id == Auth::id()) {
            if ($application->delete()) {
                return response()->json(['message' => 'Заявка удалена'], 200);
            }
        }
        return response()->json(['message' => 'Вы не можете удалить чужую заявку'], 403);
    }
}
