@extends('layout')

@section('title')
イベント削除確認
@endsection

@section('content')

@section('subTitle')
  <h3>イベント削除確認</h3>
  <p>下記のデータを削除しますか?<br>
  よろしければ「データの削除」から「削除する」ボタンをクリックしてください。</p>
@endsection

  <table class="table table-responsive table-bordered">
    <thead>
      <tr class="active">
        <th>開始年月日</th>
        <th>終了年月日</th>
        <th>イベント名</th>
        <th>主催者</th>
        <th>準備費用</th>
        <th>データの削除</th>
      </tr>
    </thead>

  {!! Form::open() !!}
    <tbody>
      <tr>
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
      </tr>
    </tbody>
  {!! Form::close() !!}

  </table>

  <hr>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a>
@endsection
