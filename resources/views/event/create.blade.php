@extends('layout')

@section('title')
イベント追加
@endsection

@section('content')
  <h3>イベント情報入力</h3>

  <table width="1300" border="10" cellspacing="0" cellpadding="8" bordercolor="#ffd700">
    <tr>
      <th>開始年月日</th>
      <th>終了年月日</th>
      <th>イベント名</th>
      <th>主催者</th>
      <th>準備費用</th>
      <th>データの登録</th>
    </tr>

    <tr>
      {!! Form::open() !!}
        <td align="center">
          <input name="startDay" type="text" id="startDay" maxlength="4" />
        </td>

        <td align="center">
          <input name="endDay" type="text" id="endDay" maxlength="4" />
        </td>

        <td align="center">
          <input name="eventName" type="text" id="eventName" size="20" maxlength="255" />
        </td>

        <td align="center">
          <input name="host" type="text" id="host" size="20" maxlength="255" />
        </td>

        <td align="center">
          <input name="price" type="text" id="price" size="10" maxlength="10" />円
        </td>

        <td align="center">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="submit" value="登録する" />
        </td>
      {!! Form::close() !!}
    </tr>
  </table>

  <br><hr><br>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a>
@endsection