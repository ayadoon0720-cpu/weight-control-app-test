<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>PiGLy</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>
  <div class="app">
    <header class="admin-header">
    <div class="admin-logo">PiGLy</div>

    <div class="admin-header-right">
      <a class="header-btn" href="{{ route('weight_logs.goal_setting') }}">
    ⚙️ 目標体重設定
      </a>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">
          🚪 ログアウト
        </button>
      </form>
    </div>
  </header>
    @yield('content')
  </div>
</body>

</html>