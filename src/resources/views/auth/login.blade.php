<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css')}}">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
<div class="login-page">
    <div class="login-card">
        <h1 class="login-logo">PiGLy</h1>
        <p class="login-title">ログイン</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- メールアドレス --}}
            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" name="email" placeholder="メールアドレスを入力" value="{{ old('email') }}">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- パスワード --}}
            <div class="form-group">
                <label>パスワード</label>
                <input type="password" name="password" placeholder="パスワードを入力">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="login-btn">
                ログイン
            </button>

            <a class="register-link" href="/register/step1">
                アカウント作成はこちら
            </a>
        </form>
    </div>
</div>
</body>
</html>
