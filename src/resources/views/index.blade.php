@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="admin-page">

  {{-- 上部カード --}}
  <div class="summary">
    <div class="summary-card">
      <p class="summary-label">目標体重</p>
      <p class="summary-value">
        {{ is_null($targetWeight) ? '--' : number_format($targetWeight, 1) }}
        <span class="unit">kg</span>
      </p>
    </div>

    <div class="summary-card">
      <p class="summary-label">目標まで</p>
      <p class="summary-value">
        {{ is_null($diff) ? '--' : number_format($diff, 1) }}
        <span class="unit">kg</span>
      </p>
    </div>

    <div class="summary-card">
      <p class="summary-label">最新体重</p>
      <p class="summary-value">
        {{ is_null($latestWeight) ? '--' : number_format($latestWeight, 1) }}
        <span class="unit">kg</span>
      </p>
    </div>
  </div>

  {{-- 検索 --}}
  <div class="table-wrap">
    <div class="search-area">
      <form method="GET" action="{{ route('weight_logs.search') }}" class="search-form">
        <input type="date" name="from" value="{{ request('from') }}">
        <span class="wave">〜</span>
        <input type="date" name="to" value="{{ request('to') }}">

        <button type="submit" class="btn-search">検索</button>

        @if(request('from') || request('to'))
          <a href="{{ route('weight_logs.index') }}" class="btn-reset">リセット</a>
        @endif
      </form>

      <button class="btn-add" id="openModal">データ追加</button>
    </div>

    {{-- 検索結果表示 --}}
    @isset($count)
      <p class="search-result-text">
        {{ request('from') ?: '--' }}〜{{ request('to') ?: '--' }}の検索結果 {{ $count }}件
      </p>
    @endisset

    {{-- 一覧 --}}
    <table class="weight-table">
      <thead>
        <tr>
          <th>日付</th>
          <th>体重</th>
          <th>摂取カロリー</th>
          <th>運動時間</th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        @foreach($weightLogs as $weightLog)
          <tr>
            <td>{{ \Carbon\Carbon::parse($weightLog->date)->format('Y/m/d') }}</td>
            <td>{{ number_format($weightLog->weight, 1) }}kg</td>
            <td>{{ $weightLog->calories }}cal</td>
            <td>{{ \Carbon\Carbon::parse($weightLog->exercise_time)->format('H:i') }}</td>
            <td class="edit-cell">
              <a href="{{ route('weight_logs.show', $weightLog->id) }}" class="edit-btn" title="編集">
                ✎
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{-- ページネーション --}}
    <div class="pagination-wrap">
      {{ $weightLogs->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
  </div>
</div>

{{-- ========== モーダル ========== --}}
<div class="modal-bg" id="modalBg">
  <div class="modal-card">
    <h2 class="modal-title">Weight Logを追加</h2>

    <form method="POST" action="{{ route('weight_logs.store') }}">
      @csrf

      <div class="modal-group">
        <label>日付 <span class="required">必須</span></label>
        <input type="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}">
        @error('date')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      <div class="modal-group">
        <label>体重 <span class="required">必須</span></label>
        <div class="unit-input">
          <input type="text" name="weight" value="{{ old('weight') }}" placeholder="50.0">
          <span class="unit-right">kg</span>
        </div>
        @error('weight')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      <div class="modal-group">
        <label>摂取カロリー <span class="required">必須</span></label>
        <div class="unit-input">
          <input type="text" name="calories" value="{{ old('calories') }}" placeholder="1200">
          <span class="unit-right">cal</span>
        </div>
        @error('calories')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      <div class="modal-group">
        <label>運動時間 <span class="required">必須</span></label>
        <input type="time" name="exercise_time" value="{{ old('exercise_time') }}" placeholder="00:00">
        @error('exercise_time')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      <div class="modal-group">
        <label>運動内容</label>
        <textarea name="exercise_content" placeholder="運動内容を追加" rows="4">{{ old('exercise_content') }}</textarea>
        @error('exercise_content')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      <div class="modal-buttons">
        <button type="button" class="btn-back" id="closeModal">戻る</button>
        <button type="submit" class="btn-submit">登録</button>
      </div>
    </form>
  </div>
</div>

{{-- バリデーションエラーがある時はモーダル開いた状態にする --}}
@if($errors->any())
<script>
  window.addEventListener("load", () => {
    document.getElementById("modalBg").classList.add("show");
  });
</script>
@endif

<script>
  const openModal = document.getElementById("openModal");
  const closeModal = document.getElementById("closeModal");
  const modalBg = document.getElementById("modalBg");

  openModal.addEventListener("click", () => {
    modalBg.classList.add("show");
  });

  closeModal.addEventListener("click", () => {
    modalBg.classList.remove("show");
  });

  modalBg.addEventListener("click", (e) => {
    if(e.target === modalBg){
      modalBg.classList.remove("show");
    }
  });
</script>

@endsection
