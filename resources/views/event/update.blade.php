@extends('layout')

@section('title')
イベント情報編集
@endsection

@section('content')
  <h3>イベント情報編集</h3>
  <table width="1300" border="10" cellspacing="0" cellpadding="8" bordercolor="#ffd700">
    <tr>
      <th>開始年月日</th>
      <th>終了年月日</th>
      <th>イベント名</th>
      <th>主催者</th>
      <th>準備費用</th>
      <th>データの変更</th>
    </tr>

    <tr>
      {!! Form::open() !!}
        <td align="center">
          <input name="startDay" type="text" id="startYear" size="16" value="{{ $events[0]->startDay }}" />
        </td>

        <td align="center">
          <input name="endDay" type="text" id="endDay" size="16" value="{{ $events[0]->endDay }}" />
        </td>

        <td align="center">
          <input name="eventName" type="text" id="eventName" value="{{ $events[0]->name }}" />
        </td>

        <td align="center">
          <input name="host" type="text" id="host" value="{{ $events[0]->host }}" />
        </td>

        <td align="center">
          <input name="price" type="text" id="price" size="10" value="{{ $events[0]->price }}" />円
        </td>

        <td align="center">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $events[0]->id }}">
          <input type="submit" value="変更する" />
        </td>
      {!! Form::close() !!}
    </tr>
  </table>

  <br><hr><br>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a>
@endsection