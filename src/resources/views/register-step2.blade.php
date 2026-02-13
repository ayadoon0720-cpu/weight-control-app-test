<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register-step2.css') }}">
</head>

<body>
<div class="register-step2">
    <div class="card">
        <h1 class="logo">PiGLy</h1>
        <p class="title">新規会員登録</p>
        <p class="step">STEP2 体重データの入力</p>

        <form action="{{ route('register.step2.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>現在の体重</label>
                <input
                    type="text"
                    name="current_weight"
                    value="{{ old('current_weight') }}"
                    placeholder="例）55.5"
                >
                @error('current_weight')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>目標の体重</label>
                <input
                    type="text"
                    name="target_weight"
                    value="{{ old('target_weight') }}"
                    placeholder="例）50.0"
                >
                @error('target_weight')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">
                アカウント作成
            </button>
        </form>
    </div>
</div>
</body>
</html>