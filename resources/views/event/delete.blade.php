@extends('layout')

@section('title')
イベント削除確認
@endsection

@section('content')

  <h3>イベント一覧</h3>
  <p>下記のデータを削除しますか?<br>
  よろしければ「データの削除」から「削除する」ボタンをクリックしてください</p>

  <hr><br>

  <table width="1300" border="10" cellspacing="0" cellpadding="8" bordercolor="#ffd700">
    <tr>
      <th>開始日</th>
      <th>終了日</th>
      <th>イベント名</th>
      <th>主催者</th>
      <th>準備費用</th>
      <th>データの削除</th>
    </tr>

    <tr>
     {!! Form::open() !!}
        <td align="center">
          {{ $events[0]->startDay }}
        </td>

        <td align="center">
          {{ $events[0]->endDay }}
        </td>

        <td align="center">
          {{ $events[0]->name }}
        </td>

        <td align="center">
          {{ $events[0]->host }}
        </td>

        <td align="center">
          {{ $events[0]->price }}円
        </td>

        <td align="center">
          <input type="hidden" name="id" value="{{ $events[0]->id }}">
          <input type="submit" value="削除する" />
        </td>
      {!! Form::open() !!}
    </tr>
  </table>
@endsection
