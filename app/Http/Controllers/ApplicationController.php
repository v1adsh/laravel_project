<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationCreateRequest;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function show() {
        return response()->json(Application::query()->where('user_id', Auth::id())->get(), 200);
    }

    public function store(ApplicationCreateRequest $request){
        $application                = new Application();
        $application->user_id       = Auth::id();
        $application->status_id     = 1;
        $application->description   = $request->get('description');
        if (!$application->save()) {
            return response()->json(['message'=>'Заявка не отправлена'], 422);
        }
        return response()->json(['message'=>'Заявка создана'], 200);
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
