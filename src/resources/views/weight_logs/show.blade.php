@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_log_show.css') }}">
@endsection

@section('content')
<div class="weight-log-container">
   <div class="weight-log-card">
    <h2>Weight Log</h2>

    <form method="POST" action="/weight_logs/{{ $weightLog->id }}/update">
        @csrf
        @method('PUT')

        {{-- 日付 --}}
        <label>日付</label>
        <input type="date" name="date"
               value="{{ old('date', $weightLog->date ?? now()->toDateString()) }}">
        @error('date')
            <p class="error">{{ $message }}</p>
        @enderror

        {{-- 体重 --}}
        <div class="form-group">
        <label>体重</label>
        <div class="input-with-unit">
        <input class="input-short" type="number" step="0.1" name="weight"
               value="{{ old('weight', $weightLog->weight) }}">
               <span class="unit">kg</span>
        @error('weight')
            <p class="error">{{ $message }}</p>
        @enderror
        </div>
        </div>

        <div class="form-group">
        {{-- 摂取カロリー --}}
        <label>摂取カロリー</label>
        <div class="input-with-unit">
        <input class="input-short" type="number" name="calories"
               value="{{ old('calories', $weightLog->calories) }}">
               <span class="unit">cal</span>
        @error('calories')
            <p class="error">{{ $message }}</p>
        @enderror
        </div>
        </div>

        {{-- 運動時間 --}}
        <label>運動時間</label>
        <input type="time" name="exercise_time"
               value="{{ old('exercise_time', $weightLog->exercise_time) }}">
        @error('exercise_time')
            <p class="error">{{ $message }}</p>
        @enderror

        {{-- 運動内容 --}}
        <label>運動内容</label>
        <textarea name="exercise_content">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
        @error('exercise_content')
            <p class="error">{{ $message }}</p>
        @enderror

        <div class="button-area">
            <a href="/weight_logs" class="btn-back">戻る</a>
            <button type="submit" class="btn-update">更新</button>
    </form>

    {{-- 削除 --}}
    <form method="POST" action="/weight_logs/{{ $weightLog->id }}/delete">
        @csrf
        <button class="btn-delete">🗑</button>
    </form>
</div>
</div>
</div>
@endsection