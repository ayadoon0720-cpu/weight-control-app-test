@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}">
@endsection

@section('content')
<div class="goal-setting-wrapper">

  <div class="goal-setting-card">
    <h2 class="goal-setting-title">目標体重設定</h2>

    <form method="POST" action="{{ route('weight_logs.goal_setting.update') }}">
      @csrf

      <div class="goal-setting-input-area">
        <input
          type="text"
          name="target_weight"
          class="goal-setting-input"
          value="{{ old('target_weight', optional($target)->target_weight) }}"
        >
        <span class="goal-setting-unit">kg</span>
      </div>

      {{-- バリデーションエラー（赤） --}}
      @error('target_weight')
        <p class="goal-setting-error">{{ $message }}</p>
      @enderror

      <div class="goal-setting-buttons">
        <a href="{{ route('weight_logs.index') }}" class="btn-back">
          戻る
        </a>

        <button type="submit" class="btn-update">
          更新
        </button>
      </div>
    </form>
  </div>

</div>
@endsection
