<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStep1Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterStep1Controller extends Controller
{
    public function create()
    {
        return view('register-step1');
    }

    public function store(RegisterStep1Request $request)
    {
        // Fortifyユーザー登録（Userテーブルへ登録）
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // ←ハッシュ化
        ]);

        // 登録後ログイン状態にする
        Auth::login($user);

        // step2へ遷移
        return redirect('/register/step2');
    }
}