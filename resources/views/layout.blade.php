<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title> @yield('title') </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker3.min.css') }}">
</head>
<body>

  @if (Session::has('flash_message'))
    <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
  @endif

  @yield('content')

</body>
</html>
