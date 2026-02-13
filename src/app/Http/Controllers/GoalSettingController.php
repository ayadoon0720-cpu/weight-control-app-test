<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GoalSettingRequest;
use App\Models\WeightTarget;

class GoalSettingController extends Controller
{
    public function edit()
    {
        $target = WeightTarget::where('user_id', auth()->id())->first();

        return view('goal_setting', [
            'target' => $target,
        ]);
    }

    public function update(GoalSettingRequest $request)
    {

        WeightTarget::updateOrCreate(
            ['user_id' => auth()->id()],
            ['target_weight' => $request->target_weight]
        );

        return redirect()->route('weight_logs.index');
    }
}
