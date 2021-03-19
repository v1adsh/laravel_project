<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationCreateRequest;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Status;
use App\Models\User;

class ApplicationController extends Controller
{
//    public function showById($id) {
//        return response()->json(Status::find($id), 200);
//    }
//
//    public function show() {
//        return response()->json(Status::all(), 200);
//    }

    public function store(ApplicationCreateRequest $request){
        $application = new Application();
        $application->user_id = $request->get('user_id');
        $application->status_id = $request->get('status_id') ? $request->get('status_id') : 1;
        $application->description = $request->get('description');

        if (!$application->save()) {
            return response()->json(['message'=>'Заявка не отправлена']);
        }

        return response()->json(['message'=>$application->jsonSerialize()]);
    }

//    public function delete(User $user) {
//        if ($user->delete()) {
//            return response()->json($user->login . ' удалён', 200);
//        }
//
//        return response()->json(['message' => 'Пользователь не удалён'], 500);
//    }

    public function delete(Application $application) {
        if ($application->delete()) {
            return response()->json('Заявка удалён', 200);
        }

        return response()->json(['message' => 'Пользователь не удалён'], 500);
    }
}
