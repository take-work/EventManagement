@extends('layout')

@section('title')
ログイン画面
@endsection

@section('content')

@section('subTitle')
  <h3>ログイン</h3>
@endsection

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        <th>メールアドレス</th>
        <th>パスワード</th>
        <th>継続</th>
        <th>ログイン</th>
      </tr>
    </thead>

  {!! Form::open() !!}
  {!! csrf_field() !!}
  <tbody>
    <tr>
      <td align="center">
        <input type="email" name="email" value="{{ old('email') }}">
      </td>

      <td align="center">
        <input type="password" name="password" id="password">
      </td>

      <td align="center">
        <input type="checkbox" name="remember" id="remember"><label for="remember"> ログインを継続する </label>
      </td>

      <td align="center">
        <button type="submit">ログインする</button>
      </td>

    </tr>
  </tbody>
  {!! Form::close() !!}
@endsection
