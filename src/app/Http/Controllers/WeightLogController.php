<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeightLogUpdateRequest;
use App\Http\Requests\WeightLogStoreRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeightLogController extends Controller
{
    public function index(Request $request)
    {
        // 目標体重（最新の1件を使う想定）
        $weightTarget = WeightTarget::where('user_id', auth()->id())
            ->latest()
            ->first();

        $targetWeight = $weightTarget?->target_weight;

        // 最新体重（weight_logsの最新日付）
        $latestLog = WeightLog::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->first();

        $latestWeight = $latestLog?->weight;

        $diff = null;
        if (!is_null($targetWeight) && !is_null($latestWeight)) {
            $diff = $latestWeight - $targetWeight;
        }

        // 一覧（8件ページネーション）
        $weightLogs = WeightLog::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->paginate(8);

        return view('index', compact(
            'weightTarget',
            'targetWeight',
            'latestWeight',
            'diff',
            'weightLogs'
        ));
    }

    public function search(Request $request)
    {
        $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date'],
        ]);

        $weightTarget = WeightTarget::where('user_id', auth()->id())
            ->latest()
            ->first();

        $targetWeight = $weightTarget?->target_weight;

        $latestLog = WeightLog::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->first();

        $latestWeight = $latestLog?->weight;

        $diff = null;
        if (!is_null($targetWeight) && !is_null($latestWeight)) {
            $diff = $latestWeight - $targetWeight;
        }

        $query = WeightLog::where('user_id', auth()->id());

        if ($request->filled('from')) {
            $query->whereDate('date', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('date', '<=', $request->to);
        }

        $weightLogs = $query->orderBy('date', 'desc')->paginate(8)->appends($request->query());

        // 表示用
        $from = $request->from;
        $to = $request->to;
        $count = $query->count();

        return view('index', compact(
            'weightTarget',
            'targetWeight',
            'latestWeight',
            'diff',
            'weightLogs',
            'from',
            'to',
            'count'
        ));
    }

    public function store(WeightLogStoreRequest $request)
    {
        WeightLog::create([
            'user_id' => auth()->id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect('/weight_logs');
    }

    // 今回は鉛筆ボタン＝編集画面へ
    public function show($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);

        return view('weight_logs.show', compact('weightLog'));
    }

    public function update(WeightLogUpdateRequest $request, $weightLogId)
    {
         $weightLog = WeightLog::findOrFail($weightLogId);

         $weightLog->update($request->validated());

         return redirect('/weight_logs');
    }

    public function destroy($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        $weightLog->delete();

        return redirect('/weight_logs');
    }
}
