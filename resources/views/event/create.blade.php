@extends('layout')

@section('title')
イベント追加
@endsection

@section('content')
  <h3>イベント情報入力</h3>
  <table width="1200" border="1" cellspacing="1" cellpadding="8">
    <tr>
      <th>開始年月日</th>
      <th>終了年月日</th>
      <th>イベント名</th>
      <th>主催者</th>
      <th>準備費用</th>
      <th>データの登録</th>
    </tr>

    <tr>
      <form id="formInput" name="formInput" method="post">
        <td align="center">
          西暦<input name="startYear" type="text" id="startYear" size="8" maxlength="10" />年 &nbsp;
          <input name="startMonth" type="text" id="startMonth" size="4" maxlength="4" />月 &nbsp;
          <input name="startDay" type="text" id="startDay" size="4" maxlength="4" />日
        </td>

        <td align="center">
          西暦<input name="endYear" type="text" id="endYear" size="8" maxlength="10" />年 &nbsp;
          <input name="endMonth" type="text" id="endMonth" size="4" maxlength="4" />月 &nbsp;
          <input name="endDay" type="text" id="endDay" size="4" maxlength="4" />日
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
          <input type="submit" value="登録する" />
        </td>
      </form>
    </tr>
  </table>
@endsection