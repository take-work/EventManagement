@extends('layout')

@section('title')
ユーザー登録
@endsection

@section('content')

@section('subTitle')
  <h3>ユーザー登録ページ</h3>
@endsection

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        <th>ユーザー名</th>
        <th>メールアドレス</th>
        <th>パスワード</th>
        <th>パスワード確認</th>
        <th>登録</th>
      </tr>
    </thead>

    {!! Form::open() !!}
    {!! csrf_field() !!}
    <tbody>
      <tr>
        <td align="center">
          <input type="text" name="name" value="{{ old('name') }}">
        </td>

        <td align="center">
          <input type="email" name="email" value="{{ old('email') }}">
        </td>

        <td align="center">
          <input type="password" name="password">
        </td>

        <td align="center">
          <input type="password" name="password_confirmation">
        </td>

        <td align="center">
          <button type="submit">登録する</button>
        </td>

      </tr>
    </tbody>
    {!! Form::close() !!}
  </table>

  <hr>
  <a href="{!! '/auth/login' !!}">ログイン画面に戻る</a>
@endsection
