<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Status;
use App\Models\User;

class ApplicationController extends Controller
{
    public function showById($id) {
        return response()->json(Status::find($id), 200);
    }

    public function show() {
        return response()->json(Status::all(), 200);
    }
}
