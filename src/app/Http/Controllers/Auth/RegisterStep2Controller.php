<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStep2Request;
use Illuminate\Support\Facades\Auth;

class RegisterStep2Controller extends Controller
{
    public function create()
    {
        return view('register-step2');
    }

    public function store(RegisterStep2Request $request)
    {
        $user = Auth::user();

        // DB保存（usersテーブルに保存する想定）
        $user->current_weight = $request->current_weight;
        $user->target_weight  = $request->target_weight;
        $user->save();

        // 体重管理画面へ（例）
        return redirect('/weight_logs');
    }
}
