@extends('layout')

@section('title')
サークル情報編集
@endsection

@section('content')

  <h3>サークル情報編集</h3>

  <hr><br>

  <table width="1300" border="10" cellspacing="0" cellpadding="8" bordercolor="#ffd700">
    <tr>
      <th>ナンバー</th>
      <th>スペース</th>
      <th>サークル名</th>
      <th>リーダー</th>
      <th>スタッフ数</th>
      <th>机の数</th>
      <th>椅子の数</th>
      <th>データの更新</th>
    </tr>

    <tr>
      {!! Form::open() !!}
        <td align="center">
          <input name="number" type="text" id="number" value="{{ $circles[0]->number }}" />
        </td>

        <td align="center">
          <input name="space" type="text" id="space" value="{{ $circles[0]->space }}" />
        </td>

        <td align="center">
          <input name="name" type="text" id="name" maxlength="255" value="{{ $circles[0]->circle_name }}" />
        </td>

        <td align="center">
          <input name="host" type="text" id="host" maxlength="255" value="{{ $circles[0]->host }}" />
        </td>

        <td align="center">
          <input name="staff" type="text" id="staff" maxlength="10" size="6" value="{{ $circles[0]->staff }}" />人
        </td>

        <td align="center">
          <input name="desk" type="text" id="desk" maxlength="10" size="6" value="{{ $circles[0]->desk }}" />個
        </td>

        <td align="center">
          <input name="chair" type="text" id="chair" maxlength="10" size="6" value="{{ $circles[0]->chair }}" />個
        </td>

        <td align="center">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $circles[0]->id }}">
          <input type="submit" value="更新する" />
        </td>
      {!! Form::close() !!}
    </tr>
  </table>

  <br><hr><br>
  <a href="{!! url('list') !!}">イベント一覧に戻る</a>
@endsection
