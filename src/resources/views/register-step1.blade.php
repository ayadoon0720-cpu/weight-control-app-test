<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>register</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css')}}">
  <link rel="stylesheet" href="{{ asset('css/register-step1.css') }}">
</head>

<body>
<div class="auth-bg">
  <div class="auth-card">
    <h1 class="logo">PiGLy</h1>
    <p class="title">新規会員登録</p>
    <p class="step">STEP1 アカウント情報の登録</p>

    <form method="POST" action="{{ route('register.step1.store') }}">
      @csrf

      <div class="form-group">
        <label>お名前</label>
        <input type="text" name="name" placeholder="名前を入力" value="{{ old('name') }}">
        @error('name')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label>メールアドレス</label>
        <input type="text" name="email" placeholder="メールアドレスを入力" value="{{ old('email') }}">
        @error('email')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label>パスワード</label>
        <input type="password" name="password" placeholder="パスワードを入力">
        @error('password')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit" class="btn-next">次に進む</button>
      <div class="login-link-wrap">
      <a href="/login" class="login-link">ログインはこちら</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>
