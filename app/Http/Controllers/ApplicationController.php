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
    public function showById($id) {
        return response()->json(Application::find($id), 200);
    }

    public function show() {
        return response()->json(Application::all(), 200);
    }

    public function store(ApplicationCreateRequest $request, User $user){
        $application                = new Application();
        $application->user_id       = Auth::id();
        $application->status_id     = 1;
        $application->description   = $request->get('description');

        if (!$application->save()) {
            return response()->json(['message'=>'Заявка не отправлена'], 500);
        }

        return response()->json(['message'=>$application->jsonSerialize()]);
    }

    public function delete(Application $application) {
        if ($application->delete()) {
            return response()->json('Заявка удалёна', 200);
        }

        return response()->json(['message' => 'Заявка не удалёна'], 500);
    }

//    public function updateStatus(Application $application)
//    {
//        if ($application->status_id)
//    }
}
